<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Necesario para manejar la sesión
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{   
    public function showLoginForm() 
    {
        return view('login'); 
    }

    // 1. Mostrar la vista del formulario
    public function login(Request $request)
{
    // 1. Validamos usando tus nombres de campo del formulario
    $request->validate([
        'correo' => ['required', 'email'], // Cambiamos 'correo' por 'email' en la regla
        'contraseña' => ['required'],
    ]);

    // 2. Preparamos las credenciales para Laravel
    // Mapeamos: tu 'correo' -> 'email' / tu 'contraseña' -> 'password'
   // En LoginController.php, dentro de login()
$credentials = [
    'correo' => $request->correo,   // Usamos 'correo' que es el nombre real en la DB
    'password' => $request->contraseña, // 'password' se queda así porque getAuthPassword() lo traduce
];

    // 3. Intentamos autenticar
    if (Auth::attempt($credentials, $request->filled('remember'))) {
        $request->session()->regenerate();
        return redirect()->intended('admin/dashboard');
    }

    throw ValidationException::withMessages([
        'correo' => __('Las credenciales no coinciden con nuestros registros.'),
    ]);
}

    // 3. Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken(); // Seguridad: cambia el token CSRF

        return redirect('/login');
    }

    public function username()
{
    return 'correo';
}

}