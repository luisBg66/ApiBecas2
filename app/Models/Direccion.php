<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
   
    protected $table = 'direcciones';
    protected $primaryKey = 'id';
    

    protected $fillable = [
        'id_estudiante',
        'municipio',
        'colonia',
        'calle',
        'numero',
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'id_estudiante', 'id_numero_control');
    }
}
