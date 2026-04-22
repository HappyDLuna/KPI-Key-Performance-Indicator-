<?php

use App\Http\Controllers\FillkpiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KpiquestionController;
use App\Http\Controllers\KpireqController;
use App\Http\Controllers\KpiscoreController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VocationController;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/', function () {
    return view('auth/login');
});
Route::get('/dashboard',[HomeController::class,'index'])->name('dashboard');

Route::middleware(['auth','user-access:kepegawaian'])->group(function(){
    // Kpi
    Route::get('/kpi/tabel-kpi',[KpireqController::class,'index'])->name('tabel-kpi');
    Route::get('/kpi/tambah-kpi',[KpireqController::class,'create'])->name('tambah-kpi');
    Route::post('/kpi/masuk-kpi',[KpireqController::class,'store'])->name('masuk-kpi');
    Route::get('/kpi/edit-kpi/{id}',[KpireqController::class,'edit'])->name('edit-kpi');
    Route::put('/kpi/update-kpi/{id}',[KpireqController::class,'update'])->name('update-kpi');
    Route::delete('/kpi/delete-kpi/{id}',[KpireqController::class,'destroy'])->name('delete-kpi');
    // Detail Kpi
    Route::get('/kpi/pertanyaan-kpi/{id}',[KpiquestionController::class,'index'])->name('tabel-pertanyaan');
    Route::get('/kpi/pertanyaan-kpi/tambah/{id}',[KpiquestionController::class,'create'])->name('tambah-pertanyaan');
    Route::post('/kpi/pertanyaan-kpi/simpan/',[KpiquestionController::class,'store'])->name('simpan-pertanyaan');
    Route::get('/kpi/pertanyaan-kpi/edit/{id}',[KpiquestionController::class,'edit'])->name('edit-pertanyaan');
    Route::put('/kpi/pertanyaan-kpi/update/{id}',[KpiquestionController::class,'update'])->name('update-pertanyaan');
    Route::delete('/kpi/pertanyaan-kpi/delete/{id}/{rid}',[KpiquestionController::class,'destroy'])->name('delete-pertanyaan');

    // Route::get('/kpi/question-kpi/{id}',[KpiscoreController::class,'index'])->name('detail-kpi');
    // Route::get('/kpi/tambah-question-kpi/{id}',[KpiscoreController::class,'create'])->name('tambah-question-kpi');
    // Route::post('/kpi/masuk-question-kpi/{id}',[KpiscoreController::class,'store'])->name('masuk-question-kpi');
    // Route::get('/kpi/edit-question-kpi/{id}',[KpiscoreController::class,'edit'])->name('edit-question-kpi');
    // Route::put('/kpi/update-question-kpi/{id}',[KpiscoreController::class,'update'])->name('update-question-kpi');
    // Route::delete('/kpi/delete-question-kpi/{id}/{rid}',[KpiscoreController::class,'destroy'])->name('delete-question-kpi');

    // User
    Route::get('/user/tabel-user',[UserController::class,'index'])->name('tabel-user');
    Route::get('/user/tambah-user',[UserController::class,'add'])->name('tambah-user');
    Route::post('/user/masuk-user',[UserController::class,'store'])->name('masuk-user');
    Route::get('user/edit-user/{id}',[UserController::class,'edit'])->name('edit-user');
    Route::put('/user/update-user/{id}',[UserController::class,'update'])->name('update-user');
    Route::delete('/user/delete-user/{id}',[UserController::class,'destroy'])->name('delete-user');
    //Vacation
    Route::get('/jurusan/tabel-jurusan',[VocationController::class,'index'])->name('tabel-jurusan');
    Route::get('/jabatan/tambah-jurusan',[VocationController::class,'create'])->name('tambah-jurusan');
    Route::post('/jabatan/masuk-jurusan',[VocationController::class,'store'])->name('masuk-jurusan');
    Route::get('/jabatan/edit-jurusan/{id}',[VocationController::class,'edit'])->name('edit-jurusan');
    Route::put('/jabatan/update-jurusan/{id}',[VocationController::class,'update'])->name('update-jurusan');
    Route::delete('/jabatan/delete-jurusan/{id}',[VocationController::class,'destroy'])->name('delete-jurusan');
    //Role
    Route::get('/jabatan/tabel-jabatan',[RoleController::class,'index'])->name('tabel-jabatan');
    Route::get('/jabatan/tambah-jabatan',[RoleController::class,'create'])->name('tambah-jabatan');
    Route::post('/jabatan/masuk-jabatan',[RoleController::class,'store'])->name('masuk-jabatan');
    Route::get('/jabatan/edit-jabatan/{id}',[RoleController::class,'edit'])->name('edit-jabatan');
    Route::put('/jabatan/update-jabatan/{id}',[RoleController::class,'update'])->name('update-jabatan');
    Route::delete('/jabatan/delete-jabatan/{id}',[RoleController::class,'destroy'])->name('delete-jabatan');

});

Route::middleware(['auth','user-access:mahasiswa'])->group(function(){
  
});

Route::middleware(['auth','user-access:tendik'])->group(function(){
    Route::get('/tendik/rekap',[FillkpiController::class,'index'])->name('rekap');
    Route::get('/tendik/laporan',[FillkpiController::class,'laporan'])->name('laporan');
    Route::get('/tendik/laporan-kpi/{id}',[FillkpiController::class,'laporan_kpi'])->name('laporan-kpi');
    Route::get('/tendik/jawabkpi/{id}',[FillkpiController::class,'isikpi'])->name('answer-kpi');
    Route::post('/tendik/simpankpi',[FillkpiController::class,'store'])->name('masuk-kpi');
    Route::get('/tendik/ubahkpi/{id}',[FillkpiController::class,'editkpi'])->name('ubah-kpi');
    Route::put('/tendik/updatekpi',[FillkpiController::class,'update'])->name('update-kpi');
    Route::get('/tendik/delete-answer',[FillkpiController::class,'delete'])->name('delete-answer');
    
});

Route::middleware(['auth','user-access:rektor'])->group(function(){
    Route::get('/rektor/verifikasi',[FillkpiController::class,'verifikasi'])->name('verifikasi');
});

Route::middleware(['auth','user-access:kaprodi'])->group(function(){
    
});
