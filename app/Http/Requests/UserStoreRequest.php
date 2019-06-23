<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            //
            'email' => 'required|email|unique:users',
            'name' => 'required|string|max:50|min:3',
            'password' => 'required|min:3'
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Email is required!',
            'email.unique' => 'Email уже зарегистрирован!',
            'name.required' => 'Name is required!',
            'password.required' => 'Password is required!',
            'password.min' => 'Пароль не может быть меньше 4 симоволов!'
        ];
    }
}
