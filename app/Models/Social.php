<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;
    protected $table = 'social';
    protected $primaryKey = 'id';
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
