<?php
namespace App\Http\Controllers;

use App\Models\Usuario; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Importante para borrar archivos

class UsuarioController extends Controller {

    public function index() {
        $usuarios = Usuario::all(); 
        return view('usuarios.listado', compact('usuarios'));
    }

    public function create() {
        return view('usuarios.formulario');
    }

    public function store(Request $request) {
        $usuario = new Usuario();
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->correo = $request->correo;
        $usuario->direccion = $request->direccion;
        $usuario->contraseña = bcrypt($request->contraseña ?? '12345'); // Encriptación básica
        $usuario->estado = 1;
        $usuario->save();

        return redirect('/usuarios/listado')->with('exito', '¡Usuario registrado correctamente!');
    }

    public function edit($id) {
        $usuario = Usuario::findOrFail($id); // Si no existe, lanza error 404
        return view('usuarios.editar', compact('usuario'));
    }

    public function update(Request $request, $id) {
        $usuario = Usuario::findOrFail($id);
        
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->correo = $request->correo;
        $usuario->direccion = $request->direccion;

        if ($request->hasFile('imagen')) {
            // Borramos la imagen anterior si existe para no llenar el disco
            if ($usuario->imagen) {
                Storage::disk('public')->delete($usuario->imagen);
            }
            $rutaImagen = $request->file('imagen')->store('usuarios', 'public');
            $usuario->imagen = $rutaImagen;
        }
        
        $usuario->save();
        return redirect('/usuarios/listado')->with('mensaje', '¡Usuario actualizado!');
    }

    // --- NUEVO MÉTODO PARA BORRAR ---
    public function destroy($id) {
        $usuario = Usuario::findOrFail($id);

        // Borrar imagen física del servidor
        if ($usuario->imagen) {
            Storage::disk('public')->delete($usuario->imagen);
        }

        $usuario->delete();
        return redirect('/usuarios/listado')->with('exito', 'Usuario eliminado con éxito');
    }
}