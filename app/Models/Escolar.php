<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escolar extends Model
{
    use HasFactory;
    protected $table = 'escolar';
    protected $primaryKey = 'id_estudiante';
    

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
