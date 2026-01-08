<?php

namespace App\Controllers;

use App\Models\EvaluationModel;
use App\Models\ProjectModel;

class Evaluation extends BaseController
{
    public function evaluate($projectId)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        if (session()->get('role') !== 'faculty') {
            return redirect()->to('/dashboard');
        }

        $evaluationModel = new EvaluationModel();

        // 🔒 CHECK IF PROJECT ALREADY EVALUATED
        $existing = $evaluationModel
                        ->where('project_id', $projectId)
                        ->first();

        if ($existing) {
            return redirect()->to('/project/list')
                            ->with('error', 'This project has already been evaluated');
        }

        $projectModel = new ProjectModel();
        $project = $projectModel->find($projectId);

        return view('evaluation_form', ['project' => $project]);
    }
    


    public function save()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'faculty') {
            return redirect()->to('/login');
        }

        $projectId = $this->request->getPost('project_id');

        $evaluationModel = new \App\Models\EvaluationModel();

        // 1️⃣ Save evaluation
        $evaluationModel->insert([
            'project_id' => $projectId,
            'grade'      => $this->request->getPost('grade'),
            'remarks'    => $this->request->getPost('remarks')
        ]);

        // 2️⃣ UPDATE PROJECT STATUS HERE ⬇⬇⬇
        $db = \Config\Database::connect();
        $db->table('projects')
        ->where('id', $projectId)
        ->update(['status' => 'graded']);

        return redirect()->to('/project/list')
                        ->with('success', 'Evaluation submitted');
    }

    public function edit($projectId)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        if (session()->get('role') !== 'faculty') {
            return redirect()->to('/dashboard');
        }

        $evaluationModel = new \App\Models\EvaluationModel();
        $projectModel    = new \App\Models\ProjectModel();

        $evaluation = $evaluationModel
                        ->where('project_id', $projectId)
                        ->first();

        if (!$evaluation) {
            return redirect()->to('/project/list');
        }

        $project = $projectModel->find($projectId);

        return view('evaluation_form', [
            'project'    => $project,
            'evaluation' => $evaluation,
            'isEdit'     => true
        ]);
    }
public function update($projectId)
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'faculty') {
            return redirect()->to('/login');
        }

        $evaluationModel = new \App\Models\EvaluationModel();

        // 1️⃣ Update evaluation
        $evaluationModel
            ->where('project_id', $projectId)
            ->set([
                'grade'   => $this->request->getPost('grade'),
                'remarks' => $this->request->getPost('remarks')
            ])
            ->update();

        // 2️⃣ UPDATE PROJECT STATUS HERE ⬇⬇⬇
        $db = \Config\Database::connect();
        $db->table('projects')
        ->where('id', $projectId)
        ->update(['status' => 'graded']);

        return redirect()->to('/project/list')
                        ->with('success', 'Evaluation updated');
    }
}

