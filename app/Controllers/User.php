<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $userModel = new UserModel();
        $users = $userModel->findAll();

        return view('user_list', [
            'users' => $users,
            'activePage' => 'users'
        ]);
    }
    public function store()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $userModel    = new \App\Models\UserModel();
        $studentModel = new \App\Models\StudentModel();

        $email = $this->request->getPost('email');

        // Prevent duplicate user
        if ($userModel->where('email', $email)->first()) {
            return redirect()->back()->with('error', 'User already exists');
        }

        // 1️⃣ Create user
        $userId = $userModel->insert([
            'email'    => $email,
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => $this->request->getPost('role'),
            'status'   => 'active'
        ]);

        // 2️⃣ Auto-link student if exists
        $student = $studentModel->where('email', $email)->first();
        if ($student && !$student['user_id']) {
            $studentModel->update($student['id'], [
                'user_id' => $userId
            ]);
        }

        return redirect()->to('/users')->with('success', 'User created');
    }


    public function update()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $userModel    = new \App\Models\UserModel();
        $studentModel = new \App\Models\StudentModel();

        $userId = $this->request->getPost('id');
        $email  = $this->request->getPost('email');

        // Update user
        $userModel->update($userId, [
            'email'  => $email,
            'role'   => $this->request->getPost('role'),
            'status' => $this->request->getPost('status')
        ]);

        // Auto-link student if exists
        $student = $studentModel->where('email', $email)->first();
        if ($student && !$student['user_id']) {
            $studentModel->update($student['id'], [
                'user_id' => $userId
            ]);
        }

        return redirect()->to('/users')->with('success', 'User updated');
    }
    public function delete($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $userModel = new \App\Models\UserModel();
        $userModel->delete($id);

        return redirect()->to('/users')->with('success', 'User deleted');
    }

}
