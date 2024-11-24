<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EscolarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'id' => $this->id,
            'id_estudiante' => $this->id_estudiante,
            'promedio' => $this->promedio,
            'materias_reprobadas' => $this->materias_reprobadas,
        ];
    }
}
