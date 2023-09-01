<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTermRequest extends FormRequest
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
        $term = $this->route('term');

        return [
            'term' => 'required|unique:terms,term,' . $term->id . '|max:20',
            'description' => 'required|max:200',
            'termdays' => 'required|numeric|digits_between:1,11',
        ];
    }
}
