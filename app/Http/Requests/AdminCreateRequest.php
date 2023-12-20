<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AdminCreateRequest extends FormRequest
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
            'name_admin'=>'required|string|max:255',
            'email_admin'=>'required|string|email|unique:admins',
            'numero_de_telephone' => 'required|string',
           
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
        '.required'=>'le  doit être fourni',
        '.string'=>'le  doit être une chaîne de caractére',
        '.max'=>'le  ne doit dépasser 255 caractéres',

        'email_admin.required'=>'l\'email_admin doit être fourni',
        'email_admin.string'=>'l\'email_admin doit être une chaîne de caractére',
        'email_admin.email' => 'L\'email doit être une adresse email valide',
        'email_admin.unique' => 'Cet email est déjà utilisé par un autre utilisateur.',

        'numero_de_telephone.required' => 'Le numéro de téléphone doit être fourni',
        'numero_de_telephone.string' => 'Le numéro de téléphone doit être une chaîne de caractères',


        'password.required' => 'Le mot de passe doit être fourni',
        'password.min' => 'Le mot de passe doit comporter au moins 4 caractères',
        
     

        ];
    }
}
