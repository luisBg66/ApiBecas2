<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DireccionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'id_estudiante' => $this->id_estudiante,
            'municipio' => $this->municipio,
            'colonia' => $this->colonia,
            'calle' => $this->calle,
            'numero' => $this->numero,

        ];
    }
}
