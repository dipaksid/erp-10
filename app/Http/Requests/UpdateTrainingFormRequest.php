<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTrainingFormRequest extends FormRequest
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
        $tainingform = $this->route('trainingform');

        return [
            'systemcod' => 'required|unique:training_forms,systemcod,' . $tainingform->id,
        ];
    }

    // Optionally, you can define custom error messages if needed.
    public function messages()
    {
        return [
            'systemcod.required' => 'The system code field is required.',
            'systemcod.unique' => 'The system code has already been taken.',
            // Define custom error messages for other rules as needed.
        ];
    }
}
