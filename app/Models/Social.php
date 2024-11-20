<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $table = 'aspecto_social';
    protected $primaryKey = 'id_estudiante';
    public $timestamps = true;

    public $incrementing = false;

    protected $fillable = [
        'id_estudiante',
        'integrantes_familia',
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'id_estudiante', 'id_numero_control');
    }
}
