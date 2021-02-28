<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class paciente extends FormRequest
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
           'nomPaciente'=>'required|max:200',
            'apPat'=>'required|max:200',
            'apMat'=>'required|max:200',
            'telPerson'=>'required',
            'fecPerson'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'nomPaciente.required' => 'nombre',
            'apPat.required' => 'apPat',
            'apMat.required' => 'apMat',
            'telPerson.required' => 'telPerson',
            'fecPerson.required' => 'fecPerson',

            'nomPaciente.max' => 'tamNom',
            'apPat.max' => 'tamPat',
            'apMat.max' => 'tamMat',
        ];
    }
}
