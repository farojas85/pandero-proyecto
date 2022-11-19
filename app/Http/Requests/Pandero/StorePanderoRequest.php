<?php

namespace App\Http\Requests\Pandero;

use Illuminate\Foundation\Http\FormRequest;

class StorePanderoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'descripcion'           => 'required',
            'monto'                 => 'required|numeric',
            'fecha_inicio'           => 'required'
        ];
    }
    public function messages()
    {
        return [
            'required' => '* Dato Obligatorio',
            'numeric' => 'Ingrese solo numeros',
        ];
    }
}
