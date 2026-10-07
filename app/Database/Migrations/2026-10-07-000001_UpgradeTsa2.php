<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpgradeTsa2 extends Migration
{
    public function up()
    {
        // Add to the TSA1 tables so existing users and tasks remain in place.
        $this->forge->addColumn('users', [
            'password' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'bio' => ['type' => 'TEXT', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addColumn('tasks', [
            'user_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'description' => ['type' => 'TEXT', 'null' => true],
            'priority' => ['type' => 'VARCHAR', 'constraint' => 10, 'default' => 'Normal'],
            'is_archived' => ['type' => 'BOOLEAN', 'default' => false],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->db->table('tasks')->where('status', 'pending')->update(['status' => 'To do']);
        $this->db->table('tasks')->where('status', 'completed')->update(['status' => 'Done']);
    }

    public function down()
    {
        $this->db->table('tasks')->where('status', 'To do')->update(['status' => 'pending']);
        $this->db->table('tasks')->where('status', 'In progress')->update(['status' => 'pending']);
        $this->db->table('tasks')->where('status', 'Done')->update(['status' => 'completed']);
        foreach (['user_id', 'description', 'priority', 'is_archived', 'updated_at'] as $column) {
            $this->forge->dropColumn('tasks', $column);
        }
        foreach (['password', 'bio', 'updated_at'] as $column) {
            $this->forge->dropColumn('users', $column);
        }
    }
}
