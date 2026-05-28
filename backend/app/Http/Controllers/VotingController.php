<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Http\Request;

class VotingController extends Controller
{
    public function index()
    {
        $candidates = Candidate::all();
        $totalVotes = Candidate::sum('votes_count');
        $targetVotes = 1200; // Target tetap statis atau bisa diambil dari setting
        
        return view('voting', compact('candidates', 'totalVotes', 'targetVotes'));
    }

    public function vote(Request $request)
    {
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id'
        ]);

        $voterId = $request->ip(); // Bisa diganti dengan session atau kombinasi browser fingerprint

        // Cek apakah sudah pernah voting
        $existingVote = Vote::where('voter_id', $voterId)->first();
        if ($existingVote) {
            return response()->json(['success' => false, 'message' => 'Anda sudah memberikan suara!'], 403);
        }

        // Simpan suara
        Vote::create([
            'candidate_id' => $request->candidate_id,
            'voter_id' => $voterId
        ]);

        // Increment count di tabel candidates (opsional untuk kecepatan baca)
        $candidate = Candidate::find($request->candidate_id);
        $candidate->increment('votes_count');

        return response()->json([
            'success' => true, 
            'message' => 'Suara berhasil direkam!',
            'new_total' => Candidate::sum('votes_count'),
            'candidates' => Candidate::all()
        ]);
    }
}
