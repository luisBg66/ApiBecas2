<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
//use Illuminate\Testing\Fluent\Concerns\Has;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Estudiante extends Model
{
    use HasFactory,Notifiable,HasApiTokens,HasRoles;
    protected $table = 'estudiantes';
    
    public $timestamps = true;

 

    protected $fillable = [
        'id',
       'numero_control',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'id_carrera',
        'correo',
    ];

    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'id_carrera', 'id');
    }

    public function direccion()
    {
        return $this->hasOne(Direccion::class, 'id_estudiante', 'id_numero_control');
    }

    public function economia()
    {
        return $this->hasOne(Economia::class, 'id_estudiante', 'id_numero_control');
    }

    public function aspectoSocial()
    {
        return $this->hasOne(Social::class, 'id_estudiante', 'id_numero_control');
    }

    public function aspectoEscolar()
    {
        return $this->hasOne(Escolar::class, 'id_estudiante', 'id_numero_control');
    }

    public function requerimientos()
    {
        return $this->hasOne(Requeremientos::class, 'id_estudiante', 'id_numero_control');
    }

    public function aceptado()
    {
        return $this->hasOne(Aseptado::class, 'id_estudiante', 'id_numero_control');
    }
}
