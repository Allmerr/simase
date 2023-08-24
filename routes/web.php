<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PangkatController;
use App\Http\Controllers\PendidikanKepolisianController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\SatkerController;
use App\Http\Controllers\SkemaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    // home
    Route::get('/home', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.index');
        } elseif (auth()->user()->role === 'peserta') {
            return redirect()->route('peserta.index');
        }

        return redirect('/');
    });

    // peserta
    Route::get('/peserta', [PesertaController::class, 'index'])->name('peserta.index')->middleware('isPeserta');
    Route::get('/peserta/skema', [PesertaController::class, 'showSkema'])->name('peserta.showSkema')->middleware('isPeserta');
    Route::get('/peserta/skema/{id_skema}', [PesertaController::class, 'detailSkema'])->name('peserta.detailSkema')->middleware('isPeserta');
    Route::get('/peserta/skema/{id_skema}/daftar', [PesertaController::class, 'daftarSkema'])->name('peserta.daftarSkema')->middleware('isPeserta');
    Route::post('/peserta/skema/{id_skema}/daftar', [PesertaController::class, 'saveDaftarSkema'])->name('peserta.saveDaftarSkema')->middleware('isPeserta');
    Route::get('/peserta/skema/{id_skema}/revisi', [PesertaController::class, 'revisiSkema'])->name('peserta.revisiSkema')->middleware('isPeserta');
    Route::post('/peserta/skema/{id_skema}/revisi', [PesertaController::class, 'saveRevisiSkema'])->name('peserta.saveRevisiSkema')->middleware('isPeserta');
    Route::get('/peserta/profile', [PesertaController::class, 'profile'])->name('peserta.profile');
    Route::post('/peserta/profile', [PesertaController::class, 'updateProfile'])->name('peserta.updateProfile');
    Route::get('/peserta/change-password', [PesertaController::class, 'changePassword'])->name('peserta.changePassword');
    Route::post('/peserta/change-password', [PesertaController::class, 'saveChangePassword'])->name('peserta.saveChangePassword');
    Route::get('/peserta/notifikasi', [PesertaController::class, 'notifikasi'])->name('peserta.notifikasi');
    Route::get('/peserta/notifikasi/{id_notifikasi}/detail', [PesertaController::class, 'notifikasiDetail'])->name('peserta.notifikasiDetail');
    Route::get('/peserta/status-pengajuan', [PesertaController::class, 'statusPengajuan'])->name('peserta.statusPengajuan');
    Route::get('/peserta/sertifikat', [PesertaController::class, 'sertifikat'])->name('peserta.sertifikat');

    // admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')->middleware('isAdmin');
    Route::post('/admin/skema/upload', [SkemaController::class, 'upload'])->name('skema.upload');
    Route::get('/admin/skema/{id_skema}/peserta', [SkemaController::class, 'pesertaSkema'])->name('skema.pesertaSkema')->middleware('isAdmin');
    Route::get('/admin/skema/{id_skema}/peserta/{id_users}/lulus', [SkemaController::class, 'pesertaSkemaLulus'])->name('skema.pesertaSkemaLulus')->middleware('isAdmin');
    Route::post('/admin/skema/{id_skema}/peserta/{id_users}/sertifikat-lulus', [SkemaController::class, 'sertifikatLulus'])->name('skema.sertifikatLulus')->middleware('isAdmin');
    Route::resource('/admin/skema', SkemaController::class);
    Route::resource('/admin/satker', SatkerController::class);
    Route::resource('/admin/pangkat', PangkatController::class);
    Route::resource('/admin/pendidikan-kepolisian', PendidikanKepolisianController::class);
    Route::get('/admin/pengajuan/{id_pengajuan}/terima', [PengajuanController::class, 'terima'])->name('pengajuan.terima');
    Route::get('/admin/pengajuan/{id_pengajuan}/tolak', [PengajuanController::class, 'tolak'])->name('pengajuan.tolak');
    Route::get('/admin/pengajuan/{id_pengajuan}/revisi', [PengajuanController::class, 'revisi'])->name('pengajuan.revisi');
    Route::post('/admin/pengajuan/{id_pengajuan}/revisi', [PengajuanController::class, 'saveRevisi'])->name('pengajuan.saveRevisi');
    Route::resource('/admin/pengajuan', PengajuanController::class);
    Route::get('/admin/sertifikat', [AdminController::class, 'sertifikat'])->name('admin.sertifikat');
});