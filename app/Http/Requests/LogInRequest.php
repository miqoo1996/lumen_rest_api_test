<?php

namespace App\Http\Requests;

class LogInRequest extends FormRequest
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
            'email' => 'required|email|exists:users,email|max:255',
            'password' => 'required|max:255'
        ];
    }
}
