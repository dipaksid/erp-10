<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEvaluationFormRequest extends FormRequest
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
        $evaluation_form = $this->route('evaluation_form');
        return [
            'form_title' => 'required|unique:evaluation_forms,form_title,' . $evaluation_form->id,
            // Add other validation rules for fields you want to validate.
            //'status' => 'boolean', // Example rule for 'status' field.
            //'d_subject_title.*' => 'required', // Example rule for an array of 'd_subject_title' fields.
            // Add rules for other fields as needed.
        ];
    }
}
