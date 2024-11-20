<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aseptado extends Model
{
    protected $table = 'aceptados';
    protected $primaryKey = 'id_estudiante';
    public $timestamps = true;

    public $incrementing = false;

    protected $fillable = [
        'id_estudiante',
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'id_estudiante', 'id_numero_control');
    }
}
