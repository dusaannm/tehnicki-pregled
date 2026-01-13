<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\PorukaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TerminController;
use App\Http\Controllers\UslugaController;
use App\Models\Usluga;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

Route::get('/', function (): View {
    $services = Usluga::where('featured', true)->take(6)->get();

    return view('welcome', compact('services'));
});

Route::get('/dashboard', function (): View {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/**
 * PUBLIC use-case: pregled usluga
 */
Route::get('/usluge', [BookingController::class, 'usluge'])->name('public.usluge');

/**
 * USER use-cases: zakazivanje + moji termini (traži login)
 */
Route::middleware('auth')->group(function () {
    // profile (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // booking
    Route::get('/zakazi', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/zakazi', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/moji-termini', [BookingController::class, 'my'])->name('booking.my');
});

/**
 * ADMIN CRUD panel
 */
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('usluge', UslugaController::class)->parameters(['usluge' => 'usluga']);
    Route::resource('klijenti', \App\Http\Controllers\Admin\ClientController::class)->parameters(['klijenti' => 'user']);
    Route::resource('termini', TerminController::class)->parameters([
        'termini' => 'termin',
    ]);
    Route::resource('poruke', PorukaController::class)->parameters(['poruke' => 'poruka']);
    Route::resource('vozila', \App\Http\Controllers\VoziloController::class)->parameters(['vozila' => 'vozilo']);
});

require __DIR__.'/auth.php';
