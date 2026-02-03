<?php
namespace App\Http\Controllers;

use App\Models\TipoPlato; // <--- PASO 1: Importar el modelo
use Illuminate\Http\Request;

class TipoPlatoController extends Controller {
    public function index() {
        // PASO 2: Pedirle al modelo TODOS los registros de la DB
        $tiposPlatos = TipoPlato::all(); 
        
        // PASO 3: Mandar la variable $tiposPlatos a la vista
        return view('tipos_platos.listado', compact('tiposPlatos'));
    }
}

