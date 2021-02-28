<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class historiaC extends FormRequest
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
            'estadoCivil'=>'in:soltero,casado,divorciado,viudo',
            'tipoSan'=>'in:O negativo,O positivo,A negativo,A positivo,B negativo,B positivo,AB negativo,AB positivo',
        ];
    }
    public function messages()
    {
        return [
            'estadoCivil.in' => 'El del estado civil no es corrector ',
            'tipoSan.in' => 'El del tipo sanguineo no es corrector',
        ];
    }
}
