<?php

namespace App\Controllers;

use App\Models\VoteModel;
use App\Models\CandidateModel;
use App\Models\ElectionModel;
use CodeIgniter\Controller;

class VoteController extends Controller
{
    protected $voteModel;
    protected $candidateModel;
    protected $electionModel;

    public function __construct()
    {
        $this->voteModel = new VoteModel();
        $this->candidateModel = new CandidateModel();
        $this->electionModel = new ElectionModel();
        helper(['form', 'url', 'security']);
    }

    public function castVote()
    {
        $session = session();
        if (!$session->get('is_logged_in')) {
            return redirect()->to('/login');
        }

        $electionId = $this->request->getPost('election_id');
        $candidateId = $this->request->getPost('candidate_id');
        $userId = $session->get('user_id');

        // Check if user has already voted in this election
        $existingVote = $this->voteModel->where([
            'user_id' => $userId,
            'election_id' => $electionId
        ])->first();

        if ($existingVote) {
            return redirect()->back()->with('error', 'You have already voted in this election');
        }

        $data = [
            'user_id' => $userId,
            'election_id' => $electionId,
            'candidate_id' => $candidateId,
            'created_at' => date('Y-m-d H:i:s')
        ];

        if ($this->voteModel->insert($data)) {
            return redirect()->back()->with('success', 'Vote submitted successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to submit vote');
        }
    }

    public function results($electionId)
    {
        $election = $this->electionModel->find($electionId);
        if (!$election || $election['status'] !== 'completed') {
            return redirect()->back()->with('error', 'Results not available');
        }

        $results = $this->voteModel->getResults($electionId);
        return view('vote/results', [
            'election' => $election,
            'results' => $results
        ]);
    }
}
