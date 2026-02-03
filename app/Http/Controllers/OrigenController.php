<?php
namespace App\Http\Controllers;

use App\Models\Origen; // <--- PASO 1: Importar el modelo
use Illuminate\Http\Request;

class OrigenController extends Controller {
    public function index() {
        // PASO 2: Pedirle al modelo TODOS los registros de la DB
        $origenes = Origen::all(); 
        
        // PASO 3: Mandar la variable $origenes a la vista
        return view('origenes.listado', compact('origenes'));
    }
}

