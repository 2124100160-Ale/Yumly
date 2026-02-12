<?php
namespace App\Http\Controllers;

use App\Models\Administrador; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Importante para gestionar archivos

class AdministradorController extends Controller {
    
    public function index() {
        $administradores = Administrador::all(); 
        return view('administradores.listado', compact('administradores'));
    }

    public function create() {
        return view('administradores.formulario');
    }

    public function store(Request $request) {
        // Validación: Imagen obligatoria en creación
        $request->validate([
            'imagen' => 'required|image|mimes:jpg,jpeg,png',
            'nombres' => 'required',
            'usuario' => 'required|unique:administradores,usuario'
        ]);

        $admin = new Administrador();
        $admin->nombres = $request->nombres;
        $admin->apellidos = $request->apellidos;
        $admin->correo = $request->correo;
        $admin->usuario = $request->usuario;
        $admin->contraseña = bcrypt($request->contraseña); // Seguridad básica
        $admin->rol = $request->rol;
        $admin->estado = 1; 
        $admin->save(); // Guardamos primero para obtener el ID generado

        // Renombrar imagen: administradores_id.extension
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $nombreArchivo = 'administradores_' . $admin->id . '.' . $file->getClientOriginalExtension();
            
            // Guardar con el nombre específico
            $file->storeAs('administradores', $nombreArchivo, 'public');
            
            // Actualizar la ruta en la DB
            $admin->imagen = 'administradores/' . $nombreArchivo;
            $admin->save();
        }

        return redirect('/administradores/listado')->with('exito', 'Administrador creado correctamente con su imagen.');
    }

    public function edit($id) {
        $administrador = Administrador::findOrFail($id);
        return view('administradores.editar', compact('administrador'));
    }

    public function update(Request $request, $id) {
        $admin = Administrador::findOrFail($id);
        $admin->nombres = $request->nombres;
        $admin->apellidos = $request->apellidos;
        $admin->correo = $request->correo;
        $admin->usuario = $request->usuario;
        $admin->rol = $request->rol;

        if ($request->hasFile('imagen')) {
            // 1. Borrar la imagen vieja del disco
            if ($admin->imagen) {
                Storage::disk('public')->delete($admin->imagen);
            }

            // 2. Guardar la nueva con el formato: administradores_id.extension
            $file = $request->file('imagen');
            $nombreArchivo = 'administradores_' . $admin->id . '.' . $file->getClientOriginalExtension();
            $file->storeAs('administradores', $nombreArchivo, 'public');
            
            $admin->imagen = 'administradores/' . $nombreArchivo;
        }

        $admin->save();
        return redirect('/administradores/listado')->with('exito', 'Admin actualizado correctamente.');
    }

    public function destroy($id) {
        $admin = Administrador::findOrFail($id);
        
        // Borrar la imagen física antes de eliminar el registro
        if ($admin->imagen) {
            Storage::disk('public')->delete($admin->imagen);
        }

        $admin->delete();
        return redirect('/administradores/listado')->with('exito', 'Administrador y su imagen eliminados.');
    }
}
