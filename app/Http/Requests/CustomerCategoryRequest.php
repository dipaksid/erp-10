<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerCategoryRequest extends FormRequest
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
            'categorycode' => 'required|unique:customer_categories|max:20',
            'description' => 'required|max:200',
            'lastrunno' => 'required|max:10',
            'b_rmk' => 'required|max:1',
            'b_mobapp' => 'required|max:1',
        ];
    }
}
