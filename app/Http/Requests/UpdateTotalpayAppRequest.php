<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTotalpayAppRequest extends FormRequest
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
        $id = $this->route('totalpayapp');

        return [
            'customers_id' => [
                'required',
                'max:10',
                Rule::unique('customer_total_pay_apps')->ignore($id),
            ],
            'shopname' => 'required|max:100',
            'tapiurl' => 'required|max:30',
        ];
    }
}
