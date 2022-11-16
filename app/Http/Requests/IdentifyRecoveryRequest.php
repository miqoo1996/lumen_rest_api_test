<?php

namespace App\Http\Requests;

class IdentifyRecoveryRequest extends FormRequest
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
            'password' => 'required|string|min:6|max:255',
            'email_token' => 'required|string|exists:users,email_token|max:255',
        ];
    }

}
