<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDireccionRequest extends FormRequest
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
            'id_estudiante' => 'required|exists:estudiantes,id',
            'municipio' => 'nullable|string|max:255',
            'colonia' => 'nullable|string|max:255',
            'calle' => 'nullable|string|max:255',
            'numero' => 'nullable|integer|min:0',
        ];
    }
}
