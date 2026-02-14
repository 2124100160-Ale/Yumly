<?php

namespace App\Models;

// 1. IMPORTANTE: Agregar estas dos líneas arriba
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// 2. CAMBIAR 'extends Model' por 'extends Authenticatable'
class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id'; // Asegúrate que este sea tu ID real

    protected $fillable = [
        'nombres', 
        'correo', 
        'contraseña', 
        'google_id', 
        'imagen'
    ];

    // Si tu columna de contraseña no se llama 'password', Laravel necesita saberlo:
    public function getAuthPassword()
    {
        return $this->contraseña;
    }
}