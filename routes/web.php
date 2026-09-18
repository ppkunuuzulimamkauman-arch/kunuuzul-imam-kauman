<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormQuestionController;
use App\Http\Controllers\GtController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\LandingContentController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\PjgtLaporanController;
use App\Models\Permohonan;
use Illuminate\Support\Facades\Route;

// Landing Page Modern PP KUNUUZUL IMAM KAUMAN - Public
Route::get('/', function () {
    $total = Permohonan::count();
    return view('landing', compact('total'));
})->name('landing');

// Auth - Single login + role (admin/pjgt/gt) + Register
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Protected area - harus login
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/index', [DashboardController::class, 'index'])->name('dashboard.index');

    // Wizard Form Permohonan - 4 step sesuai PDF Tutorial-Isi-Permohonan (pjgt & admin)
    Route::prefix('form-permohonan')->name('permohonan.')->middleware('role:admin,pjgt')->group(function () {
        Route::get('/step-1', [PermohonanController::class, 'step1'])->name('step1');
        Route::post('/step-1', [PermohonanController::class, 'storeStep1'])->name('store1');
        Route::get('/step-2', [PermohonanController::class, 'step2'])->name('step2');
        Route::post('/step-2', [PermohonanController::class, 'storeStep2'])->name('store2');
        Route::get('/step-3', [PermohonanController::class, 'step3'])->name('step3');
        Route::post('/step-3', [PermohonanController::class, 'storeStep3'])->name('store3');
        Route::get('/step-4', [PermohonanController::class, 'step4'])->name('step4');
        Route::post('/step-4', [PermohonanController::class, 'storeStep4'])->name('store4');
    });

    // Halaman sesuai sidebar PDF
    Route::get('/permohonan-lama', [PermohonanController::class, 'lama'])->name('permohonan.lama');
    Route::get('/permohonan/{permohonan}', [PermohonanController::class, 'show'])->name('permohonan.show');
    Route::get('/permohonan/{permohonan}/edit', [PermohonanController::class, 'edit'])->name('permohonan.edit');
    Route::put('/permohonan/{permohonan}', [PermohonanController::class, 'update'])->name('permohonan.update');
    Route::post('/permohonan/{permohonan}/approve', [PermohonanController::class, 'approve'])->name('permohonan.approve')->middleware('role:admin');
    Route::post('/permohonan/{permohonan}/dokumen', [PermohonanController::class, 'uploadDokumen'])->name('permohonan.dokumen');
    Route::delete('/permohonan/{permohonan}', [PermohonanController::class, 'destroy'])->name('permohonan.destroy')->middleware('role:admin');
    Route::get('/rekap-permohonan', [PermohonanController::class, 'rekap'])->name('permohonan.rekap');
    Route::get('/export-permohonan', [PermohonanController::class, 'export'])->name('permohonan.export');
    Route::get('/laporan', [PermohonanController::class, 'laporan'])->name('laporan')->middleware('role:admin,pjgt');

    // Kelola Landing Page - admin only
    Route::resource('landing-contents', LandingContentController::class)->except(['show'])->parameters(['landing-contents'=>'landingContent']);
    // Kelola Pertanyaan Form - admin only
    Route::resource('form-questions', FormQuestionController::class)->except(['show'])->parameters(['form-questions'=>'formQuestion']);

    // Form Ijin GT — diajukan GT ke Admin (hanya GT buat, Admin terima)
    Route::get('/form-ijin-gt', [PermohonanController::class, 'ijinForm'])->name('form.ijin')->middleware('role:gt,admin');
    Route::post('/form-ijin-gt', [PermohonanController::class, 'storeIjin'])->name('form.ijin.store')->middleware('role:gt');

    // Guru Tugas - Biodata, Kegiatan, Absensi (gt & admin)
    Route::prefix('gt')->name('gt.')->middleware('role:gt,admin')->group(function () {
        Route::get('/biodata', [GtController::class, 'biodata'])->name('biodata');
        Route::put('/biodata', [GtController::class, 'updateBiodata'])->name('biodata.update');
        Route::get('/kegiatan', [GtController::class, 'kegiatan'])->name('kegiatan');
        Route::get('/absensi-mengajar', [GtController::class, 'absensiMengajar'])->name('absensi.mengajar');
        Route::get('/absensi-shalat', [GtController::class, 'absensiShalat'])->name('absensi.shalat');
    });

    // PJGT - Biodata dibedakan dari GT (pjgt & admin)
    Route::prefix('pjgt')->name('pjgt.')->middleware('role:pjgt,admin')->group(function () {
        Route::get('/biodata', [GtController::class, 'pjgtBiodata'])->name('biodata');
        Route::put('/biodata', [GtController::class, 'updatePjgtBiodata'])->name('biodata.update');
    });

    // PJGT Laporan Kegiatan GT — checklist (hanya PJGT buat, Admin terima)
    Route::prefix('pjgt/laporan')->name('pjgt.laporan.')->group(function () {
        Route::get('/', [PjgtLaporanController::class, 'index'])->name('index')->middleware('role:pjgt,admin');
        Route::get('/create', [PjgtLaporanController::class, 'create'])->name('create')->middleware('role:pjgt');
        Route::post('/', [PjgtLaporanController::class, 'store'])->name('store')->middleware('role:pjgt');
        Route::get('/{laporan}', [PjgtLaporanController::class, 'show'])->name('show')->middleware('role:pjgt,admin');
        Route::delete('/{laporan}', [PjgtLaporanController::class, 'destroy'])->name('destroy')->middleware('role:admin');
    });
    // GT bisa lihat laporan yang ditujukan untuknya
    Route::prefix('gt/laporan')->name('gt.laporan.')->middleware('role:gt,admin')->group(function () {
        Route::get('/', [PjgtLaporanController::class, 'index'])->name('index');
        Route::get('/{laporan}', [PjgtLaporanController::class, 'show'])->name('show');
    });

    // Pengaduan — PJGT & GT buat, Admin terima (hanya terima hasil)
    Route::middleware('role:pjgt,admin,gt')->group(function () {
        Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
        Route::get('/pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.create')->middleware('role:pjgt,gt');
        Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store')->middleware('role:pjgt,gt');
        Route::get('/pengaduan/{pengaduan}', [PengaduanController::class, 'show'])->name('pengaduan.show');
        Route::post('/pengaduan/{pengaduan}/status', [PengaduanController::class, 'updateStatus'])->name('pengaduan.status')->middleware('role:admin');
        Route::delete('/pengaduan/{pengaduan}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy')->middleware('role:admin');
    });

    // Layanan — saran/masukan (PJGT/GT buat, Admin terima)
    Route::middleware('role:pjgt,admin,gt')->group(function () {
        Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
        Route::post('/layanan', [LayananController::class, 'store'])->name('layanan.store')->middleware('role:pjgt,gt');
        Route::delete('/layanan/{saran}', [LayananController::class, 'destroy'])->name('layanan.destroy')->middleware('role:admin');
    });
});
