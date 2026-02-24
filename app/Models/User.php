<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'usuarios'; 

    // Desactivamos los timestamps porque tu tabla no tiene created_at/updated_at
    public $timestamps = false; 

    protected $fillable = [
        'nombres',   
        'apellidos', // Agregado
        'correo',
        'contraseña',
        'direccion',
        'imagen',
        'estado',
        'google_id',
    ];

    protected $hidden = [
        'contraseña',
        'remember_token',
    ];


    protected $casts = [
        'correo_verified_at' => 'datetime',
        'contraseña' => 'hashed', // Importante en Laravel 10 para el cifrado automático
    ];
    
    public function getAuthPassword()
{
    return $this->contraseña;
}
// Dentro de app/Models/User.php

public function username()
{
    return 'correo'; 
}


}