<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    /**
     * Store a new registration.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:registrations,email',
            'phone' => 'nullable|string|max:30',
            'birth_place' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'education' => 'nullable|string|max:255',
            'makesta_date' => 'nullable|date',
            'address' => 'nullable|string',
        ]);

        Registration::create($validated);

        return back()->with('success', 'Pendaftaran berhasil disimpan. Terima kasih!');
    }
}
?>
