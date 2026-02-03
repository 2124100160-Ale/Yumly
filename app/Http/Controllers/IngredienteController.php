<?php
namespace App\Http\Controllers;

use App\Models\Ingrediente; // <--- PASO 1: Importar el modelo
use Illuminate\Http\Request;

class IngredienteController extends Controller {
    public function index() {
        // PASO 2: Pedirle al modelo TODOS los registros de la DB
        $ingredientes = Ingrediente::all(); 
        
        // PASO 3: Mandar la variable $ingredientes a la vista
        return view('ingredientes.listado', compact('ingredientes'));
    }
}

