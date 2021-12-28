<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BackLoginRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required',
            'rememberPasswordCheck' => 'boolean|nullable'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'No has introducido tu email',
            'email.email' => 'Formato de email incorrecto',
            'password.required' => 'No has introducido tu contraseña',
        ];
    }
}
