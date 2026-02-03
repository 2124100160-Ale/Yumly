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

// Pantalla Principal
Route::get('/', function () { return view('principal'); });

// --- RUTAS DE LISTADO (CRUD: LISTAR) ---
Route::get('/administradores/listado', [AdministradorController::class, 'index']);
Route::get('/usuarios/listado', [UsuarioController::class, 'index']);
Route::get('/recetas/listado', [RecetaController::class, 'index']);
Route::get('/ingredientes/listado', [IngredienteController::class, 'index']);
Route::get('/tipos-platos/listado', [TipoPlatoController::class, 'index']);
Route::get('/origenes/listado', [OrigenController::class, 'index']);
Route::get('/dietas/listado', [DietaController::class, 'index']);

// --- RUTAS DE FORMULARIOS (GET para ver, POST para guardar) ---

// Administradores
Route::get('/administradores/formulario', [AdministradorController::class, 'create']);
Route::post('/administradores/guardar', [AdministradorController::class, 'store']);

// Usuarios
Route::get('/usuarios/formulario', [UsuarioController::class, 'create']);
Route::post('/usuarios/guardar', [UsuarioController::class, 'store']);

// Recetas
Route::get('/recetas/formulario', [RecetaController::class, 'create']);
Route::post('/recetas/guardar', [RecetaController::class, 'store']);