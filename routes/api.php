<?php

use App\Http\Controllers\DendaController;

// Menampilkan daftar peminjaman dengan denda
Route::get('/denda', [DendaController::class, 'index'])->name('api.denda.index');

// Membayar denda
Route::post('/denda/pay', [DendaController::class, 'pay'])->name('api.denda.pay');

// Memperbarui status denda
Route::post('/denda/update', [DendaController::class, 'update'])->name('api.denda.update');
