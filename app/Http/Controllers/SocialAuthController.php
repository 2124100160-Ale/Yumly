<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;

class SocialAuthController extends Controller
{

    public function redirectToGoogle() {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback() {
        $userGoogle = Socialite::driver('google')->stateless()->user();

        $user = Usuario::updateOrCreate([
            'correo' => $userGoogle->email,
        ], [
            'nombres' => $userGoogle->name,
            'google_id' => $userGoogle->id,
            'imagen' => $userGoogle->avatar,
            'contraseña' => null, 
        ]);

        Auth::login($user);
        return redirect('/');
    }
}