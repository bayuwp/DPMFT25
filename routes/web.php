<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ParsingDataController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\PengawasanController;
use App\Http\Controllers\PublicPengawasanController;
use App\Http\Controllers\PengawasanPKKMBPublicController;
use App\Http\Controllers\PPLFTUserController;
use App\Http\Controllers\JurusanLoginController;
use App\Http\Controllers\PublicBphController;
use App\Http\Controllers\PublicKomisi1Controller;
use App\Http\Controllers\PublicKomisi2Controller;
use App\Http\Controllers\PublicKomisi3Controller;
use App\Http\Controllers\PublicKomisi4Controller;
use App\Http\Controllers\CabinetController;
use App\Http\Controllers\AgendaTeknikVisionController;
use App\Http\Controllers\Auth\PPLFTLoginController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\PengawasanAdminController;
use App\Http\Controllers\Admin\AdminProkerController;
use App\Http\Controllers\Admin\PengawasanPKKMBController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\PPLFTAdminController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BphController;
use App\Http\Controllers\Admin\Komisi1Controller;
use App\Http\Controllers\Admin\Komisi2Controller;
use App\Http\Controllers\Admin\Komisi3Controller;
use App\Http\Controllers\Admin\Komisi4Controller;
use App\Http\Controllers\Admin\AdminTeknikVisionController;

// Halaman utama (dashboard)
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Parsing data (tanpa autentikasi)
Route::get('/parse-data/{nama_lengkap}/{email}/{jenis_kelamin}', [ParsingDataController::class, 'parseData']);

// Auth bawaan Laravel (login, register, dll)
Auth::routes();

// Halaman Home setelah login
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/visi-misi', function () {
    return view('visi-misi');
});
Route::get('/struktur', function (){
    return view('struktur');
});
Route::get('/arsip', function () {
    return view('arsip');
});
Route::get('/agenda', function () {
    return view('agenda');
});


// Group dengan middleware auth untuk dashboard
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    // Route tambahan dashboard lainnya bisa ditambahkan di sini
    Route::redirect('/test', '/dashboard');
});

// Public routes (jika masih dibutuhkan)
Route::resource('home', HomeController::class)->only(['index']);
Route::resource('contact', ContactController::class)->only(['index']);


// User minta izin edit
Route::post('/pengawasan/{slug}/proker/{id}/request-edit', [PublicPengawasanController::class, 'requestEdit'])->name('proker.requestEdit');

// Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/proker-edit-requests', [PublicPengawasanController::class, 'listEditRequests'])->name('proker.editRequests');
    Route::post('/pengawasan/{slug}/proker/{id}/approve', [PublicPengawasanController::class, 'approveEdit'])->name('proker.approve');
    Route::post('/pengawasan/{slug}/proker/{id}/reject', [PublicPengawasanController::class, 'rejectEdit'])->name('proker.reject');
});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');
    Route::get('/', [AdminController::class, 'index'])->name('index');

    // Update status proposal dan LPJ
    Route::put('ppl-ft/{slug}/proker/{id}/status', [PPLFTAdminController::class, 'updateStatus'])
        ->name('ppl-ft.proker.updateStatus');

    Route::prefix('ppl-ft')->name('ppl-ft.')->group(function () {
        Route::get('/', [PPLFTAdminController::class, 'index'])->name('index');
        Route::get('/{slug}', [PPLFTAdminController::class, 'show'])->name('show');
        Route::post('/{slug}/chat', [PPLFTAdminController::class, 'sendChat'])->name('chat.send');

        // ✅ Route untuk update link GForm
        Route::put('/{slug}/proker/{id}/link', [PPLFTAdminController::class, 'updateLink'])
            ->name('proker.updateLink');
    });


});

Route::prefix('admin/tentang-kami')->name('admin.')->group(function () {
    // BPH
    Route::get('bph', [BphController::class, 'index'])->name('bph.index');
    Route::post('bph', [BphController::class, 'store'])->name('bph.store');
    Route::get('bph/{id}/edit', [BphController::class, 'edit'])->name('bph.edit');
    Route::put('bph/{id}', [BphController::class, 'update'])->name('bph.update');
    Route::delete('bph/{id}', [BphController::class, 'destroy'])->name('bph.destroy');

    // Komisi 1
    Route::get('komisi-1', [Komisi1Controller::class, 'index'])->name('komisi1.index');
    Route::post('komisi-1', [Komisi1Controller::class, 'store'])->name('komisi1.store');
    Route::get('komisi-1/{id}/edit', [Komisi1Controller::class, 'edit'])->name('komisi1.edit');
    Route::put('komisi-1/{id}', [Komisi1Controller::class, 'update'])->name('komisi1.update');
    Route::delete('komisi-1/{id}', [Komisi1Controller::class, 'destroy'])->name('komisi1.destroy');

    // Komisi 2
    Route::get('komisi-2', [Komisi2Controller::class, 'index'])->name('komisi2.index');
    Route::post('komisi-2', [Komisi2Controller::class, 'store'])->name('komisi2.store');
    Route::get('komisi-2/{id}/edit', [Komisi2Controller::class, 'edit'])->name('komisi2.edit');
    Route::put('komisi-2/{id}', [Komisi2Controller::class, 'update'])->name('komisi2.update');
    Route::delete('komisi-2/{id}', [Komisi2Controller::class, 'destroy'])->name('komisi2.destroy');

    // Komisi 3
    Route::get('komisi-3', [Komisi3Controller::class, 'index'])->name('komisi3.index');
    Route::post('komisi-3', [Komisi3Controller::class, 'store'])->name('komisi3.store');
    Route::get('komisi-3/{id}/edit', [Komisi3Controller::class, 'edit'])->name('komisi3.edit');
    Route::put('komisi-3/{id}', [Komisi3Controller::class, 'update'])->name('komisi3.update');
    Route::delete('komisi-3/{id}', [Komisi3Controller::class, 'destroy'])->name('komisi3.destroy');

    // Komisi 4
    Route::get('komisi-4', [Komisi4Controller::class, 'index'])->name('komisi4.index');
    Route::post('komisi-4', [Komisi4Controller::class, 'store'])->name('komisi4.store');
    Route::get('komisi-4/{id}/edit', [Komisi4Controller::class, 'edit'])->name('komisi4.edit');
    Route::put('komisi-4/{id}', [Komisi4Controller::class, 'update'])->name('komisi4.update');
    Route::delete('komisi-4/{id}', [Komisi4Controller::class, 'destroy'])->name('komisi4.destroy');
});




Route::prefix('admin')->middleware(['auth', 'is_admin'])->name('admin.')->group(function () {

    // Berita
    Route::resource('berita', BeritaController::class)->parameters([
        'berita' => 'berita'
    ]);
    Route::put('berita/{berita}', [BeritaController::class, 'update'])->name('berita.update');

    Route::resource('cabinets', CabinetController::class)
        ->parameters(['cabinets' => 'cabinet']);

    // Agenda admin
    Route::get('/agenda', function () {
        return view('admin.agenda.index');
    })->name('agenda.index');

    // Pengawasan admin
    Route::prefix('pengawasan')
        ->name('pengawasan.')
        ->group(function () {

            Route::get('/', [PengawasanAdminController::class, 'index'])->name('index');
            Route::get('/create', [PengawasanAdminController::class, 'create'])->name('create');
            Route::post('/', [PengawasanAdminController::class, 'store'])->name('store');

            Route::get('/{pengawasan}/edit', [PengawasanAdminController::class, 'edit'])->name('edit');
            Route::put('/{pengawasan}', [PengawasanAdminController::class, 'update'])->name('update');
            Route::delete('/{pengawasan}', [PengawasanAdminController::class, 'destroy'])->name('destroy');

            // Tambahan untuk approve/reject permintaan edit
            Route::post('/{slug}/{id}/approve', [PengawasanAdminController::class, 'approveEdit'])->name('approve');
            Route::post('/{slug}/{id}/reject', [PengawasanAdminController::class, 'rejectEdit'])->name('reject');

            Route::post('/{slug}/{id}/upload-berita', [PengawasanAdminController::class, 'uploadBerita'])->name('uploadBerita');
            Route::put('/{slug}/{id}/status', [PengawasanAdminController::class, 'updateStatus'])->name('updateStatus');

            // Detail show jurusan, letakkan paling bawah agar tidak bentrok dengan 'create' atau 'edit'
            Route::get('/{slug}', [PengawasanAdminController::class, 'show'])->name('show');
        });
    // Proker
    Route::prefix('proker')->name('proker.')->group(function () {
        Route::get('/create/{pengawasan}', [AdminProkerController::class, 'create'])->name('create');
        Route::post('/', [AdminProkerController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdminProkerController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminProkerController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminProkerController::class, 'destroy'])->name('destroy');
    });



    // PKKMB
    Route::resource('pengawasan-pkkmb', PengawasanPKKMBController::class);
});

Route::prefix('ppl-ft')->name('ppl-ft.')->group(function () {
    // Halaman daftar jurusan (bisa diakses tanpa login)
    Route::get('/', [PPLFTUserController::class, 'index'])->name('index');

    // Logout
    Route::post('/logout', [PPLFTLoginController::class, 'logout'])->name('logout');

    // Halaman show jurusan (butuh login dan cocok dengan email slug)
    Route::middleware(['auth', 'pplft.user'])->group(function () {
        Route::get('/{slug}', [PPLFTUserController::class, 'show'])->name('show');

        // Chat POST
        Route::post('/{slug}/chat', function (\Illuminate\Http\Request $request, $slug) {
            \App\Models\Chat::create([
                'jurusan_slug' => $slug,
                'sender' => auth()->user()->name ?? 'Guest',
                'message' => $request->message,
            ]);
            return redirect()->back();
        })->name('chat.send');

        // Store Proker
        Route::post('/{slug}/proker/store', [PPLFTUserController::class, 'store'])->name('proker.store');

        // Update Proposal
        Route::put('/{slug}/proker/{id}/proposal', [PPLFTUserController::class, 'updateProposal'])
            ->name('proker.updateProposal');

        // Update LPJ
        Route::put('{slug}/proker/{id}/lpj', [PPLFTUserController::class, 'updateLpj'])
            ->name('proker.updateLpj');

        // ✅ Update Link Dokumentasi atau Time Stap
        Route::post('/{slug}/proker/{id}/{field}/update-link', [PPLFTUserController::class, 'updateLinkDokumen'])
            ->name('proker.updateLinkDokumen');
    });
});

Route::get('/agenda/pengawasan', [PengawasanController::class, 'selectJurusan'])->name('pengawasan.select');

    Route::get('/agenda/pengawasan/{slug}/login', [PengawasanController::class, 'loginJurusan'])->name('jurusan.login');
    Route::get('/agenda/pengawasan/{slug}', [PengawasanController::class, 'show'])->name('pengawasan.detail');

Route::middleware(['auth'])->group(function () {

});
Route::get('/pengawasan', [PengawasanController::class, 'SelectJurusan'])->name('pengawasan.select');

Route::get('/pengawasan/login/{slug}', [PengawasanController::class, 'loginJurusan'])->name('pengawasan.login');
    Route::get('/pengawasan/detail/{slug}', [PengawasanController::class, 'show'])->name('pengawasan.detail');
    Route::get('/jurusan/{slug}', [JurusanLoginController::class, 'showJurusan'])->name('jurusan.login');
    Route::post('/jurusan/{slug}', [JurusanLoginController::class, 'login'])->name('jurusan.login.post');
    Route::get('/agenda/pengawasan/detail', [PengawasanController::class, 'detail'])->name('pengawasan.detail');
    Route::get('/proker/{slug}', [ProkerPublikController::class, 'detailPublik'])->name('proker.public');

// Route::get('/login/{slug}', [JurusanLoginController::class, 'showLoginForm'])->name('jurusan.login');
// Route::post('/login', [JurusanLoginController::class, 'login']);

    // Login khusus per jurusan (tanpa login dulu)
    Route::get('/ppl-ft/login/{slug}', [PPLFTLoginController::class, 'showLoginForm'])->name('ppl-ft.login');
    Route::post('/ppl-ft/login/{slug}', [PPLFTLoginController::class, 'login'])->name('ppl-ft.login.submit');
    Route::get('/ppl-ft/{slug}/proker/{id}', [PPLFTUserController::class, 'prokerDetail'])->name('pplft.proker.detail');
    Route::post('/ppl-ft/{slug}/proker/{id}/dokumen/{field}', [PPLFTUserController::class, 'updateDokumen'])
        ->name('ppl-ft.proker.updateDokumen');
    Route::get('/ppl-ft/proker/{slug}/{id}/validasi-status', [PPLFTUserController::class, 'validasiStatus'])->name('ppl-ft.proker.validasiStatus');


Route::prefix('agenda/pengawasan')->group(function () {
    Route::get('/', [PublicPengawasanController::class, 'index'])->name('index');
    Route::get('{slug}', [PublicPengawasanController::class, 'show'])->name('pengawasan.show');
    Route::get('{slug}/{id}', [PublicPengawasanController::class, 'prokerDetail'])->name('proker.detail');
    Route::get('{slug}/{id}/edit', [PublicPengawasanController::class, 'edit'])->name('proker.edit');
    Route::post('{slug}', [PublicPengawasanController::class, 'store'])->name('proker.store');
    Route::put('/{slug}/{id}', [PublicPengawasanController::class, 'update'])->name('pengawasan.update');
    Route::delete('{slug}/{id}', [PublicPengawasanController::class, 'destroy'])->name('proker.destroy');
});

// Tentang Kami
Route::prefix('tentang-kami')->group(function () {
    Route::get('/parlemen', function () {
        return view('tentang-kami.parlemen');
    })->name('tentang-kami.parlemen');
});
Route::get('/tentang-kami/bph', [PublicBphController::class, 'index'])->name('tentangKami.bph');
Route::get('/tentang-kami/komisi-1', [PublicKomisi1Controller::class, 'index'])->name('komisi1');
Route::get('/tentang-kami/komisi-2', [PublicKomisi2Controller::class, 'index'])->name('komisi2');
Route::get('/tentang-kami/komisi-3', [PublicKomisi3Controller::class, 'index'])->name('komisi3');
Route::get('/tentang-kami/komisi-4', [PublicKomisi4Controller::class, 'index'])->name('komisi4');


// Teknik Vision
Route::prefix('admin/ruang_cakra')
    ->middleware(['auth', 'is_admin'])
    ->name('admin.ruang_cakra.')
    ->group(function () {
        Route::get('/', [AdminTeknikVisionController::class, 'index'])->name('index');
        Route::get('/{slug}', [AdminTeknikVisionController::class, 'show'])->name('show');

        Route::get('/{slug}/{id}/detail', [AdminTeknikVisionController::class, 'showDetail'])->name('detail');
        Route::get('/{slug}/proker/{id}/deskripsi/edit', [AdminTeknikVisionController::class, 'editDeskripsi'])->name('edit-deskripsi');
        Route::put('/{slug}/{id}/update-deskripsi', [AdminTeknikVisionController::class, 'updateDeskripsi'])->name('update-deskripsi');

        Route::post('/upload-image', [AdminTeknikVisionController::class, 'uploadImage'])->name('upload-image');
});

// User Ruang Cakra
Route::prefix('Ruang_Cakra')->name('ruang_cakra.')->group(function () {
    Route::get('/', [AgendaTeknikVisionController::class, 'index'])->name('index');
    Route::get('/{slug}', [AgendaTeknikVisionController::class, 'show'])->name('show');
    Route::get('/{slug}/{id}/detail', [AgendaTeknikVisionController::class, 'detail'])->name('detail');
});


Route::get('/agenda/pengawasan-pkkmb', [PengawasanPKKMBPublicController::class, 'index'])->name('agenda.pengawasan-pkkmb');
