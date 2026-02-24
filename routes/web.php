<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RecetaController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\LoginController;

// RUTA PÚBLICA (Cualquiera puede verla)
Route::get('/', function () {
    return view('principal');
});

// RUTAS DE AUTENTICACIÓN (Entradas al sistema)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// RUTAS DE GOOGLE (Socialite)
Route::get('/auth/google', [SocialAuthController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);


// GRUPO PROTEGIDO (Solo usuarios logueados)
Route::middleware(['auth'])->group(function () {
    
    // Panel principal
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });

    // --- ADMINISTRADORES ---
    Route::prefix('administradores')->group(function () {
        Route::get('/listado', [AdministradorController::class, 'index']);
        Route::get('/formulario', [AdministradorController::class, 'create']);
        Route::post('/guardar', [AdministradorController::class, 'store']);
        Route::get('/editar/{id}', [AdministradorController::class, 'edit']);
        Route::post('/actualizar/{id}', [AdministradorController::class, 'update']);
        Route::delete('/borrar/{id}', [AdministradorController::class, 'destroy'])->name('administradores.destroy');
    });

    // --- USUARIOS ---
    Route::prefix('usuarios')->group(function () {
        Route::get('/listado', [UsuarioController::class, 'index']);
        Route::get('/formulario', [UsuarioController::class, 'create']);
        Route::post('/guardar', [UsuarioController::class, 'store']);
        Route::get('/editar/{id}', [UsuarioController::class, 'edit']);
        Route::post('/actualizar/{id}', [UsuarioController::class, 'update']);
        Route::delete('/borrar/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
    });

    // --- RECETAS ---
    Route::prefix('recetas')->group(function () {
        Route::get('/listado', [RecetaController::class, 'index']);
        Route::get('/formulario', [RecetaController::class, 'create']);
        Route::post('/guardar', [RecetaController::class, 'store']);
        Route::get('/editar/{id}', [RecetaController::class, 'edit']);
        Route::post('/actualizar/{id}', [RecetaController::class, 'update']);
        Route::delete('/borrar/{id}', [RecetaController::class, 'destroy'])->name('recetas.borrar');
    });

    // --- SERVICIOS ---
    Route::get('/panel-informacion', [ServiciosController::class, 'mostrarPanel']);

});