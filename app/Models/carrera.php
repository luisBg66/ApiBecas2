<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;
    protected $table = 'carreras';

    public $timestamps = true;

    protected $fillable = [
        'nombre_carrera',
    ];

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class, 'id_carrera', 'id');
    }
}
