<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormQuestionController;
use App\Http\Controllers\GtController;
use App\Http\Controllers\LandingContentController;
use App\Http\Controllers\PermohonanController;
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

    // Kelola Landing Page - admin only
    Route::resource('landing-contents', LandingContentController::class)->except(['show'])->parameters(['landing-contents'=>'landingContent']);
    // Kelola Pertanyaan Form - admin only
    Route::resource('form-questions', FormQuestionController::class)->except(['show'])->parameters(['form-questions'=>'formQuestion']);

    // Form Ijin GT ringkas - halaman sendiri (admin & pjgt)
    Route::get('/form-ijin-gt', [PermohonanController::class, 'ijinForm'])->name('form.ijin')->middleware('role:admin,pjgt');
    Route::post('/form-ijin-gt', [PermohonanController::class, 'storeIjin'])->name('form.ijin.store')->middleware('role:admin,pjgt');

    // Guru Tugas - Biodata, Kegiatan, Absensi (gt & admin)
    Route::prefix('gt')->name('gt.')->middleware('role:gt,admin')->group(function () {
        Route::get('/biodata', [GtController::class, 'biodata'])->name('biodata');
        Route::put('/biodata', [GtController::class, 'updateBiodata'])->name('biodata.update');
        Route::get('/kegiatan', [GtController::class, 'kegiatan'])->name('kegiatan');
        Route::get('/absensi-mengajar', [GtController::class, 'absensiMengajar'])->name('absensi.mengajar');
        Route::get('/absensi-shalat', [GtController::class, 'absensiShalat'])->name('absensi.shalat');
    });
});
