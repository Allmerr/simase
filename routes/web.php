<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PangkatController;
use App\Http\Controllers\PendidikanKepolisianController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\SatkerController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\SkemaController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\TukController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\KotaKabupatenController;
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
    Route::get('/peserta/survey', [SurveyController::class, 'index'])->name('peserta.survey.index');
    Route::get('/peserta/survey/{id_status_peserta}', [SurveyController::class, 'create'])->name('peserta.survey.create');
    Route::post('/peserta/survey/{id_status_peserta}', [SurveyController::class, 'store'])->name('peserta.survey.store');

    // admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')->middleware('isAdmin');
    Route::post('/admin/skema/upload', [SkemaController::class, 'upload'])->name('skema.upload');
    Route::get('/admin/skema/{id_skema}/peserta', [SkemaController::class, 'pesertaSkema'])->name('skema.pesertaSkema')->middleware('isAdmin');
    Route::get('/admin/skema/{id_skema}/sertifikat', [SkemaController::class, 'sertifikatSkema'])->name('skema.sertifikatSkema')->middleware('isAdmin');
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
    Route::get('admin/sertifikat/get-users/{id_skema}', [SertifikatController::class, 'getUsersByScheme']);
    Route::resource('/admin/sertifikat', SertifikatController::class);
    Route::get('/admin/peserta', [AdminController::class, 'indexPeserta'])->name('admin.peserta.index');
    Route::get('/admin/peserta/create', [AdminController::class, 'createPeserta'])->name('admin.peserta.create');
    Route::post('/admin/peserta', [AdminController::class, 'storePeserta'])->name('admin.peserta.store');
    Route::get('/admin/peserta/{id_user}', [AdminController::class, 'showPeserta'])->name('admin.peserta.show');
    Route::get('/admin/peserta/{id_user}/edit', [AdminController::class, 'editPeserta'])->name('admin.peserta.edit');
    Route::put('/admin/peserta/{id_user}/edit', [AdminController::class, 'updatePeserta'])->name('admin.peserta.update');
    Route::delete('/admin/peserta/{id_user}', [AdminController::class, 'destroyPeserta'])->name('admin.peserta.destroy');
    Route::get('/admin/operator', [AdminController::class, 'indexOperator'])->name('admin.operator.index');
    Route::get('/admin/operator/create', [AdminController::class, 'createOperator'])->name('admin.operator.create');
    Route::post('/admin/operator', [AdminController::class, 'storeOperator'])->name('admin.operator.store');
    Route::get('/admin/operator/{id_user}', [AdminController::class, 'showOperator'])->name('admin.operator.show');
    Route::get('/admin/operator/{id_user}/edit', [AdminController::class, 'editOperator'])->name('admin.operator.edit');
    Route::put('/admin/operator/{id_user}/edit', [AdminController::class, 'updateOperator'])->name('admin.operator.update');
    Route::delete('/admin/operator/{id_user}', [AdminController::class, 'destroyOperator'])->name('admin.operator.destroy');
    Route::get('/admin/survey', [AdminController::class, 'indexSurvey'])->name('admin.survey.index');
    Route::resource('/admin/tuk', TukController::class);
    Route::resource('/admin/provinsi', ProvinsiController::class);
    Route::resource('/admin/kota-kabupaten', KotaKabupatenController::class);
});