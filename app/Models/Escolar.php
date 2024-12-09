<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escolar extends Model
{
    use HasFactory;
    protected $table = 'escolar';
    protected $primaryKey = 'id';
    

    public $incrementing = false;

    protected $fillable = [
        'id_estudiante',
        'promedio',
        'materia_en_repeticion',
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'id_estudiante', 'id');
    }
}
