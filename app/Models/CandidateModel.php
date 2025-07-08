<?php

namespace App\Models;

use CodeIgniter\Model;

class CandidateModel extends Model
{
    protected $table = 'candidates';
    protected $primaryKey = 'id';
    protected $allowedFields = ['election_id', 'name', 'description', 'photo', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function getCandidatesByElection($electionId)
    {
        return $this->where('election_id', $electionId)->findAll();
    }
}
