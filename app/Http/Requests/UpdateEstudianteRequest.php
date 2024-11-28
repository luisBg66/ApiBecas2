<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEstudianteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //'numero_control' => 'nullable|string|unique:estudiantes,numero_control,' . $this->route('estudiante'),
            'nombre' => 'nullable|string|max:255',
            'apellido_paterno' => 'nullable|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'id_carrera' => 'nullable|exists:carreras,id',
            'correo' => 'nullable|email|unique:estudiantes,correo,' . $this->route('estudiante'),
    
        ];
    }
}
