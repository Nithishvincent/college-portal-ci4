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

    public function update()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $userModel = new UserModel();

        $userModel->update(
            $this->request->getPost('id'),
            [
                'role'   => $this->request->getPost('role'),
                'status' => $this->request->getPost('status')
            ]
        );

        return redirect()->to('/users')->with('success', 'User updated');
    }
}
