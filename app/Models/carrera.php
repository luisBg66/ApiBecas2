<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class carrera extends Model
{
    protected $table = 'carreras';
    protected $primaryKey = 'id_carrera';
  

    protected $fillable = [
        'nombre_carrera',
    ];

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class, 'id_carrera', 'id_carrera');
    }
}
