<?php
namespace App\Http\Controllers;

use App\Models\Receta; 
use App\Models\Usuario; // Importante para el select
use App\Models\Origen;  // Suponiendo que tus modelos se llaman así
use App\Models\Dieta;   
use App\Models\TipoPlato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecetaController extends Controller {

    public function index() {
        // Usamos with() para cargar los nombres de las relaciones y no solo el ID
        $recetas = Receta::with(['usuario', 'origen', 'dieta', 'tipoPlato'])->get(); 
        return view('recetas.listado', compact('recetas'));
    }

    public function create() {
        // Traemos todos los registros para llenar los selects del formulario
        $usuarios = Usuario::all();
        $origenes = Origen::all();
        $dietas = Dieta::all();
        $tiposPlato = TipoPlato::all();

        return view('recetas.formulario', compact('usuarios', 'origenes', 'dietas', 'tiposPlato'));
    }

    public function store(Request $request) {
        // Validamos que las 3 imágenes sean requeridas
        $request->validate([
            'imagen1' => 'required|image',
            'imagen2' => 'required|image',
            'imagen3' => 'required|image',
            'nombre' => 'required'
        ]);

        $nuevaReceta = new Receta();
        $nuevaReceta->nombre = $request->nombre;
        $nuevaReceta->descripcion = $request->descripcion;
        $nuevaReceta->usuario_id = $request->usuario_id;
        $nuevaReceta->tipo_plato_id = $request->tipo_plato_id;
        $nuevaReceta->origen_id = $request->origen_id;
        $nuevaReceta->dieta_id = $request->dieta_id;
        $nuevaReceta->estado = 1;
        $nuevaReceta->save(); // Guardamos primero para tener el ID

        // PROCESAMIENTO DE LAS 3 IMÁGENES
        for ($i = 1; $i <= 3; $i++) {
            if ($request->hasFile('imagen' . $i)) {
                $file = $request->file('imagen' . $i);
                $nombreArchivo = 'recetas_' . $nuevaReceta->id . '_' . $i . '.' . $file->getClientOriginalExtension();
                $file->storeAs('recetas', $nombreArchivo, 'public');
                
                // Asignamos a la columna correspondiente: imagen_uno, imagen_dos, imagen_tres
                $columna = ($i == 1) ? 'imagen_uno' : (($i == 2) ? 'imagen_dos' : 'imagen_tres');
                $nuevaReceta->$columna = 'recetas/' . $nombreArchivo;
            }
        }

        $nuevaReceta->save();
        return redirect('/recetas/listado')->with('mensaje', '¡Receta guardada con 3 imágenes!');
    }

    public function edit($id) {
        $receta = Receta::findOrFail($id);
        $usuarios = Usuario::all();
        $origenes = Origen::all();
        $dietas = Dieta::all();
        $tiposPlato = TipoPlato::all();

        return view('recetas.editar', compact('receta', 'usuarios', 'origenes', 'dietas', 'tiposPlato'));
    }

    public function update(Request $request, $id) {
        $receta = Receta::findOrFail($id);
        $receta->nombre = $request->nombre;
        $receta->descripcion = $request->descripcion;
        $receta->usuario_id = $request->usuario_id;
        $receta->tipo_plato_id = $request->tipo_plato_id;
        $receta->origen_id = $request->origen_id;
        $receta->dieta_id = $request->dieta_id;

        // Gestión de las 3 imágenes al actualizar (sin required)
        for ($i = 1; $i <= 3; $i++) {
            $inputName = 'imagen' . $i;
            if ($request->hasFile($inputName)) {
                $columna = ($i == 1) ? 'imagen_uno' : (($i == 2) ? 'imagen_dos' : 'imagen_tres');
                
                // Borrar anterior
                if ($receta->$columna) {
                    Storage::disk('public')->delete($receta->$columna);
                }

                $file = $request->file($inputName);
                $nombreArchivo = 'recetas_' . $receta->id . '_' . $i . '.' . $file->getClientOriginalExtension();
                $file->storeAs('recetas', $nombreArchivo, 'public');
                $receta->$columna = 'recetas/' . $nombreArchivo;
            }
        }

        $receta->save();
        return redirect('/recetas/listado')->with('mensaje', '¡Receta actualizada!');
    }

    public function destroy($id) {
        $receta = Receta::findOrFail($id);

        // Eliminar las 3 imágenes
        if ($receta->imagen_uno) Storage::disk('public')->delete($receta->imagen_uno);
        if ($receta->imagen_dos) Storage::disk('public')->delete($receta->imagen_dos);
        if ($receta->imagen_tres) Storage::disk('public')->delete($receta->imagen_tres);

        $receta->delete();
        return redirect('/recetas/listado')->with('mensaje', '¡Receta y sus fotos eliminadas!');
    }
}