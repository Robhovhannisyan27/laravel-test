<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];
        
    }

    public function messages()
    {
        return [
            'name' =>'The name field is required',
            'email.required' => 'The email field is required',
            'password' => 'The password field is required'
       ];
    }


}

