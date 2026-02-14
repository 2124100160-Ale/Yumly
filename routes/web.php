<?php

use Illuminate\Support\Facades\Route;

// Importar todos los controladores
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RecetaController;
use App\Http\Controllers\IngredienteController;
use App\Http\Controllers\TipoPlatoController;
use App\Http\Controllers\OrigenController;
use App\Http\Controllers\DietaController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\SocialAuthController;


Route::get('/login', function () {
    return view('login');
});
Route::get('/', function () {
    return view('principal'); // O el nombre de tu vista de bienvenida
});

// --- ADMINISTRADORES ---
Route::get('/administradores/listado', [AdministradorController::class, 'index']);
Route::get('/administradores/formulario', [AdministradorController::class, 'create']);
Route::post('/administradores/guardar', [AdministradorController::class, 'store']);
Route::get('/administradores/editar/{id}', [AdministradorController::class, 'edit']);
Route::post('/administradores/actualizar/{id}', [AdministradorController::class, 'update']);
Route::delete('/administradores/borrar/{id}', [AdministradorController::class, 'destroy'])->name('administradores.destroy');

// --- USUARIOS ---
Route::get('/usuarios/listado', [UsuarioController::class, 'index']);
Route::get('/usuarios/formulario', [UsuarioController::class, 'create']);
Route::post('/usuarios/guardar', [UsuarioController::class, 'store']);
Route::get('/usuarios/editar/{id}', [UsuarioController::class, 'edit']);
Route::post('/usuarios/actualizar/{id}', [UsuarioController::class, 'update']);
Route::delete('/usuarios/borrar/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');

// --- RECETAS ---
Route::get('/recetas/listado', [RecetaController::class, 'index']);
Route::get('/recetas/formulario', [RecetaController::class, 'create']);
Route::post('/recetas/guardar', [RecetaController::class, 'store']);
Route::get('/recetas/editar/{id}', [RecetaController::class, 'edit']);
Route::post('/recetas/actualizar/{id}', [RecetaController::class, 'update']);
Route::delete('/recetas/borrar/{id}', [RecetaController::class, 'destroy'])->name('recetas.borrar');

// --- SERVICIOS ---
Route::get('/panel-informacion', [ServiciosController::class, 'mostrarPanel']);



Route::get('/auth/google', [SocialAuthController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login'); // O a la ruta de tu login
});