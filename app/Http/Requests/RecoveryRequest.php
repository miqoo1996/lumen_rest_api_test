<?php

namespace App\Http\Requests;

class RecoveryRequest extends FormRequest
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
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'email.exists' => __("We couldn't find this email in our records."),
        ];
    }

}
