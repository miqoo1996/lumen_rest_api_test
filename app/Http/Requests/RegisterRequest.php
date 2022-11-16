<?php

namespace App\Http\Requests;

class RegisterRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password'=>'required|min:6|max:255',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ];
    }

}
