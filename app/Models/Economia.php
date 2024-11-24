<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Economia extends Model
{
    use HasFactory;
    protected $table = 'economia';
   protected $primaryKey = 'id';
    

    public $incrementing = false;

    protected $fillable = [
        'id_estudiante',
        'ingresos',
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'id_estudiante', 'id_numero_control');
    }
}
