<?php

namespace App\Controllers;

use App\Models\TaskModel;

class Home extends BaseController
{
    public function index()
    {
        $tasks = (new TaskModel())->active()->orderBy('task_date', 'ASC')->orderBy('id', 'ASC')->findAll();
        $today = date('Y-m-d');
        $todayTasks = array_values(array_filter($tasks, static fn ($task) => $task['task_date'] === $today));
        $upcoming = array_values(array_filter($tasks, static fn ($task) => $task['task_date'] > $today && $task['status'] !== 'Done'));
        $done = count(array_filter($todayTasks, static fn ($task) => $task['status'] === 'Done'));

        return view('home', [
            'pageTitle' => 'Your day, in focus',
            'todayTasks' => $todayTasks,
            'upcoming' => array_slice($upcoming, 0, 3),
            'todayCount' => count($todayTasks),
            'doneCount' => $done,
            'openCount' => count($todayTasks) - $done,
        ]);
    }
}
