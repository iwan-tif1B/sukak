<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DataPetugas;
use App\Http\Controllers\DataPasien;
use App\Http\Controllers\DataRegistrasi;
use App\Http\Controllers\DataLayanan;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [Auth::class, 'index'])->name('auth');
Route::post('/login', [Auth::class, 'checkauth'])->name('login');
Route::get('/logout', [Auth::class, 'logout'])->name('logout');
Route::group(['middleware' => ['admin']], function () {
    Route::resource('DataPetugas', DataPetugas::class, ['names' => 'm-petugas']);
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

    Route::resource('DataPasien', DataPasien::class, ['names' => 'm-pasien']);
    Route::resource('DataRegistrasi', DataRegistrasi::class, ['names' => 'trx-registrasi']);
    Route::resource('DataLayanan', DataLayanan::class, ['names' => 'm-layanan']);

    Route::get('pasien/norekmedis', [DataPasien::class, 'norekmedis'])->name('norekmedis');
    Route::get('Pasien/searchdata', [DataPasien::class, 'searchdata'])->name('searchdata');
    Route::get('registrasi/noregis', [DataRegistrasi::class, 'noregistrasi'])->name('noregis');
    Route::get('registrasi/closing/{id}', [DataRegistrasi::class, 'closingvisite'])->name('registrasi.closing');
    Route::get('registrasi/print', [DataRegistrasi::class, 'printview'])->name('registrasi.print');
});
// Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

// Route::resource('DataPasien', DataPasien::class, ['names' => 'm-pasien']);
// Route::resource('DataRegistrasi', DataRegistrasi::class, ['names' => 'trx-registrasi']);
// Route::resource('DataLayanan', DataLayanan::class, ['names' => 'm-layanan']);

// Route::get('pasien/norekmedis', [DataPasien::class, 'norekmedis'])->name('norekmedis');
// Route::get('Pasien/searchdata', [DataPasien::class, 'searchdata'])->name('searchdata');
// Route::get('registrasi/noregis', [DataRegistrasi::class, 'noregistrasi'])->name('noregis');
// Route::get('registrasi/closing/{id}', [DataRegistrasi::class, 'closingvisite'])->name('registrasi.closing');
// Route::get('registrasi/print', [DataRegistrasi::class, 'printview'])->name('registrasi.print');