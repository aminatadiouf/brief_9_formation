<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserCreateRequest extends FormRequest
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
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|unique:users',
            'telephone' => 'required|string',
            'date_de_naissance'=>'required|date',
           
            'password'=>'required|min:4'
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
        'name.required'=>'le name doit être fourni',
        'name.string'=>'le name doit être une chaîne de caractére',
        'name.max'=>'le name ne doit dépasser 255 caractéres',

        'email.required'=>'l\'email doit être fourni',
        'email.string'=>'l\'email doit être une chaîne de caractére',
        'email.email' => 'L\'email doit être une adresse email valide',
        'email.unique' => 'Cet email est déjà utilisé par un autre utilisateur.',

        'telephone.required' => 'Le numéro de téléphone doit être fourni',
        'telephone.string' => 'Le numéro de téléphone doit être une chaîne de caractères',

        'date_de_naissance.required'=>'la date de naissance doit être fourni',
        'date_de_naissance.date'=>'la date de naissance doit être de type date',

        'password.required' => 'Le mot de passe doit être fourni',
        'password.min' => 'Le mot de passe doit comporter au moins 4 caractères',
        
     

        ];
    }
}
