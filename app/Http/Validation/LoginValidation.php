<?php

namespace App\Http\Validation;

class LoginValidation{

public function rules(){
    
       return [
        'email'=>['required','string'],
        'password'=>['required','string']
           ];

}
public function messages(){
    
    return [
        'email.required'=>'Vous devez spécifier votre email',
        'password.required'=>'Vous devez spécifier votre mot de passe'

    ];

}


}