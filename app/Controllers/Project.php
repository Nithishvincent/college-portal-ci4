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
    if (session()->get('role') !== 'student') {
        return redirect()->to('/login');
    }

    $studentModel = new \App\Models\StudentModel();
    $projectModel = new \App\Models\ProjectModel();

    // Find student via user_id
    $student = $studentModel
        ->where('user_id', session()->get('user_id'))
        ->first();

    if (!$student) {
        return redirect()->to('/dashboard')
            ->with('error', 'Student profile not found. Contact admin.');
    }

    // Insert project with STUDENT ID
    $projectModel->insert([
        'student_id' => $student['id'],
        'title'      => $this->request->getPost('title'),
        'description'=> $this->request->getPost('description'),
        'status'     => 'submitted'
    ]);

    return redirect()->to('/project/list')->with('success', 'Project submitted');
}
    /* ===============================
       UPLOAD PROJECT FILE (FINAL FIX)
       =============================== */
    public function uploadFile($projectId)
    {
        if (session()->get('role') !== 'student') {
            return redirect()->to('/login');
        }

        $projectModel = new ProjectModel();

        $project = $projectModel->find($projectId);

        if (!$project) {
            return redirect()->to('/project/list')
                ->with('error', 'Project not found');
        }

        // Verify ownership
        $studentModel = new StudentModel();
        $student = $studentModel
            ->where('user_id', session()->get('user_id'))
            ->first();

        if ($project['student_id'] != $student['id']) {
            return redirect()->to('/project/list')
                ->with('error', 'Unauthorized action');
        }

        // Handle file upload
        $file = $this->request->getFile('project_file');

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads/projects/', $newName);

            // Update project record with file path
            $projectModel->update($projectId, [
                'file_path' => 'uploads/projects/' . $newName
            ]);

            return redirect()->to('/project/list')
                ->with('success', 'File uploaded successfully');
        } else {
            return redirect()->to('/project/list')
                ->with('error', 'File upload failed');
        }
}

    /* ===============================
       PROJECT LIST (FINAL FIX)
       =============================== */
    public function list()
{
    if (!session()->get('logged_in')) {
        return redirect()->to('/login');
    }

    $db     = \Config\Database::connect();
    $role   = session()->get('role');
    $userId = session()->get('user_id');

    $builder = $db->table('projects p')
        ->select('
            p.id,
            p.title,
            p.description,
            p.file_path,
            p.created_at,
            p.status,
            e.grade,
            e.remarks,
            s.name AS student_name
        ')
        ->join('students s', 's.id = p.student_id', 'left')
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
