<?php

namespace App\Models;

use CodeIgniter\Model;

class EvaluationModel extends Model
{
    protected $table = 'project_evaluations';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'project_id',
        'faculty_id',
        'grade',
        'remarks'
    ];

    protected $useTimestamps = false;
}