<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\StudentModel;

class AdminStudent extends BaseController
{
    public function create()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        return view('admin_student_create', [
            'activePage' => 'student'
        ]);
    }

    public function store()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $userModel    = new UserModel();
        $studentModel = new StudentModel();

        $email = $this->request->getPost('email');

        // 🔒 Prevent duplicate users
        if ($userModel->where('email', $email)->first()) {
            return redirect()->back()->with('error', 'Email already exists');
        }

        // 1️⃣ CREATE USER
        $userId = $userModel->insert([
            'email'    => $email,
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => 'student',
            'status'   => 'active'
        ]);

        // 2️⃣ CREATE STUDENT PROFILE
        $studentModel->insert([
            'user_id'    => $userId,
            'name'       => $this->request->getPost('name'),
            'reg_no'     => $this->request->getPost('reg_no'),
            'department' => $this->request->getPost('department'),
            'college'    => $this->request->getPost('college')
        ]);

        return redirect()->to('/student/list')
                         ->with('success', 'Student created successfully');
    }
}
