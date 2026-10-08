<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table = 'tasks';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'title', 'description', 'task_date', 'priority', 'status', 'is_archived'];
    protected $useTimestamps = true;
    protected $returnType = 'array';

    public function active(): self
    {
        return $this->where('is_archived', false);
    }
}
