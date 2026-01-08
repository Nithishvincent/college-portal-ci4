<?php

namespace App\Controllers;

use App\Models\StudentModel;

class Faculty extends BaseController
{
    public function studentDetail($studentId)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        if (!in_array(session()->get('role'), ['faculty', 'admin'])) {
            return redirect()->to('/dashboard');
        }

        $db = \Config\Database::connect();

        // Student details
        $student = $db->table('students')
                      ->where('id', $studentId)
                      ->get()
                      ->getRowArray();

        if (!$student) {
            return redirect()->to('/dashboard');
        }

        // Projects + evaluations
        $projects = $db->table('projects p')
            ->select('
                p.id,
                p.title,
                p.description,
                p.file_path,
                p.created_at,
                e.grade,
                e.remarks
            ')
            ->join('project_evaluations e', 'e.project_id = p.id', 'left')
            ->where('p.student_id', $studentId)
            ->get()
            ->getResultArray();

        return view('faculty_student_detail', [
            'student'  => $student,
            'projects' => $projects,
            'activePage' => 'student_list'
        ]);
    }
}
