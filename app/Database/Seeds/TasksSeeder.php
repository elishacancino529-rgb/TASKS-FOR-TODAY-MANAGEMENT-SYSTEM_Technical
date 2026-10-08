<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TasksSeeder extends Seeder
{
    public function run()
    {
        $users = $this->db->table('users');
        $user = $users->where('username', 'demo_user')->get()->getRowArray();
        $password = password_hash((string) env('DEMO_PASSWORD', 'TodaylineDemo2026!'), PASSWORD_DEFAULT);
        $now = date('Y-m-d H:i:s');

        if ($user) {
            $userId = (int) $user['id'];
            if (empty($user['password'])) {
                $users->where('id', $userId)->update(['password' => $password]);
            }
        } else {
            $users->insert([
                'username' => 'demo_user',
                'full_name' => 'Demo Student',
                'email' => 'demo@example.com',
                'password' => $password,
                'bio' => 'A little structure makes room for the work that matters.',
                'created_at' => $now,
            ]);
            $userId = (int) $this->db->insertID();
        }

        $tasks = $this->db->table('tasks');
        // Make pre-existing TSA1 tasks manageable by the seeded demo user.
        $tasks->where('user_id', null)->update(['user_id' => $userId]);
        if ($tasks->countAllResults() > 0) {
            return;
        }

        $today = date('Y-m-d');
        $tasks->insertBatch([
            ['user_id' => $userId, 'title' => 'Plan the week ahead', 'description' => 'Choose the three priorities that deserve your attention.', 'task_date' => $today, 'priority' => 'High', 'status' => 'In progress', 'is_archived' => false, 'created_at' => $now],
            ['user_id' => $userId, 'title' => 'Review project notes', 'description' => 'Collect feedback and prepare the next steps.', 'task_date' => $today, 'priority' => 'Normal', 'status' => 'To do', 'is_archived' => false, 'created_at' => $now],
            ['user_id' => $userId, 'title' => 'Send the final update', 'description' => 'Share a concise progress summary with the team.', 'task_date' => $today, 'priority' => 'Low', 'status' => 'Done', 'is_archived' => false, 'created_at' => $now],
            ['user_id' => $userId, 'title' => 'Organize the design files', 'description' => 'Keep the latest assets easy to find.', 'task_date' => date('Y-m-d', strtotime('+1 day')), 'priority' => 'Normal', 'status' => 'To do', 'is_archived' => false, 'created_at' => $now],
        ]);
    }
}
