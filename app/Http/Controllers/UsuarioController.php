<?php
namespace App\Http\Controllers;

use App\Models\Usuario; // <--- PASO 1: Importar el modelo
use Illuminate\Http\Request;

class UsuarioController extends Controller {
    public function index() {
        // PASO 2: Pedirle al modelo TODOS los registros de la DB
        $usuarios = Usuario::all(); 
        
        // PASO 3: Mandar la variable $usuarios a la vista
        return view('usuarios.listado', compact('usuarios'));
    }
    public function store(Request $request) {
    $usuario = new \App\Models\Usuario();
    $usuario->nombres = $request->nombres;
    $usuario->apellidos = $request->apellidos;
    $usuario->correo = $request->correo;
    $usuario->direccion = $request->direccion;
    // Usamos el valor que viene del input hidden o uno fijo
    $usuario->contraseña = $request->contraseña ?? '12345'; 
    $usuario->estado = 1;
    $usuario->save();

    // Redirigir con un mensaje para que la vista lo muestre
    return redirect('/usuarios/listado')->with('exito', '¡Usuario registrado correctamente!');
}
public function create() {
    return view('usuarios.formulario'); // Asegúrate que el archivo exista en resources/views/usuarios/
}
}

