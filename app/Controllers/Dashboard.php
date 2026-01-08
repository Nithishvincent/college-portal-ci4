<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $role = session()->get('role');

        switch ($role) {
            case 'admin':
                return redirect()->to('/admin/dashboard');

            case 'faculty':
                return redirect()->to('/faculty/dashboard');

            case 'student':
                return redirect()->to('/student/dashboard');

            default:
                return redirect()->to('/login');
        }
    }
    public function admin()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();

        $data = [
            'activePage'     => 'admin_dashboard',
            'totalUsers'     => $db->table('users')->countAll(),
            'totalStudents'  => $db->table('students')->countAll(),
            'totalProjects'  => $db->table('projects')->countAll(),
            'submittedCount' => $db->table('projects')->where('status', 'submitted')->countAllResults(),
            'gradedCount'    => $db->table('projects')->where('status', 'graded')->countAllResults(),
        ];

        return view('admin_dashboard', $data);
    }


    public function faculty()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'faculty') {
            return redirect()->to('/login');
        }

        return view('faculty_dashboard', [
            'activePage' => 'dashboard'
        ]);
    }

    public function student()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'student') {
            return redirect()->to('/login');
        }

        return view('student_dashboard', [
            'activePage' => 'dashboard'
        ]);
    }

}
