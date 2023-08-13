<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\AdminController;

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
    // peserta
    Route::get('/peserta', [PesertaController::class, 'index'])->name('peserta.index')->middleware('isPeserta');
    Route::get('/peserta/profile', [PesertaController::class, 'profile'])->name('peserta.profile');
    Route::post('/peserta/profile', [PesertaController::class, 'updateProfile'])->name('peserta.updateProfile');
    Route::get('/peserta/change-password', [PesertaController::class, 'changePassword'])->name('peserta.changePassword');
    Route::post('/peserta/change-password', [PesertaController::class, 'saveChangePassword'])->name('peserta.saveChangePassword');


    // admin 
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')->middleware('isAdmin');
    
    // home
    Route::get('/home', function(){
        if (auth()->user()->role === 'admin'){
            return redirect()->route('admin.index');
        }else if (auth()->user()->role === 'peserta'){
            return redirect()->route('peserta.index');
        }
        return redirect('/');
    });
});