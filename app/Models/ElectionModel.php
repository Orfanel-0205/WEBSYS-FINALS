<?php

namespace App\Models;

use CodeIgniter\Model;

class ElectionModel extends Model
{
    protected $table = 'elections';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'description', 'start_date', 'end_date', 'status', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function getActiveElections()
    {
        $currentDate = date('Y-m-d H:i:s');
        return $this->where('start_date <=', $currentDate)
                   ->where('end_date >=', $currentDate)
                   ->where('status', 'active')
                   ->findAll();
    }

    public function getCompletedElections()
    {
        $currentDate = date('Y-m-d H:i:s');
        return $this->where('end_date <', $currentDate)
                   ->where('status', 'completed')
                   ->findAll();
    }
}
