<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requeremientos extends Model
{
    protected $table = 'requerimientos';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id_estudiante',
        'nombre_requerimiento',
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'id_estudiante', 'id_numero_control');
    }

}
