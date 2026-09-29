<?php

namespace App\Controllers;

use App\Models\TaskModel;
use App\Models\UserModel;

class Tasks extends BaseController
{
    public function index()
    {
        $taskModel = new TaskModel();

        $tasks = $taskModel
            ->where('task_date', date('Y-m-d'))
            ->orderBy('created_at', 'ASC')
            ->findAll();

        return view('tasks/today', [
            'tasks' => $tasks,
        ]);
    }

    public function taskList()
    {
        $taskModel = new TaskModel();

        $tasks = $taskModel
            ->orderBy('task_date', 'ASC')
            ->orderBy('id', 'ASC')
            ->findAll();

        return view('tasks/list', [
            'tasks' => $tasks,
        ]);
    }

    public function profile()
    {
        $userModel = new UserModel();

        $user = $userModel->first();

        return view('tasks/profile', [
            'user' => $user,
        ]);
    }

    public function about()
    {
        return view('tasks/about');
    }
}