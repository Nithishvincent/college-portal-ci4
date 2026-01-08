<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'name',
        'reg_no',
        'email',
        'college',
        'department'
    ];
}
