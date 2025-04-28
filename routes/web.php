<?php

use App\Http\Controllers\EquipoController;
use App\Http\Controllers\JugadorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

// Rutas públicas
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Rutas de autenticación explícitas
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

// Ruta de logout
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->middleware('auth')
        ->name('logout');

// Rutas protegidas
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('equipos', EquipoController::class);
    
    Route::get('/equipos/{equipo}/jugadores', [JugadorController::class, 'index'])->name('jugadores.index');
    Route::get('/equipos/{equipo}/jugadores/create', [JugadorController::class, 'create'])->name('jugadores.create');
    Route::post('/equipos/{equipo}/jugadores', [JugadorController::class, 'store'])->name('jugadores.store');
    Route::get('/jugadores/{jugador}/edit', [JugadorController::class, 'edit'])->name('jugadores.edit');
    Route::put('/jugadores/{jugador}', [JugadorController::class, 'update'])->name('jugadores.update');
    Route::delete('/jugadores/{jugador}', [JugadorController::class, 'destroy'])->name('jugadores.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});