<?php

namespace App\Controllers;

class College extends BaseController
{
    public function index()
    {
        return view('college_home');
    }
}