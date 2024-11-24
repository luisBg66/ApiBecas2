<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEstudianteRequest extends FormRequest
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
    public function rules()
    {
        return [
            'numero_control' => 'required|string|max:255|unique:estudiantes,numero_control,' . $this->route('estudiante'),
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'nullable|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'id_carrera' => 'required|exists:carreras,id',
            'correo' => 'required|email|max:255|unique:estudiantes,correo,' . $this->route('estudiante'),
        ];
    }
}
