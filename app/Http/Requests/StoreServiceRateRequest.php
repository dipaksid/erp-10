<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'effectivedate' => 'required|date_format:d/m/Y',
            'd_description' => 'array',
            'd_description.*' => 'required|string',
            'd_rate' => 'array',
            'd_rate.*' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'effectivedate.required' => 'The effective date is required.',
            'effectivedate.date_format' => 'The effective date must be in the format dd/mm/yyyy.',
            'd_description.array' => 'The service descriptions must be provided as an array.',
            'd_description.*.required' => 'Each service description is required.',
            'd_description.*.string' => 'Each service description must be a string.',
            'd_rate.array' => 'The rates must be provided as an array.',
            'd_rate.*.required' => 'Each rate is required.',
            'd_rate.*.numeric' => 'Each rate must be a number.',
        ];
    }
}
