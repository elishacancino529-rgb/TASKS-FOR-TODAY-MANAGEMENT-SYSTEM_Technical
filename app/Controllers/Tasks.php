<?php

namespace App\Controllers;

use App\Models\TaskModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Tasks extends BaseController
{
    public function index()
    {
        $status = (string) $this->request->getGet('status');
        $validStatuses = ['To do', 'In progress', 'Done'];
        $model = (new TaskModel())->active();
        if (in_array($status, $validStatuses, true)) {
            $model->where('status', $status);
        } else {
            $status = '';
        }

        return view('tasks/index', [
            'pageTitle' => 'All tasks',
            'tasks' => $model->orderBy('task_date', 'ASC')->orderBy('id', 'DESC')->findAll(),
            'statusFilter' => $status,
        ]);
    }

    public function new()
    {
        return view('tasks/form', ['pageTitle' => 'New task', 'task' => null, 'formAction' => site_url('tasks')]);
    }

    public function create()
    {
        $data = $this->taskData();
        if (! $this->validateData($data, $this->taskRules())) {
            return redirect()->to('/tasks/new')->withInput()->with('errors', $this->validator->getErrors());
        }
        $data['user_id'] = (int) session('user_id');
        (new TaskModel())->insert($data);
        return redirect()->to('/tasks')->with('success', 'Task created.');
    }

    public function edit(int $id)
    {
        $task = $this->ownedTask($id);
        return view('tasks/form', [
            'pageTitle' => 'Edit task',
            'task' => $task,
            'formAction' => site_url('tasks/' . $id),
        ]);
    }

    public function update(int $id)
    {
        $this->ownedTask($id);
        $data = $this->taskData();
        if (! $this->validateData($data, $this->taskRules())) {
            return redirect()->to('/tasks/' . $id . '/edit')->withInput()->with('errors', $this->validator->getErrors());
        }
        (new TaskModel())->update($id, $data);
        return redirect()->to('/tasks')->with('success', 'Task updated.');
    }

    public function archive(int $id)
    {
        $this->ownedTask($id);
        (new TaskModel())->update($id, ['is_archived' => 1]);
        return redirect()->to('/tasks')->with('success', 'Task archived.');
    }

    private function ownedTask(int $id): array
    {
        $task = (new TaskModel())->active()->where('user_id', (int) session('user_id'))->find($id);
        if (! $task) {
            throw PageNotFoundException::forPageNotFound('Task not found.');
        }
        return $task;
    }

    private function taskData(): array
    {
        return [
            'title' => trim((string) $this->request->getPost('title')),
            'description' => trim((string) $this->request->getPost('description')),
            'task_date' => trim((string) $this->request->getPost('task_date')),
            'priority' => (string) $this->request->getPost('priority'),
            'status' => (string) $this->request->getPost('status'),
        ];
    }

    private function taskRules(): array
    {
        return [
            'title' => 'required|max_length[180]',
            'description' => 'permit_empty|max_length[2000]',
            'task_date' => 'required|valid_date[Y-m-d]',
            'priority' => 'required|in_list[Low,Normal,High]',
            'status' => 'required|in_list[To do,In progress,Done]',
        ];
    }
}
