<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'email' => 'required|min:3|max:150',
            'password' => 'required|min:5',
        ];

        if(str_contains($this->email, '@')){
            $rules['email'] = 'required|min:3|max:150|email';
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Please enter name/email.',
            'email.email' => 'Please enter valid name/email.',
            'password.required' => 'Please enter message.',
        ];
    }
}
