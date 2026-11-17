<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Http\Request;

class VotingController extends Controller
{
    public function index(Request $request)
    {
        $passcodeSetting = \App\Models\SiteSetting::where('key', 'voting_passcode')->first();
        $passcode = $passcodeSetting && !empty($passcodeSetting->value) ? $passcodeSetting->value : 'KEMIRI2026';
        
        $isAuthenticated = $request->session()->get('voting_authenticated', false);

        if (!$isAuthenticated) {
            return view('voting.auth');
        }

        $candidates = Candidate::all();
        $totalVotes = Candidate::sum('votes_count');
        $targetVotes = 1200; // Target tetap statis atau bisa diambil dari setting
        
        return view('voting.index', compact('candidates', 'totalVotes', 'targetVotes'));
    }

    public function authenticate(Request $request)
    {
        $request->validate(['passcode' => 'required|string']);
        $passcodeSetting = \App\Models\SiteSetting::where('key', 'voting_passcode')->first();
        $passcode = $passcodeSetting && !empty($passcodeSetting->value) ? $passcodeSetting->value : 'KEMIRI2026';

        if ($request->passcode === $passcode) {
            $request->session()->put('voting_authenticated', true);
            return redirect()->route('voting')->with('success', 'Akses E-Voting Terbuka!');
        }

        return back()->with('error', 'Kode Keamanan Salah!');
    }

    public function vote(Request $request)
    {
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id'
        ]);

        $voterId = $request->session()->getId(); // Menggunakan session id agar beda profil / akun google bisa memilih

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
