<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TasksSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $tasks = [
            [
                'title'      => 'Review project requirements',
                'status'     => 'pending',
                'task_date'  => date('Y-m-d'),
                'created_at' => $now,
            ],
            [
                'title'      => 'Create database tables',
                'status'     => 'completed',
                'task_date'  => date('Y-m-d'),
                'created_at' => $now,
            ],
            [
                'title'      => 'Build TaskModel',
                'status'     => 'pending',
                'task_date'  => date('Y-m-d'),
                'created_at' => $now,
            ],
            [
                'title'      => 'Build UserModel',
                'status'     => 'pending',
                'task_date'  => date('Y-m-d', strtotime('+1 day')),
                'created_at' => $now,
            ],
            [
                'title'      => 'Design the dashboard',
                'status'     => 'pending',
                'task_date'  => date('Y-m-d', strtotime('+1 day')),
                'created_at' => $now,
            ],
            [
                'title'      => 'Test the application',
                'status'     => 'pending',
                'task_date'  => date('Y-m-d', strtotime('+2 days')),
                'created_at' => $now,
            ],
            [
                'title'      => 'Create README documentation',
                'status'     => 'pending',
                'task_date'  => date('Y-m-d', strtotime('+2 days')),
                'created_at' => $now,
            ],
            [
                'title'      => 'Prepare GitHub submission',
                'status'     => 'pending',
                'task_date'  => date('Y-m-d', strtotime('+3 days')),
                'created_at' => $now,
            ],
        ];

        $this->db->table('tasks')->insertBatch($tasks);

        $user = [
            'username'   => 'demo_user',
            'full_name'  => 'Demo Student',
            'email'      => 'demo@example.com',
            'created_at' => $now,
        ];

        $this->db->table('users')->insert($user);
    }
}