<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'tipo_documento_id'     => 'required',
            'numero_documento'      => 'required|max:15',
            'nombres'               => 'required|string|max:191',
            'apellido_materno'      => 'required|string|max:191',
            'apellido_paterno'      => 'required|string|max:191',
            'name'                  => 'required|max:191|unique:users,name',
            'email'                 => 'required|email|max:191|unique:users,email',
            'password'              => 'required|string|min:8|confirmed',
            'sexo_id'               => 'required',
            'role_id'               => 'required'
        ];
    }
    public function messages()
    {
        return [
            'required' => '* Dato Obligatorio',
            'max' => 'Ingrese Máximo :max caracteres',
            'string' => 'Ingrese caracteres alfanuméricos',
            'number' => 'Ingrese solo numeros',
            'unique' => 'El :email ya existe',
            'confirmed' => '* Debe confirmar contraseña'
        ];
    }
}
