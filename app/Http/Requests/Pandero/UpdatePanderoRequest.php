<?php

namespace App\Http\Requests\Pandero;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePanderoRequest extends FormRequest
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
            'monto'                 => 'required|number',
            'fecha_inicio'           => 'required'
        ];
    }
    public function messages()
    {
        return [
            'required' => '* Dato Obligatorio',
            'number' => 'Ingrese solo numeros',
        ];
    }
}
