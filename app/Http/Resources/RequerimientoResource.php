<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RequerimientoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'id'=>$this->id,
            'id_estudiante'=>$this->id_estudiante,
            'nombre_requerimiento'=>$this->nombre_requerimiento,
            'materia_en_repeticion'=>$this->materia_en_repeticion, 
            'promedio'=>$this->promedio,
            'ingresos'=>$this->ingresos, 
           


        ];
    }
}
