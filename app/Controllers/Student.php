<?php

namespace App\Controllers;

use App\Models\StudentModel;

class Student extends BaseController
{
    public function index()
{
    // Authentication
    if (!session()->get('logged_in')) {
        return redirect()->to('/login');
    }

    // Authorization
    if (session()->get('role') !== 'admin') {
        return redirect()->to('/dashboard');
    }

    return view('student_form', [
        'activePage' => 'student'
    ]);
}


public function save(){
    // Authentication
    if (!session()->get('logged_in')) {
        return redirect()->to('/login');
    }

    // Authorization
    if (session()->get('role') !== 'admin') {
        return redirect()->to('/dashboard');
    }

    $model = new StudentModel();

    $data = [
        'name'       => $this->request->getPost('name'),
        'reg_no'     => $this->request->getPost('reg_no'),
        'email'      => $this->request->getPost('email'),
        'college'    => $this->request->getPost('college'),
        'department' => $this->request->getPost('department'),
    ];

    $model->insert($data);

    return redirect()->to('/student/list');
}
public function store()
{
    if (session()->get('role') !== 'admin') {
        return redirect()->to('/login');
    }

    $studentModel = new \App\Models\StudentModel();
    $userModel    = new \App\Models\UserModel();

    $email = $this->request->getPost('email');

    // Prevent duplicate student
    if ($studentModel->where('email', $email)->first()) {
        return redirect()->back()->with('error', 'Student already exists');
    }

    // Find user by email (if exists)
    $user = $userModel->where('email', $email)->first();

    $studentModel->insert([
        'user_id'    => $user ? $user['id'] : null,
        'email'      => $email,
        'name'       => $this->request->getPost('name'),
        'reg_no'     => $this->request->getPost('reg_no'),
        'department' => $this->request->getPost('department'),
        'college'    => $this->request->getPost('college')
    ]);

    return redirect()->to('/student/list')->with('success', 'Student registered');
}


    public function update($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard');
        }

        $model = new StudentModel();

        $regNo = $this->request->getPost('reg_no');
        $email = $this->request->getPost('email');

        // Duplicate check (excluding current record)
        $duplicate = $model
            ->where('id !=', $id)
            ->groupStart()
                ->where('reg_no', $regNo)
                ->orWhere('email', $email)
            ->groupEnd()
            ->first();
        if ($duplicate) {
            return redirect()
                ->back()
                ->with('error', 'Register Number or Email already exists');
        }

        $data = [
            'name'       => $this->request->getPost('name'),
            'reg_no'     => $regNo,
            'email'      => $email,
            'college'    => $this->request->getPost('college'),
            'department' => $this->request->getPost('department'),
        ];

        $model->update($id, $data);

        return redirect()->to('/student/list');
    }
    public function list(){
    // 1️⃣ Authentication check
    if (!session()->get('logged_in')) {
        return redirect()->to('/login');
    }

    // 2️⃣ Authorization check
    if (session()->get('role') === 'student') {
        return redirect()->to('/dashboard');
    }

    // 3️⃣ Existing logic stays the same
    $studentModel = new StudentModel();

    $students = $studentModel
                    ->where('is_flagged', 0)
                    ->findAll();

    $data['students'] = $students;
    $data['activePage'] = 'student_list';

    return view('student_list', $data);
}

    public function edit($id)
    {
        // 1️⃣ Authentication check
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        // 2️⃣ Authorization check (ADMIN ONLY)
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard');
        }

        // 3️⃣ Existing logic (UNCHANGED)
        $model = new StudentModel();
        $data['student'] = $model->find($id);
        $data['activePage'] = 'student';

        return view('student_edit', $data);
    }

    public function flag($id){
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard');
        }

        $model = new \App\Models\StudentModel();
        $model->update($id, ['is_flagged' => 1]);

        return redirect()->to('/student/list');
    }

    
}
  
