<?php

namespace App\Controllers;

use App\Models\UserModel;

class Password extends BaseController
{
    public function change()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        return view('password_change', [
            'activePage' => ''
        ]);
    }

    public function update()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userModel = new UserModel();
        $userId = session()->get('user_id');

        $user = $userModel->find($userId);

        if (!password_verify($this->request->getPost('current_password'), $user['password'])) {
            return redirect()->back()->with('error', 'Current password incorrect');
        }

        $userModel->update($userId, [
            'password' => password_hash($this->request->getPost('new_password'), PASSWORD_DEFAULT)
        ]);

        return redirect()->to('/dashboard')->with('success', 'Password updated');
    }
}
