<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model {
    protected $table = 'recetas';
    public $timestamps = false; 

    // --- RELACIONES (Esto es lo que faltaba) ---

    // Conecta con la tabla de Usuarios
    public function usuario() {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    // Conecta con la tabla de Origenes
    public function origen() {
        return $this->belongsTo(Origen::class, 'origen_id');
    }

    // Conecta con la tabla de Dietas
    public function dieta() {
        return $this->belongsTo(Dieta::class, 'dieta_id');
    }

    // Conecta con la tabla de Tipos de Platos
    public function tipoPlato() {
        // Asegúrate que el nombre de la columna sea tipo_plato_id
        return $this->belongsTo(TipoPlato::class, 'tipo_plato_id');
    }
}
