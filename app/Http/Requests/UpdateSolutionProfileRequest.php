<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSolutionProfileRequest extends FormRequest
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
        $solutionprofile = $this->route('solutionprofile');

        return [
            'solutioncode' => 'unique:solution_profiles,solutioncode,' . $solutionprofile->id,
            'problem_description' => 'required',
            'problem_solution' => 'nullable|string',
            'active' => [
                'nullable'
            ],
        ];
    }
}
