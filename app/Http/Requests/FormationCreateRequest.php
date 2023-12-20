<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class FormationCreateRequest extends FormRequest
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
            'nom_de_formation'=>'required|string|max:255',
            'description'=>'required|string',
            'date_de_debut' => 'required|date',
            'date_limite_d_inscription'=>'required|date',
           
            
           ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([

            'succes'=>'false',
            'error'=>'true',
            'message'=>'Erreurr de validation',
            'errorList'=>$validator->errors(),
        ]));
    }

    public function messages()
    {
        return[
        'nom_de_formation.required'=>'le nom_de_formation doit être fourni',
        'nom_de_formation.string'=>'le nom_de_formation doit être une chaîne de caractére',
        'nom_de_formation.max'=>'le nom_de_formation ne doit dépasser 255 caractéres',

        'description.required'=>'l\'description doit être fourni',
        'description.string'=>'l\'description doit être une chaîne de caractére',
        

        'date_de_debut.required'=>'la date doit être fourni',
        'date_de_debut.date'=>'la date doit être de type date',

        
        'date_limite_d\'inscription.required'=>'la date doit être fourni',
        'date_limite_d\'inscription.date'=>'la date doit être de type date',
     

        ];
    }
}
