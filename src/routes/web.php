<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\EventOrganizerController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
Route::get('/pesanan/{id}',  [PesananController::class, 'show'])->name('pesanan.show');

Route::get('/pesanan/{id}/invoice', [PesananController::class, 'invoice'])->name('pesanan.invoice');
Route::get('/organizer/{id}',         [EventOrganizerController::class, 'show'])->name('organizer.show');
Route::get('/organizer/{id}/hubungi', [EventOrganizerController::class, 'hubungi'])->name('organizer.hubungi');
 
// Route::middleware('auth')->group(function () {
    Route::post('/organizer/{id}/ikuti', [EventOrganizerController::class, 'ikuti'])->name('organizer.ikuti');



require __DIR__.'/auth.php';
