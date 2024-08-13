<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\RakBukuController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Middleware\RecordVisit;
use App\Http\Controllers\PeminjamanKelasController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\DendaController;
use App\Http\Controllers\PaymentController;


Route::get('/master', [UserController::class, 'master'])->name('users.master');


Route::get('/payment', [PaymentController::class, 'index']);
Route::post('/payment/pay', [PaymentController::class, 'pay'])->name('payment.pay');


Route::get('/denda', [DendaController::class, 'index'])->name('denda.index');
Route::post('/denda/pay', [DendaController::class, 'pay'])->name('denda.pay');
Route::post('/denda/update', [DendaController::class, 'update'])->name('denda.update');



Route::get('/auth/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.login'); 
Route::get('/auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);

Route::get('/auth/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);





Route::prefix('peminjaman-kelas')->group(function () {
    Route::get('/', [PeminjamanKelasController::class, 'index'])->name('peminjaman_kelas.index');
    Route::get('/create', [PeminjamanKelasController::class, 'create'])->name('peminjaman_kelas.create');
    Route::post('/', [PeminjamanKelasController::class, 'store'])->name('peminjaman_kelas.store');
    Route::get('/{peminjaman_kelas}', [PeminjamanKelasController::class, 'show'])->name('peminjaman_kelas.show');
    Route::get('/{peminjaman_kelas}/edit', [PeminjamanKelasController::class, 'edit'])->name('peminjaman_kelas.edit');
    Route::put('/{peminjaman_kelas}', [PeminjamanKelasController::class, 'update'])->name('peminjaman_kelas.update');
    Route::delete('/{peminjaman_kelas}', [PeminjamanKelasController::class, 'destroy'])->name('peminjaman_kelas.destroy');
});


Route::resource('peminjaman', PeminjamanController::class);
Route::post('/peminjaman/{peminjaman}/update-status', [PeminjamanController::class, 'updateStatus'])->name('peminjaman.updateStatus');
Route::get('/pengembalian', [PeminjamanController::class, 'returned'])->name('peminjaman.returned');
Route::get('/Laporan', [PeminjamanController::class, 'all'])->name('peminjaman.all');
Route::get('/pdf', [DashboardController::class, 'exportPdf'])->name('peminjaman.exportPdf');

Route::resource('bukus', BukuController::class);


Route::resource('rak_bukus', RakBukuController::class);


Route::get('/', [AuthenticatedSessionController::class, 'create']);




    Route::get('/pengunjung', [VisitController::class, 'index'])->name('visits.index');

    Route::middleware(['auth', RecordVisit::class])->group(function () {
Route::get('/landingpage', [LandingController::class, 'index'])->name('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth', 'verified']);



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // User routes
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    
  
 
  


});

Route::get('/peminjamanuser', [LandingController::class, 'peminjaman'])->name('peminjamanuser');
Route::get('/user/peminjaman', [PeminjamanController::class, 'peminjaman'])->name('user.peminjaman')->middleware('auth');
Route::get('/user/pengembalian', [PeminjamanController::class, 'pengembalian'])->name('user.pengembalian')->middleware('auth');

Route::get('/book/{id}', [LandingController::class, 'bookDetail'])->name('book.detail');

require __DIR__.'/auth.php';
