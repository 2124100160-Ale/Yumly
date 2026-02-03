<?php
namespace App\Http\Controllers;

use App\Models\Dieta; // <--- PASO 1: Importar el modelo
use Illuminate\Http\Request;

class DietaController extends Controller {
    public function index() {
        // PASO 2: Pedirle al modelo TODOS los registros de la DB
        $dietas = Dieta::all(); 
        
        // PASO 3: Mandar la variable $dietas a la vista
        return view('dietas.listado', compact('dietas'));
    }
}
