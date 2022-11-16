<?php

namespace App\Http\Requests;

class CompanyRequest extends FormRequest
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
            'data'=>'required|array',
            'data.*.title' => 'required|string|max:255',
            'data.*.description' => 'required|string|max:2000',
            'data.*.phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'data.*.user_ids'=>'required|exists:users,id'
        ];
    }
}
