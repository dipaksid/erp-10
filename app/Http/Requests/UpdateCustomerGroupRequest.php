<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerGroupRequest extends FormRequest
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
        return [
            'groupcode' => 'required|unique:customer_groups,groupcode,'.$this->id.'|max:20',
            'description' => 'required|max:200',
            'category_id' => 'required',
            'companyid' => 'required',
        ];
    }
}
