<?php

namespace App\Controllers;

class Welcome extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Welcome Page',
            'description' => 'This is my first simple webpage using CodeIgniter 4.'
        ];
        return view('welcome_view', $data);
    }
}
