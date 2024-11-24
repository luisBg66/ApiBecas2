<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requeremientos extends Model
{
    use HasFactory;
    protected $table = 'requerimientos';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
       'id_estudiante',
        'nombre_requerimiento',
        'materia_en_repeticion', 
        'promedio',             
        'ingresos',  
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'id_estudiante', 'id_numero_control');
    }

}
