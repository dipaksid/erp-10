<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSolutionProfileRequest extends FormRequest
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
            'problem_description' => 'required',
            'solutioncode' => 'nullable|string',
            'problem_solution' => 'nullable|string',
            'active' => 'nullable|accepted',
            'tab' => 'nullable|string',
            'searchvalue' => 'nullable|string',
            'page' => 'nullable|integer',
        ];
    }
}
