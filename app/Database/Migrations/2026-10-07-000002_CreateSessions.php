<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSessions extends Migration
{
    public function up()
    {
        if ($this->db->DBDriver === 'Postgre') {
            $this->db->query('CREATE TABLE IF NOT EXISTS ci_sessions (id varchar(128) NOT NULL, ip_address inet NOT NULL, "timestamp" timestamptz DEFAULT CURRENT_TIMESTAMP NOT NULL, data bytea DEFAULT \'\' NOT NULL)');
            $this->db->query('CREATE INDEX IF NOT EXISTS ci_sessions_timestamp ON ci_sessions ("timestamp")');
            return;
        }

        $this->db->query('CREATE TABLE IF NOT EXISTS ci_sessions (id varchar(128) NOT NULL, ip_address varchar(45) NOT NULL, `timestamp` timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL, data blob NOT NULL, KEY ci_sessions_timestamp (`timestamp`))');
    }

    public function down()
    {
        $this->forge->dropTable('ci_sessions', true);
    }
}
