<?php

namespace App\Controllers;

use App\Models\UserModel;

class Admin extends BaseController
{
    // This method runs before every admin action
    private function checkAdmin()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }
    }

    // Admin dashboard / landing page
    public function index()
    {
        $auth = $this->checkAdmin();
        if ($auth) {
            return $auth;
        }

        return view('admin/dashboard', [
            'activePage' => 'admin_dashboard'
        ]);
    }

    // List all users (view-only for now)
    public function users()
    {
        $auth = $this->checkAdmin();
        if ($auth) {
            return $auth;
        }

        $userModel = new UserModel();

        $data = [
            'users' => $userModel->findAll(),
            'activePage' => 'users'
        ];

        return view('admin/users_list', $data);
    }
}
