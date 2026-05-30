<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function showRegister()
    {
        return view('admin.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'secret_code' => 'required|string',
        ]);

        if ($request->secret_code !== 'KEMIRI-HEBAT-2026') {
            return back()->withErrors(['secret_code' => 'Kode khusus salah! Silakan hubungi pusat.']);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.login')->with('success', 'Akun admin berhasil dibuat! Silakan login.');
    }

    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function dashboard()
    {
        $candidates = \App\Models\Candidate::orderBy('votes_count', 'desc')->get();
        $totalVotes = \App\Models\Candidate::sum('votes_count');
        $articles = \App\Models\Article::where('status', 'published')->orderBy('created_at', 'desc')->get();
        $pendingArticles = \App\Models\Article::where('status', 'pending')->orderBy('created_at', 'desc')->get();
        
        $officials = \App\Models\Official::all();
        $structures = \App\Models\Structure::orderBy('order_num', 'asc')->get();
        $stats = \App\Models\Statistic::all();
        $agendas = \App\Models\Agenda::all();
        $programs = \App\Models\Program::all();
        $products = \App\Models\Product::all();
        $galleries = \App\Models\Gallery::orderBy('created_at', 'desc')->get();
        $feedbacks = \App\Models\Feedback::orderBy('created_at', 'desc')->get();
        $registrations = \App\Models\Registration::orderBy('created_at', 'desc')->get();
        $settings = \App\Models\SiteSetting::pluck('value', 'key')->toArray();
        $unreadFeedbacks = \App\Models\Feedback::where('is_read', false)->count();
        $ads = \App\Models\Advertisement::all();
        $chatMessages = \App\Models\ChatMessage::orderBy('created_at', 'desc')->take(50)->get()->reverse();
        
        return view('admin.dashboard', compact(
            'candidates', 'totalVotes', 'articles', 'pendingArticles',
            'officials', 'structures', 'stats', 'agendas', 'programs', 'products', 'galleries', 'feedbacks', 'registrations', 'settings', 'unreadFeedbacks', 'ads', 'chatMessages'
        ));
    }

    // =============================================
    // ARTICLE MANAGEMENT
    // =============================================
    public function storeArticle(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'author'  => 'nullable|string',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'category'=> 'nullable|string|max:100',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
        }

        \App\Models\Article::create([
            'title'        => $request->title,
            'slug'         => \Illuminate\Support\Str::slug($request->title) . '-' . rand(100, 999),
            'content'      => $request->content,
            'author'       => $request->author ?? 'Admin',
            'status'       => 'published', // Admin default published
            'image'        => $imagePath,
            'published_at' => now(),
        ]);

        return back()->with('success', 'Artikel berhasil diterbitkan!');
    }

    public function updateArticle(Request $request, \App\Models\Article $article)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'author'  => 'nullable|string',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        $data = [
            'title'   => $request->title,
            'content' => $request->content,
            'author'  => $request->author ?? $article->author,
        ];

        if ($request->hasFile('image')) {
            // Delete old image
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        $article->update($data);
        return back()->with('success', 'Artikel berhasil diperbarui!');
    }

    public function deleteArticle(\App\Models\Article $article)
    {
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }
        $article->delete();
        return back()->with('success', 'Artikel berhasil dihapus!');
    }

    public function approveArticle(\App\Models\Article $article)
    {
        $article->update([
            'status' => 'published',
            'published_at' => now(),
        ]);
        return back()->with('success', 'Artikel berhasil disetujui dan ditayangkan!');
    }

    // =============================================
    // CANDIDATE MANAGEMENT
    // =============================================
    public function storeCandidate(Request $request)
    {
        $request->validate([
            'name'               => 'required|string|max:255',
            'vision'             => 'nullable|string',
            'mission'            => 'nullable|string',
            'photo'              => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'nomor_urut'         => 'nullable|integer',
            'asal_ranting'       => 'nullable|string|max:255',
            'jabatan_sebelumnya' => 'nullable|string|max:255',
            'jenis_kelamin'      => 'nullable|string|in:L,P',
            'angkatan'           => 'nullable|string|max:50',
        ]);

        try {
            $photoPath = null;
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('candidates', 'public');
            }

            \App\Models\Candidate::create([
                'name'               => $request->name,
                'vision'             => $request->vision,
                'mission'            => $request->mission,
                'photo'              => $photoPath,
                'nomor_urut'         => $request->nomor_urut,
                'asal_ranting'       => $request->asal_ranting,
                'jabatan_sebelumnya' => $request->jabatan_sebelumnya,
                'jenis_kelamin'      => $request->jenis_kelamin,
                'angkatan'           => $request->angkatan,
                'votes_count'        => 0,
                'is_active'          => true,
            ]);

            return redirect('/admin/dashboard')->with('success', 'Kandidat ' . $request->name . ' berhasil didaftarkan!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menyimpan kandidat: ' . $e->getMessage());
        }
    }

    public function updateCandidate(Request $request, \App\Models\Candidate $candidate)
    {
        $request->validate([
            'name'               => 'required|string|max:255',
            'vision'             => 'nullable|string',
            'mission'            => 'nullable|string',
            'photo'              => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nomor_urut'         => 'nullable|integer',
            'asal_ranting'       => 'nullable|string|max:255',
            'jabatan_sebelumnya' => 'nullable|string|max:255',
            'jenis_kelamin'      => 'nullable|string|in:L,P',
            'angkatan'           => 'nullable|string|max:50',
        ]);

        if ($request->hasFile('photo')) {
            if ($candidate->photo) Storage::disk('public')->delete($candidate->photo);
            $candidate->photo = $request->file('photo')->store('candidates', 'public');
        }

        $candidate->update([
            'name'               => $request->name,
            'vision'             => $request->vision,
            'mission'            => $request->mission,
            'nomor_urut'         => $request->nomor_urut,
            'asal_ranting'       => $request->asal_ranting,
            'jabatan_sebelumnya' => $request->jabatan_sebelumnya,
            'jenis_kelamin'      => $request->jenis_kelamin,
            'angkatan'           => $request->angkatan,
        ]);

        return back()->with('success', 'Kandidat berhasil diperbarui!');
    }

    public function toggleCandidate(\App\Models\Candidate $candidate)
    {
        $candidate->is_active = !$candidate->is_active;
        $candidate->save();
        return back()->with('success', 'Status kandidat berhasil diubah!');
    }

    public function resetVotes(\App\Models\Candidate $candidate)
    {
        $candidate->votes_count = 0;
        $candidate->save();
        \App\Models\Vote::where('candidate_id', $candidate->id)->delete();
        return back()->with('success', 'Suara kandidat berhasil direset!');
    }

    public function resetAllVotes()
    {
        \App\Models\Candidate::query()->update(['votes_count' => 0]);
        \App\Models\Vote::truncate();
        return back()->with('success', 'Seluruh suara berhasil direset ke nol!');
    }

    public function deleteCandidate(\App\Models\Candidate $candidate)
    {
        if ($candidate->photo) Storage::disk('public')->delete($candidate->photo);
        $candidate->delete();
        return back()->with('success', 'Kandidat berhasil dihapus!');
    }

    public function getRealtimeResults()
    {
        $candidates = \App\Models\Candidate::orderBy('votes_count', 'desc')->get();
        $totalVotes = \App\Models\Candidate::sum('votes_count');
        return response()->json([
            'candidates' => $candidates,
            'totalVotes' => $totalVotes
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // =============================================
    // OFFICIALS / PENGURUS MANAGEMENT
    // =============================================
    public function storeOfficial(Request $request)
    {
        $request->validate([
            'name'             => 'required|string',
            'position'         => 'required|string',
            'type'             => 'required|string|in:pimpinan,bph',
            'organization'     => 'nullable|string',
            'section'          => 'nullable|string',
            'photo'            => 'nullable|image|max:2048',
            'description'      => 'nullable|string',
            'birth_place_date' => 'nullable|string',
            'movement_focus'   => 'nullable|string',
            'service_period'   => 'nullable|string',
            'motto'            => 'nullable|string',
        ]);
        $path = $request->hasFile('photo') ? $request->file('photo')->store('officials', 'public') : null;
        \App\Models\Official::create([
            'name'             => $request->name,
            'position'         => $request->position,
            'type'             => $request->type,
            'organization'     => $request->organization,
            'section'          => $request->section,
            'photo'            => $path,
            'birth_place_date' => $request->birth_place_date,
            'movement_focus'   => $request->movement_focus,
            'service_period'   => $request->service_period,
            'motto'            => $request->motto,
        ]);
        return back()->with('success', 'Data pengurus berhasil disimpan!');
    }

    public function deleteOfficial(\App\Models\Official $official)
    {
        if ($official->photo) Storage::disk('public')->delete($official->photo);
        $official->delete();
        return back()->with('success', 'Data pengurus berhasil dihapus!');
    }

    public function updateOfficial(Request $request, \App\Models\Official $official)
    {
        $request->validate([
            'name'             => 'required|string',
            'position'         => 'required|string',
            'type'             => 'required|string|in:pimpinan,bph',
            'organization'     => 'nullable|string',
            'section'          => 'nullable|string',
            'photo'            => 'nullable|image|max:2048',
            'birth_place_date' => 'nullable|string',
            'movement_focus'   => 'nullable|string',
            'service_period'   => 'nullable|string',
            'motto'            => 'nullable|string',
        ]);
        
        if ($request->hasFile('photo')) {
            if ($official->photo) Storage::disk('public')->delete($official->photo);
            $official->photo = $request->file('photo')->store('officials', 'public');
        }
        
        $official->update([
            'name'             => $request->name,
            'position'         => $request->position,
            'type'             => $request->type,
            'organization'     => $request->organization,
            'section'          => $request->section,
            'birth_place_date' => $request->birth_place_date,
            'movement_focus'   => $request->movement_focus,
            'service_period'   => $request->service_period,
            'motto'            => $request->motto,
        ]);
        
        return back()->with('success', 'Data pengurus berhasil diperbarui!');
    }

    // =============================================
    // STRUCTURE / SUSUNAN PENGURUS MANAGEMENT
    // =============================================
    public function storeStructure(Request $request)
    {
        $request->validate([
            'organization'  => 'required|in:IPNU,IPPNU',
            'section_title' => 'required|string|max:255',
            'content'       => 'nullable|string',
            'order_num'     => 'nullable|integer',
        ]);

        \App\Models\Structure::create([
            'organization'  => $request->organization,
            'section_title' => $request->section_title,
            'content'       => $request->content,
            'order_num'     => $request->order_num ?? 0,
        ]);

        return back()->with('success', 'Seksi struktur berhasil ditambahkan!');
    }

    public function updateStructure(Request $request, \App\Models\Structure $structure)
    {
        $request->validate([
            'organization'  => 'required|in:IPNU,IPPNU',
            'section_title' => 'required|string|max:255',
            'content'       => 'nullable|string',
            'order_num'     => 'nullable|integer',
        ]);

        $structure->update([
            'organization'  => $request->organization,
            'section_title' => $request->section_title,
            'content'       => $request->content,
            'order_num'     => $request->order_num ?? 0,
        ]);

        return back()->with('success', 'Seksi struktur berhasil diperbarui!');
    }

    public function deleteStructure(\App\Models\Structure $structure)
    {
        $structure->delete();
        return back()->with('success', 'Seksi struktur berhasil dihapus!');
    }

    // =============================================
    // STATISTICS MANAGEMENT
    // =============================================
    public function storeStatistic(Request $request)
    {
        $request->validate([
            'label' => 'required|string',
            'value' => 'required|integer',
            'icon'  => 'nullable|string|max:10',
        ]);
        \App\Models\Statistic::create([
            'label' => $request->label,
            'value' => $request->value,
            'icon'  => $request->icon ?? '📊',
        ]);
        return back()->with('success', 'Statistik berhasil ditambahkan!');
    }

    public function updateStatistic(Request $request, \App\Models\Statistic $statistic)
    {
        $request->validate([
            'label' => 'required|string',
            'value' => 'required|integer',
            'icon'  => 'nullable|string|max:10',
        ]);
        $statistic->update([
            'label' => $request->label,
            'value' => $request->value,
            'icon'  => $request->icon ?? $statistic->icon,
        ]);
        return back()->with('success', 'Statistik berhasil diperbarui!');
    }

    public function deleteStatistic(\App\Models\Statistic $statistic)
    {
        $statistic->delete();
        return back()->with('success', 'Statistik berhasil dihapus!');
    }

    // =============================================
    // AGENDA MANAGEMENT
    // =============================================
    public function storeAgenda(Request $request)
    {
        $request->validate([
            'title'       => 'required|string',
            'date'        => 'required|date',
            'location'    => 'required|string',
            'description' => 'nullable|string',
        ]);
        \App\Models\Agenda::create([
            'title'    => $request->title,
            'date'     => $request->date,
            'location' => $request->location,
        ]);
        return back()->with('success', 'Agenda berhasil dijadwalkan!');
    }

    public function deleteAgenda(\App\Models\Agenda $agenda)
    {
        $agenda->delete();
        return back()->with('success', 'Agenda berhasil dihapus!');
    }

    // =============================================
    // PRODUCTS / LAPAK MANAGEMENT
    // =============================================
    public function storeProduct(Request $request)
    {
        $request->validate([
            'name'        => 'required|string',
            'price'       => 'required|integer',
            'description' => 'nullable|string',
            'category'    => 'nullable|string',
            'discount'    => 'nullable|integer|min:0|max:99',
            'condition'   => 'nullable|string',
            'stock'       => 'nullable|integer|min:0',
            'location'    => 'nullable|string',
            'sold_count'  => 'nullable|integer|min:0',
            'rating'      => 'nullable|numeric|min:0|max:5',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'wa_link'     => 'nullable|string',
        ]);
        $path = $request->hasFile('image') ? $request->file('image')->store('products', 'public') : null;
        \App\Models\Product::create([
            'name'        => $request->name,
            'description' => $request->description,
            'category'    => $request->category ?? 'Lainnya',
            'price'       => $request->price,
            'discount'    => $request->discount ?? 0,
            'condition'   => $request->condition ?? 'Baru',
            'stock'       => $request->stock ?? 0,
            'location'    => $request->location ?? 'Kemiri, Purworejo',
            'sold_count'  => $request->sold_count ?? 0,
            'rating'      => $request->rating ?? 5.0,
            'wa_link'     => $request->wa_link,
            'image'       => $path,
        ]);
        return back()->with('success', 'Produk lapak berhasil ditambahkan!');
    }

    public function updateProduct(Request $request, \App\Models\Product $product)
    {
        $request->validate([
            'name'        => 'required|string',
            'price'       => 'required|integer',
            'description' => 'nullable|string',
            'category'    => 'nullable|string',
            'discount'    => 'nullable|integer|min:0|max:99',
            'condition'   => 'nullable|string',
            'stock'       => 'nullable|integer|min:0',
            'location'    => 'nullable|string',
            'sold_count'  => 'nullable|integer|min:0',
            'rating'      => 'nullable|numeric|min:0|max:5',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'wa_link'     => 'nullable|string',
        ]);

        $data = [
            'name'        => $request->name,
            'description' => $request->description,
            'category'    => $request->category ?? $product->category,
            'price'       => $request->price,
            'discount'    => $request->discount ?? 0,
            'condition'   => $request->condition ?? $product->condition,
            'stock'       => $request->stock ?? $product->stock,
            'location'    => $request->location ?? $product->location,
            'sold_count'  => $request->sold_count ?? $product->sold_count,
            'rating'      => $request->rating ?? $product->rating,
            'wa_link'     => $request->wa_link,
        ];

        if ($request->hasFile('image')) {
            if ($product->image) Storage::disk('public')->delete($product->image);
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);
        return back()->with('success', 'Produk berhasil diperbarui!');
    }

    public function deleteProduct(\App\Models\Product $product)
    {
        if ($product->image) Storage::disk('public')->delete($product->image);
        $product->delete();
        return back()->with('success', 'Produk berhasil dihapus!');
    }

    // =============================================
    // GALLERY MANAGEMENT
    // =============================================
    public function storeGallery(Request $request)
    {
        $request->validate([
            'title'    => 'required|string',
            'category' => 'required|string',
            'image'    => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:8192',
        ]);
        $path = $request->file('image')->store('gallery', 'public');
        \App\Models\Gallery::create([
            'title'    => $request->title,
            'category' => $request->category,
            'image'    => $path,
        ]);
        return back()->with('success', 'Foto dokumentasi berhasil diunggah!');
    }

    public function updateGallery(Request $request, \App\Models\Gallery $gallery)
    {
        $request->validate([
            'title'    => 'required|string',
            'category' => 'required|string',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:8192',
        ]);

        $data = [
            'title'    => $request->title,
            'category' => $request->category,
        ];

        if ($request->hasFile('image')) {
            if ($gallery->image) Storage::disk('public')->delete($gallery->image);
            $data['image'] = $request->file('image')->store('gallery', 'public');
        }

        $gallery->update($data);
        return back()->with('success', 'Foto galeri berhasil diperbarui!');
    }

    public function deleteGallery(\App\Models\Gallery $gallery)
    {
        if ($gallery->image) Storage::disk('public')->delete($gallery->image);
        $gallery->delete();
        return back()->with('success', 'Foto berhasil dihapus!');
    }

    // =============================================
    // FEEDBACK / RUANG LAPOR MANAGEMENT
    // =============================================
    public function deleteFeedback(\App\Models\Feedback $feedback)
    {
        $feedback->delete();
        return back()->with('success', 'Laporan berhasil dihapus!');
    }

    public function markFeedbackRead(\App\Models\Feedback $feedback)
    {
        $feedback->update(['is_read' => true]);
        return back()->with('success', 'Laporan ditandai sudah dibaca!');
    }

    // =============================================
    // REGISTRATIONS MANAGEMENT
    // =============================================
    public function deleteRegistration(\App\Models\Registration $registration)
    {
        $registration->delete();
        return back()->with('success', 'Pendaftar berhasil dihapus!');
    }
    // =============================================
    // ADVERTISEMENT MANAGEMENT
    // =============================================
    public function storeAd(Request $request)
    {
        $request->validate([
            'title'       => 'required|string',
            'position'    => 'required|string|in:homepage,top_banner',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:4096',
            'price_info'  => 'nullable|string',
            'description' => 'nullable|string',
            'link'        => 'nullable|url',
        ]);

        $data = $request->except(['image', '_token', 'is_active']);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('ads', 'public');
        }

        \App\Models\Advertisement::create($data);
        return back()->with('success', 'Iklan berhasil ditambahkan!');
    }

    public function updateAd(Request $request, \App\Models\Advertisement $ad)
    {
        $request->validate([
            'title'       => 'required|string',
            'position'    => 'required|string|in:homepage,top_banner',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:4096',
            'price_info'  => 'nullable|string',
            'description' => 'nullable|string',
            'link'        => 'nullable|url',
        ]);

        $data = $request->except(['image', '_token', '_method', 'is_active']);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($ad->image) Storage::disk('public')->delete($ad->image);
            $data['image'] = $request->file('image')->store('ads', 'public');
        }

        $ad->update($data);
        return back()->with('success', 'Iklan berhasil diperbarui!');
    }

    public function toggleAd(\App\Models\Advertisement $ad)
    {
        $ad->update(['is_active' => !$ad->is_active]);
        return back()->with('success', 'Status iklan diperbarui!');
    }

    public function deleteAd(\App\Models\Advertisement $ad)
    {
        if ($ad->image) Storage::disk('public')->delete($ad->image);
        $ad->delete();
        return back()->with('success', 'Iklan berhasil dihapus!');
    }
    // =============================================
    // SITE SETTINGS
    // =============================================
    public function updateSettings(Request $request)
    {
        foreach ($request->except('_token') as $key => $value) {
            if ($request->hasFile($key)) {
                $oldSetting = \App\Models\SiteSetting::where('key', $key)->first();
                if ($oldSetting && $oldSetting->value) {
                    Storage::disk('public')->delete($oldSetting->value);
                }
                $value = $request->file($key)->store('settings', 'public');
            }
            \App\Models\SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
        return back()->with('success', 'Informasi portal berhasil diperbarui!');
    }
    // =============================================
    // AGENDA
    // =============================================
    public function storeAgenda(Request $request)
    {
        $request->validate(['title' => 'required|string', 'date' => 'required|date', 'location' => 'required|string']);
        \App\Models\Agenda::create($request->only('title', 'date', 'location'));
        return back()->with('success', 'Agenda berhasil ditambahkan!');
    }
    public function deleteAgenda(\App\Models\Agenda $agenda)
    {
        $agenda->delete();
        return back()->with('success', 'Agenda berhasil dihapus!');
    }

    // =============================================
    // PROGRAM
    // =============================================
    public function storeProgram(Request $request)
    {
        $request->validate(['title' => 'required|string', 'description' => 'nullable|string', 'icon' => 'nullable|string']);
        \App\Models\Program::create($request->only('title', 'description', 'icon'));
        return back()->with('success', 'Program berhasil ditambahkan!');
    }
    public function deleteProgram(\App\Models\Program $program)
    {
        $program->delete();
        return back()->with('success', 'Program berhasil dihapus!');
    }
}
