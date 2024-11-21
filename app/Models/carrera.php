<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;
    protected $table = 'carreras';
    protected $primaryKey = 'id_carrera';
    public $timestamps = true;

    protected $fillable = [
        'nombre_carrera',
    ];

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class, 'id_carrera', 'id_carrera');
    }
}
