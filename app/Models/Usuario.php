<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model {
    protected $table = 'usuarios';
    public $timestamps = false;

    // Relación opcional: Un usuario puede tener muchas recetas
    public function recetas() {
        return $this->hasMany(Receta::class, 'usuario_id');
    }
}