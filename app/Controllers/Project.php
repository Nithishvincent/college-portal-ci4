<?php

namespace App\Controllers;

use App\Models\ProjectModel;
use App\Models\StudentModel;

class Project extends BaseController
{
    /* ===============================
       SHOW PROJECT SUBMISSION FORM
       =============================== */
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        if (session()->get('role') !== 'student') {
            return redirect()->to('/dashboard');
        }

        return view('project_form', [
            'activePage' => 'project'
        ]);
    }

    /* ===============================
       SAVE PROJECT (FINAL FIX)
       =============================== */
    public function save()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        if (session()->get('role') !== 'student') {
            return redirect()->to('/dashboard');
        }

        // 🔑 FETCH STUDENT USING user_id
        $studentModel = new StudentModel();
        $student = $studentModel
                    ->where('user_id', session()->get('user_id'))
                    ->first();

        if (!$student) {
            return redirect()->back()->with('error', 'Student record not found');
        }

        // File handling
        $file = $this->request->getFile('project_file');

        if (!$file || !$file->isValid()) {
            return redirect()->back()->with('error', 'Invalid file');
        }

        $allowedTypes = ['pdf', 'doc', 'docx'];
        $ext = $file->getClientExtension();

        if (!in_array($ext, $allowedTypes)) {
            return redirect()->back()->with('error', 'Invalid file type');
        }

        $newName = $file->getRandomName();
        $file->move('uploads/projects', $newName);

        // Save project
        $projectModel->insert([
            'student_id'  => $student['id'],
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'file_path'   => 'uploads/projects/' . $newName,
            'status'      => 'submitted'
        ]);

        return redirect()->to('/project/list')
                         ->with('success', 'Project submitted successfully');
    }

    /* ===============================
       PROJECT LIST (FINAL FIX)
       =============================== */
    public function list()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        $role = session()->get('role');
        $userId = session()->get('user_id');

        $builder = $db->table('projects p')
            ->select('p.id,
                    p.title,
                    p.description,
                    p.file_path,
                    p.created_at,
                    p.status,
                    e.grade,
                    e.remarks
                ')

            ->join('project_evaluations e', 'e.project_id = p.id', 'left');

        if ($role === 'student') {
            $studentModel = new StudentModel();
            $student = $studentModel
                        ->where('user_id', $userId)
                        ->first();

            if (!$student) {
                return redirect()->to('/dashboard');
            }

            $builder->where('p.student_id', $student['id']);
        }

        $projects = $builder->get()->getResultArray();

        return view('project_list', [
            'projects'   => $projects,
            'activePage' => 'project_list'
        ]);
    }
}
