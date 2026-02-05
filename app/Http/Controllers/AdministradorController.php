<?php
namespace App\Http\Controllers;

use App\Models\Administrador; 
use Illuminate\Http\Request;

class AdministradorController extends Controller {
    
    public function index() {
        $administradores = Administrador::all(); 
        return view('administradores.listado', compact('administradores'));
    }

    public function create() {
        return view('administradores.formulario');
    }

    public function store(Request $request) {
        $admin = new Administrador();
        $admin->nombres = $request->nombres;
        $admin->apellidos = $request->apellidos;
        $admin->correo = $request->correo;
        $admin->usuario = $request->usuario;
        $admin->contraseña = $request->contraseña;
        $admin->rol = $request->rol;
        $admin->estado = 1; 

        // Lógica de Imagen para Crear
        if ($request->hasFile('imagen')) {
            $ruta = $request->file('imagen')->store('administradores', 'public');
            $admin->imagen = $ruta;
        }

        $admin->save();
        return redirect('/administradores/listado')->with('exito', 'Admin creado');
    }

    public function edit($id) {
        $administrador = Administrador::find($id);
        return view('administradores.editar', compact('administrador'));
    }

    public function update(Request $request, $id) {
        $admin = Administrador::find($id);
        $admin->nombres = $request->nombres;
        $admin->apellidos = $request->apellidos;
        $admin->correo = $request->correo;
        $admin->usuario = $request->usuario;
        $admin->rol = $request->rol;

        // Lógica de Imagen para Editar
        if ($request->hasFile('imagen')) {
            $ruta = $request->file('imagen')->store('administradores', 'public');
            $admin->imagen = $ruta;
        }

        $admin->save();
        return redirect('/administradores/listado')->with('exito', 'Admin actualizado');
    }
}
