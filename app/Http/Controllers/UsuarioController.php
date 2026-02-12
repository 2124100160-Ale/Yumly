<?php
namespace App\Http\Controllers;

use App\Models\Usuario; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller {

    public function index() {
        $usuarios = Usuario::all(); 
        return view('usuarios.listado', compact('usuarios'));
    }

    public function create() {
        return view('usuarios.formulario');
    }

    public function store(Request $request) {
        // Validación obligatoria para la imagen según la instrucción
        $request->validate([
            'imagen' => 'required|image|mimes:jpg,jpeg,png',
            'nombres' => 'required',
            'correo' => 'required|email'
        ]);

        $usuario = new Usuario();
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->correo = $request->correo;
        $usuario->direccion = $request->direccion;
        $usuario->contraseña = bcrypt($request->contraseña ?? '12345');
        $usuario->estado = 1;
        $usuario->save(); // Guardamos primero para obtener el ID

        // PROCESO DE IMAGEN PERSONALIZADA (tabla_id.extension)
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $extension = $file->getClientOriginalExtension();
            // Nombre solicitado: usuarios_ID.extension
            $nombreArchivo = 'usuarios_' . $usuario->id . '.' . $extension;
            
            // Guardamos en storage/app/public/usuarios
            $file->storeAs('usuarios', $nombreArchivo, 'public');
            
            // Actualizamos el registro con la ruta exacta
            $usuario->imagen = 'usuarios/' . $nombreArchivo;
            $usuario->save();
        }

        return redirect('/usuarios/listado')->with('exito', '¡Usuario registrado correctamente!');
    }

    public function edit($id) {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.editar', compact('usuario'));
    }

    public function update(Request $request, $id) {
        $usuario = Usuario::findOrFail($id);
        
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->correo = $request->correo;
        $usuario->direccion = $request->direccion;

        if ($request->hasFile('imagen')) {
            // 1. Borramos la física anterior
            if ($usuario->imagen) {
                Storage::disk('public')->delete($usuario->imagen);
            }
            
            // 2. Nueva imagen con nombre tabla_id.extension
            $file = $request->file('imagen');
            $nombreArchivo = 'usuarios_' . $usuario->id . '.' . $file->getClientOriginalExtension();
            $file->storeAs('usuarios', $nombreArchivo, 'public');
            
            $usuario->imagen = 'usuarios/' . $nombreArchivo;
        }
        
        $usuario->save();
        return redirect('/usuarios/listado')->with('mensaje', '¡Usuario actualizado!');
    }

    public function destroy($id) {
        $usuario = Usuario::findOrFail($id);
        if ($usuario->imagen) {
            Storage::disk('public')->delete($usuario->imagen);
        }
        $usuario->delete();
        return redirect('/usuarios/listado')->with('exito', 'Usuario eliminado con éxito');
    }
}