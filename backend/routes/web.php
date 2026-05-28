<?php

use App\Models\Article;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VotingController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $articles = Article::where('status', 'published')->orderBy('published_at', 'desc')->paginate(6);
    $popularArticles = Article::where('status', 'published')->orderBy('views_count', 'desc')->take(5)->get();
    $latestArticles = Article::where('status', 'published')->orderBy('published_at', 'desc')->take(5)->get();
    $recentComments = \App\Models\Feedback::latest()->take(3)->get();
    $galleries = \App\Models\Gallery::latest()->take(4)->get();
    $allGalleries = \App\Models\Gallery::latest()->get();
    $officials = \App\Models\Official::all();
    $stats = \App\Models\Statistic::all();
    $products = \App\Models\Product::latest()->get();
    $settings = \App\Models\SiteSetting::pluck('value', 'key')->toArray();
    $ads = \App\Models\Advertisement::where('is_active', true)->get();
    $chatMessages = \App\Models\ChatMessage::orderBy('created_at', 'desc')->take(50)->get()->reverse();
    return view('welcome', compact('articles', 'popularArticles', 'latestArticles', 'recentComments', 'galleries', 'allGalleries', 'officials', 'stats', 'products', 'settings', 'ads', 'chatMessages'));
});

Route::get('/artikel/{slug}', function ($slug) {
    $singleArticle = Article::where('slug', $slug)->where('status', 'published')->firstOrFail();
    $singleArticle->increment('views_count');
    $singleArticle->refresh(); // Ambil data terbaru agar view_count realtime di tampilan
    $comments = \App\Models\Comment::where('article_id', $singleArticle->id)
        ->whereNull('parent_id')
        ->with('replies')
        ->orderBy('created_at', 'desc')
        ->get();
    return view('artikel.show', compact('singleArticle', 'comments'));
})->name('artikel.show');

Route::post('/artikel/{slug}/komentar', function (\Illuminate\Http\Request $request, $slug) {
    $article = Article::where('slug', $slug)->firstOrFail();
    $request->validate(['name' => 'required', 'message' => 'required']);
    
    \App\Models\Comment::create([
        'article_id' => $article->id,
        'parent_id' => $request->parent_id,
        'name' => $request->name,
        'content' => $request->message,
    ]);
    
    $article->increment('comments_count');
    return back()->with('success', 'Komentar berhasil dikirim.');
})->name('komentar.store');

Route::post('/komentar/{id}/like', function ($id) {
    $comment = \App\Models\Comment::findOrFail($id);
    $comment->increment('likes_count');
    return back();
})->name('komentar.like');

// Ruang Lapor (publik - submit feedback)
Route::post('/ruang-lapor', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'name'    => 'required|string|max:255',
        'subject' => 'nullable|string|max:255',
        'contact' => 'nullable|string|max:255',
        'message' => 'required|string',
    ]);
    \App\Models\Feedback::create([
        'name'    => $request->name,
        'subject' => $request->subject ?? 'Laporan Umum',
        'contact' => $request->contact,
        'message' => $request->message,
    ]);
    if ($request->ajax() || $request->wantsJson()) {
        return response()->json(['success' => true]);
    }
    return back()->with('success', 'Laporan berhasil dikirim! Terima kasih.');
})->name('ruang-lapor.store');

// Gabung Sekarang (Registration)
Route::post('/gabung', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:registrations,email',
        'phone' => 'nullable|string|max:20',
        'birth_place' => 'nullable|string|max:100',
        'birth_date' => 'nullable|date',
        'education' => 'nullable|string|max:100',
        'makesta_date' => 'nullable|date',
        'address' => 'nullable|string',
    ], [
        'email.unique' => 'Email ini sudah terdaftar sebelumnya.',
    ]);

    \App\Models\Registration::create($request->all());

    return back()->with('success', 'Pendaftaran Anda berhasil dikirim! Silakan tunggu info lebih lanjut dari Admin.');
})->name('gabung.store');

Route::prefix('profil')->group(function () {
    Route::get('/sejarah', function () { return view('profil.sejarah'); });
    Route::get('/visi-misi', function () { return view('profil.visi-misi'); });
    Route::get('/visi-misi-pac', function () { return view('profil.visi-misi-pac'); });
    Route::get('/nahkoda', function () {
        $pimpinan = \App\Models\Official::where('type', 'pimpinan')->get();
        $bph      = \App\Models\Official::where('type', 'bph')->get();
        return view('profil.nahkoda', compact('pimpinan', 'bph'));
    });
    Route::get('/peta', function () { return view('profil.peta'); });
    Route::get('/lokasi', function () { return view('profil.lokasi'); });
});

Route::prefix('struktur')->group(function () {
    Route::get('/bph', function () {
        $officials = \App\Models\Official::where('type', 'bph')->orderBy('organization')->orderBy('section')->orderBy('position')->get();
        $settings = \App\Models\SiteSetting::pluck('value', 'key')->toArray();
        return view('struktur.bph', compact('officials', 'settings'));
    });
});

Route::prefix('info')->group(function () {
    Route::get('/statistik', function () {
        $stats = \App\Models\Statistic::all();
        return view('info.statistik', compact('stats'));
    });
    Route::get('/usaha', function () {
        $products = \App\Models\Product::latest()->get();
        return view('info.usaha', compact('products'));
    });
});

Route::get('/kontak', function () { return view('kontak'); });



// Voting Routes
Route::get('/voting', [VotingController::class, 'index'])->name('voting');
Route::post('/voting/submit', [VotingController::class, 'vote'])->name('voting.submit');

// Required by Laravel auth middleware - redirects to admin login
Route::get('/login', fn() => redirect()->route('admin.login'))->name('login');

// Admin Auth Routes
Route::get('/admin/register', [AdminController::class, 'showRegister'])->name('admin.register');
Route::post('/admin/register', [AdminController::class, 'register']);
Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Protected Admin Dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    
    // Chatbot Routes
    Route::get('/admin/chat', [ChatController::class, 'index'])->name('admin.chat');
    Route::post('/admin/chat/send', [ChatController::class, 'send'])->name('admin.chat.send');

    Route::get('/admin/candidates', fn() => redirect('/admin/dashboard'))->name('admin.candidates.index');
    Route::post('/admin/candidates', [AdminController::class, 'storeCandidate'])->name('admin.candidates.store');
    Route::post('/admin/candidates/reset-all', [AdminController::class, 'resetAllVotes'])->name('admin.candidates.reset-all');
    Route::put('/admin/candidates/{candidate}', [AdminController::class, 'updateCandidate'])->name('admin.candidates.update');
    Route::patch('/admin/candidates/{candidate}/toggle', [AdminController::class, 'toggleCandidate'])->name('admin.candidates.toggle');
    Route::post('/admin/candidates/{candidate}/reset', [AdminController::class, 'resetVotes'])->name('admin.candidates.reset');
    Route::delete('/admin/candidates/{candidate}', [AdminController::class, 'deleteCandidate'])->name('admin.candidates.delete');
    Route::get('/admin/realtime-results', [AdminController::class, 'getRealtimeResults'])->name('admin.realtime-results');
    
    // Article Management
    Route::post('/admin/articles', [AdminController::class, 'storeArticle'])->name('admin.articles.store');
    Route::put('/admin/articles/{article}', [AdminController::class, 'updateArticle'])->name('admin.articles.update');
    Route::delete('/admin/articles/{article}', [AdminController::class, 'deleteArticle'])->name('admin.articles.delete');
    Route::patch('/admin/articles/{article}/approve', [AdminController::class, 'approveArticle'])->name('admin.articles.approve');

    // Officials / Pengurus Management (Nahkoda)
    Route::post('/admin/officials', [AdminController::class, 'storeOfficial'])->name('admin.officials.store');
    Route::put('/admin/officials/{official}', [AdminController::class, 'updateOfficial'])->name('admin.officials.update');
    Route::delete('/admin/officials/{official}', [AdminController::class, 'deleteOfficial'])->name('admin.officials.delete');

    // Structure / Susunan Pengurus Management
    Route::post('/admin/structures', [AdminController::class, 'storeStructure'])->name('admin.structures.store');
    Route::put('/admin/structures/{structure}', [AdminController::class, 'updateStructure'])->name('admin.structures.update');
    Route::delete('/admin/structures/{structure}', [AdminController::class, 'deleteStructure'])->name('admin.structures.delete');

    // Statistics Management
    Route::post('/admin/stats', [AdminController::class, 'storeStatistic'])->name('admin.stats.store');
    Route::put('/admin/stats/{statistic}', [AdminController::class, 'updateStatistic'])->name('admin.stats.update');
    Route::delete('/admin/stats/{statistic}', [AdminController::class, 'deleteStatistic'])->name('admin.stats.delete');

    // Agenda Management
    Route::post('/admin/agendas', [AdminController::class, 'storeAgenda'])->name('admin.agendas.store');
    Route::delete('/admin/agendas/{agenda}', [AdminController::class, 'deleteAgenda'])->name('admin.agendas.delete');

    // Products / Lapak Management
    Route::post('/admin/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    Route::put('/admin/products/{product}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('/admin/products/{product}', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');

    // Gallery Management
    Route::post('/admin/gallery', [AdminController::class, 'storeGallery'])->name('admin.gallery.store');
    Route::put('/admin/gallery/{gallery}', [AdminController::class, 'updateGallery'])->name('admin.gallery.update');
    Route::delete('/admin/gallery/{gallery}', [AdminController::class, 'deleteGallery'])->name('admin.gallery.delete');

    // Feedback / Ruang Lapor Management
    Route::delete('/admin/feedbacks/{feedback}', [AdminController::class, 'deleteFeedback'])->name('admin.feedbacks.delete');
    Route::patch('/admin/feedbacks/{feedback}/read', [AdminController::class, 'markFeedbackRead'])->name('admin.feedbacks.read');

    // Registrations (Pendaftar Baru)
    Route::delete('/admin/registrations/{registration}', [AdminController::class, 'deleteRegistration'])->name('admin.registrations.delete');

    // Site Settings
    Route::post('/admin/settings', [AdminController::class, 'updateSettings'])->name('admin.settings.update');

    // Advertisements Management
    Route::post('/admin/ads', [AdminController::class, 'storeAd'])->name('admin.ads.store');
    Route::put('/admin/ads/{ad}', [AdminController::class, 'updateAd'])->name('admin.ads.update');
    Route::delete('/admin/ads/{ad}', [AdminController::class, 'deleteAd'])->name('admin.ads.delete');
    Route::patch('/admin/ads/{ad}/toggle', [AdminController::class, 'toggleAd'])->name('admin.ads.toggle');
});

// Public Article Submission
Route::post('/artikel/submit-public', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'title'   => 'required|string|max:255',
        'author'  => 'required|string|max:255',
        'contact' => 'nullable|string|max:255', // opsional kontak
        'content' => 'required|string',
        'image'   => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // maks 2MB
    ]);

    $imagePath = $request->file('image')->store('articles', 'public');
    
    // Create the article with status 'pending'
    \App\Models\Article::create([
        'title'        => $request->title,
        'slug'         => \Illuminate\Support\Str::slug($request->title) . '-' . time(),
        'content'      => $request->content,
        'author'       => $request->author . ($request->contact ? ' (' . $request->contact . ')' : ''), // Menyisipkan kontak di belakang author sbg referensi admin
        'status'       => 'pending',
        'image'        => $imagePath,
        'published_at' => now(),
    ]);

    return back()->with('success_article', 'Artikel Anda berhasil dikirim! Kami akan mereviewnya sebelum diterbitkan.');
})->name('artikel.submit.public');

// Public Chatbot Submission
Route::post('/chat/send-public', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'message' => 'required|string|max:1000',
    ]);
    
    // Store user message (anonymous)
    $userMessage = \App\Models\ChatMessage::create([
        'author' => 'Pengunjung',
        'content' => $request->message,
    ]);
    
    // Bot reply
    $botMessage = \App\Models\ChatMessage::create([
        'author' => 'Bot',
        'content' => "Halo! Pesan Anda: " . $request->message,
    ]);
    
    return response()->json([
        'user' => $userMessage,
        'bot' => $botMessage,
    ]);
})->name('chat.send.public');

// Temporary route to run migrations because terminal is restricted
Route::get('/migrate-db', function() {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        return "Database & Storage Link success! <br><pre>" . \Illuminate\Support\Facades\Artisan::output() . "</pre><a href='/admin/dashboard'>Back to Dashboard</a>";
    } catch (\Exception $e) {
        return "Migration failed: " . $e->getMessage() . "<br><a href='/admin/dashboard'>Go to Dashboard anyway</a>";
    }
});
