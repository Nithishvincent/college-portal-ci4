<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class Login extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function check()
    {
        $db = Database::connect();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $db->table('users')
                   ->where('email', $username)
                   ->where('status', 'active')
                   ->get()
                   ->getRowArray();

        if ($user && password_verify($password, $user['password'])) {

            session()->set([
                'logged_in' => true,
                'user_id'   => $user['id'],
                'name'      => $user['name'],
                'role'      => $user['role']
            ]);

            return redirect()->to('/dashboard');
        }   
        if ($user['status'] !== 'active') {
            return redirect()->back()->with('error', 'Account inactive');
        }

        return redirect()->back()->with('error', 'Invalid login details');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
