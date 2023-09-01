<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStaffRequest extends FormRequest
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
        $staff = $this->route('staff');

        return [
            'staffcode' => 'required|unique:staffs,staffcode,' . $staff->id . '|max:10',
            'name' => 'required|max:60',
            'commrate' => 'numeric|max:8',
        ];
    }
}
