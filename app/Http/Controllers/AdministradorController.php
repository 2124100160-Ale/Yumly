<?php
namespace App\Http\Controllers;

use App\Models\Administrador; // <--- PASO 1: Importar el modelo
use Illuminate\Http\Request;

class AdministradorController extends Controller {
    public function index() {
        // PASO 2: Pedirle al modelo TODOS los registros de la DB
        $administradores = Administrador::all(); 
        
        // PASO 3: Mandar la variable $administradores a la vista
        return view('administradores.listado', compact('administradores'));
    }
public function store(Request $request) {
    $admin = new \App\Models\Administrador();
    $admin->nombres = $request->nombres;
    $admin->apellidos = $request->apellidos;
    $admin->correo = $request->correo;
    $admin->usuario = $request->usuario;
    $admin->contraseña = $request->contraseña;
    $admin->rol = $request->rol;
    $admin->estado = 1; 
    $admin->save();

    return redirect('/administradores/listado')->with('exito', 'Admin creado');
}
public function create() {
    return view('administradores.formulario');
}
}
