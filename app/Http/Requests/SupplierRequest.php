<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            'companyname' => 'required',
            'companycode' => 'required',
            'areas_id' => 'required',
            'email' => 'nullable|email',
            'email2' => 'nullable|email',
            'homepage' => 'nullable|url',
            'startdate' => 'date|date_format:Y-m-d H:i:s'
        ];
    }
}
