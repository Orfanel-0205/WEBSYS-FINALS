<?php

namespace App\Models;

use CodeIgniter\Model;

class VoteModel extends Model
{
    protected $table = 'votes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'election_id', 'candidate_id', 'created_at'];
    protected $useTimestamps = false;

    public function getResults($electionId)
    {
        $builder = $this->db->table('votes');
        $builder->select('candidates.name as candidate_name, COUNT(votes.id) as vote_count');
        $builder->join('candidates', 'candidates.id = votes.candidate_id');
        $builder->where('votes.election_id', $electionId);
        $builder->groupBy('votes.candidate_id');
        $builder->orderBy('vote_count', 'DESC');
        return $builder->get()->getResultArray();
    }
}
