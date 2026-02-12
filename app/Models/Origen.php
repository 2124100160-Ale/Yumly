<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Origen extends Model {
    // Laravel buscaba 'origens', nosotros le decimos que es 'origenes'
    protected $table = 'origenes'; 
    public $timestamps = false;
}
