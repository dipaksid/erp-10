<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateApiOauthUserRequest extends FormRequest
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
        $id = $this->route('customer-pwspg-app');

        return [
            'username' => [
                'required',
                'max:30',
                Rule::unique('api_oauth_users')->ignore($id)->where(function ($query) {
                    return $query->where('client_id', 'PWSPGAPP');
                })
            ],
            'first_name' => 'required|max:30',
            'password' => 'required|max:100',
            'mob_pho' => 'required|max:20',
            'cust' => 'required|array|min:1',
            'cust.*' => 'required|integer|exists:customers,id',
        ];

    }
}
