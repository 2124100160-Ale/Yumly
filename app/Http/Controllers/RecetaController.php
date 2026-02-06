<?php
namespace App\Http\Controllers;

use App\Models\Receta; 
use Illuminate\Http\Request;

class RecetaController extends Controller {

    public function index() {
        $recetas = Receta::all(); 
        return view('recetas.listado', compact('recetas'));
    }

    public function create() {
        return view('recetas.formulario');
    }

    public function store(Request $request) {
        $nuevaReceta = new Receta();
        $nuevaReceta->nombre = $request->nombre;
        $nuevaReceta->descripcion = $request->descripcion;
        $nuevaReceta->usuario_id = $request->usuario_id;
        $nuevaReceta->tipo_plato_id = $request->tipo_plato_id;
        $nuevaReceta->origen_id = $request->origen_id;
        $nuevaReceta->dieta_id = $request->dieta_id;
        $nuevaReceta->estado = 1;

        // Gestión de la imagen al crear
        if ($request->hasFile('imagen')) {
            $ruta = $request->file('imagen')->store('recetas', 'public');
            $nuevaReceta->imagen_uno = $ruta;
        }

        $nuevaReceta->save();
        return redirect('/recetas/listado')->with('mensaje', '¡Receta guardada!');
    }

    public function edit($id) {
        $receta = Receta::find($id);
        // Aquí podrías necesitar cargar Tipos de Plato, Orígenes, etc., si los usas en selects
        return view('recetas.editar', compact('receta'));
    }

    public function update(Request $request, $id) {
        $receta = Receta::find($id);
        $receta->nombre = $request->nombre;
        $receta->descripcion = $request->descripcion;
        $receta->tipo_plato_id = $request->tipo_plato_id;
        $receta->origen_id = $request->origen_id;
        $receta->dieta_id = $request->dieta_id;

        // Gestión de la imagen al actualizar
        if ($request->hasFile('imagen')) {
            $ruta = $request->file('imagen')->store('recetas', 'public');
            $receta->imagen_uno = $ruta;
        }

        $receta->save();
        return redirect('/recetas/listado')->with('mensaje', '¡Receta actualizada!');
    }

    public function destroy($id) {
        // Buscamos la receta
        $receta = Receta::find($id);

        // Eliminar la imagen para no dejar basura
        if ($receta->imagen_uno) {
            \Storage::disk('public')->delete($receta->imagen_uno);
        }

        // Eliminamos el registro de la base de datos
        $receta->delete();

        // 4. Redireccionamos con un mensaje de éxito
        return redirect('/recetas/listado')->with('mensaje', '¡Receta eliminada correctamente!');
    }
}
