<?php

use App\Http\Controllers\Admin\GaleriFotoController;
use App\Http\Controllers\Admin\VideoKegiatanController;
use App\Http\Controllers\Admin\InformasiController;
use App\Http\Controllers\Admin\AgendaSekolahController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\DashboardOrangTuaController;
use App\Http\Controllers\SpmbController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// ==========================================
// HALAMAN UTAMA WEBSITE - KONTEN DINAMIS
// ==========================================
Route::get('/', function () {

    $galeris = \App\Models\GaleriFoto::where('is_published', true)
        ->orderBy('urutan')
        ->latest()
        ->take(8)
        ->get();

    $videos = \App\Models\VideoKegiatan::where('is_published', true)
        ->latest()
        ->take(4)
        ->get();

    $informasis = \App\Models\Informasi::where('is_published', true)
        ->latest()
        ->take(5)
        ->get();

    $agendas = \App\Models\AgendaSekolah::where('is_published', true)
        ->orderBy('tanggal_mulai')
        ->take(5)
        ->get();

    return view('welcome', compact(
        'galeris',
        'videos',
        'informasis',
        'agendas'
    ));

})->name('beranda');


// ==========================================
// SPMB ONLINE - TANPA LOGIN
// ==========================================
Route::get('/spmb', [SpmbController::class, 'index'])
    ->name('spmb.index');

Route::post('/spmb', [SpmbController::class, 'store'])
    ->name('spmb.store');

Route::get('/spmb/bukti/{token}', [SpmbController::class, 'bukti'])
    ->name('spmb.bukti');

Route::get('/spmb/cek-status', [SpmbController::class, 'cek'])
    ->name('spmb.cek');

Route::post('/spmb/cek-status', [SpmbController::class, 'hasil'])
    ->name('spmb.hasil');


// ==========================================
// LOGIN
// ==========================================
Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');


// ==========================================
// ADMIN SPMB
// ==========================================
Route::middleware('auth')
    ->prefix('admin/spmb')
    ->name('admin.spmb.')
    ->group(function () {

        Route::get('/', [SpmbController::class, 'adminIndex'])
            ->name('index');

        Route::get('/{id}', [SpmbController::class, 'adminShow'])
            ->whereNumber('id')
            ->name('show');

        Route::put('/{id}/status', [SpmbController::class, 'adminUpdateStatus'])
            ->whereNumber('id')
            ->name('update-status');

        Route::delete('/{id}', [SpmbController::class, 'adminDestroy'])
            ->whereNumber('id')
            ->name('destroy');
    });


// ==========================================
// SEMUA HALAMAN YANG MEMERLUKAN LOGIN
// ==========================================
Route::middleware('auth')->group(function () {

    // Dashboard administrator
    Route::get('/dashboard', [AuthController::class, 'dashboard'])
        ->name('dashboard');

    // Dashboard pendidik
    Route::get('/dashboard-pendidik', function () {
        abort_unless(
            auth()->user()->role === 'pendidik',
            403,
            'Anda tidak memiliki akses ke dashboard pendidik.'
        );

        return view('dashboard-pendidik');
    })->name('pendidik.dashboard');

    // Dashboard orang tua
    Route::get('/dashboard-orang-tua', function () {
        abort_unless(
            auth()->user()->role === 'orang_tua',
            403,
            'Anda tidak memiliki akses ke dashboard orang tua.'
        );

        return app(DashboardOrangTuaController::class)->index(request());
    })->name('orangtua.dashboard');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');


    // ======================================
    // TUGAS
    // ======================================
    Route::get('/tugas', [TugasController::class, 'index'])
        ->name('tugas.index');

    Route::resource('tugas', TugasController::class)
        ->parameters(['tugas' => 'tugas'])
        ->except(['show', 'index']);


    // ======================================
    // PENGUMPULAN TUGAS ORANG TUA
    // ======================================
    Route::get('/pengumpulan-tugas', [
        \App\Http\Controllers\PengumpulanTugasController::class,
        'index'
    ])->name('pengumpulan-tugas.index');

    Route::get('/pengumpulan-tugas/{tugas}/kirim', [
        \App\Http\Controllers\PengumpulanTugasController::class,
        'create'
    ])->name('pengumpulan-tugas.create');

    Route::post('/pengumpulan-tugas/{tugas}/kirim', [
        \App\Http\Controllers\PengumpulanTugasController::class,
        'store'
    ])->name('pengumpulan-tugas.store');


    // ======================================
    // DATA SISWA
    // ======================================
    Route::resource('siswa', SiswaController::class)
        ->except(['show']);


    // ======================================
    // TAHUN AJARAN
    // ======================================
    Route::resource('tahun-ajaran', TahunAjaranController::class)
        ->except(['show']);


    // ======================================
    // DATA GURU
    // ======================================
    Route::resource('guru', GuruController::class)
        ->except(['show']);


    // ======================================
    // DATA KELAS
    // ======================================
    Route::resource('kelas', KelasController::class)
        ->except(['show']);


    // ======================================
    // LAPORAN
    // ======================================
    Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('laporan.index');


    // ======================================
    // EVALUASI
    // ======================================
    Route::get('/evaluasi', [EvaluasiController::class, 'index'])
        ->name('evaluasi.index');

    // DETAIL EVALUASI
    Route::get('/evaluasi/{evaluasi}', [EvaluasiController::class, 'show'])
        ->whereNumber('evaluasi')
        ->name('evaluasi.show');

    Route::get('/evaluasi/create', [EvaluasiController::class, 'create'])
        ->name('evaluasi.create');

    Route::post('/evaluasi', [EvaluasiController::class, 'store'])
        ->name('evaluasi.store');

    Route::get('/evaluasi/{evaluasi}/edit', [EvaluasiController::class, 'edit'])
        ->whereNumber('evaluasi')
        ->name('evaluasi.edit');

    Route::put('/evaluasi/{evaluasi}', [EvaluasiController::class, 'update'])
        ->whereNumber('evaluasi')
        ->name('evaluasi.update');


    // ======================================
    // PRESENSI HARIAN
    // ======================================
    Route::get('/presensi', [PresensiController::class, 'index'])
        ->name('presensi.index');

    Route::post('/presensi', [PresensiController::class, 'store'])
        ->name('presensi.store');


    // ======================================
    // MATERI
    // ======================================
    Route::get('/materi', [MateriController::class, 'index'])
        ->name('materi');

    Route::get('/kelola-materi', [MateriController::class, 'kelola'])
        ->name('materi.kelola');

    Route::get('/kelola-materi/tambah', [MateriController::class, 'create'])
        ->name('materi.create');

    Route::post('/kelola-materi', [MateriController::class, 'store'])
        ->name('materi.store');

    Route::get('/kelola-materi/{materi}/edit', [MateriController::class, 'edit'])
        ->name('materi.edit');

    Route::put('/kelola-materi/{materi}', [MateriController::class, 'update'])
        ->name('materi.update');

    Route::delete('/kelola-materi/{materi}', [MateriController::class, 'destroy'])
        ->name('materi.destroy');


    // ======================================
    // MANAJEMEN KONTEN WEBSITE
    // KHUSUS ADMINISTRATOR
    // ======================================
    Route::prefix('admin/konten')
        ->name('admin.konten.')
        ->middleware('administrator')
        ->group(function () {

            Route::resource('galeri', GaleriFotoController::class);

            Route::resource('video', VideoKegiatanController::class);

            Route::resource('informasi', InformasiController::class);

            Route::resource('agenda', AgendaSekolahController::class);

        });

});