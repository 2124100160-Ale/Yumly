<?php
namespace App\Http\Controllers;

use App\Models\Receta; // <--- PASO 1: Importar el modelo
use Illuminate\Http\Request;

class RecetaController extends Controller {
    public function index() {
        // PASO 2: Pedirle al modelo TODOS los registros de la DB
        $recetas = Receta::all(); 
        
        // PASO 3: Mandar la variable $recetas a la vista
        return view('recetas.listado', compact('recetas'));
    }
    
    public function store(Request $request) {
    $nuevaReceta = new \App\Models\Receta();
    $nuevaReceta->nombre = $request->nombre;
    $nuevaReceta->descripcion = $request->descripcion;
    $nuevaReceta->usuario_id = $request->usuario_id;
    $nuevaReceta->tipo_plato_id = $request->tipo_plato_id;
    $nuevaReceta->origen_id = $request->origen_id;
    $nuevaReceta->dieta_id = $request->dieta_id;
$nuevaReceta->imagen_uno = null;
$nuevaReceta->imagen_dos = null;
$nuevaReceta->imagen_tres = null;
    
    // CAMBIO AQUÍ: Enviamos 1 para decir que está "activa" o "pendiente"
    $nuevaReceta->estado = 1;
    $nuevaReceta->save();
    return redirect('/recetas/listado')->with('mensaje', '¡Receta guardada!');
}
public function create() {
    return view('recetas.formulario');
}


}
