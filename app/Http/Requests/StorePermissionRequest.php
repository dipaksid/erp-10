<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePermissionRequest extends FormRequest
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
        $permissionId = $this->route('permission');
        return [
            'name' => [
                'required',
                'max:40',
                Rule::unique('permissions')->ignore($permissionId),
            ],
        ];
    }

    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    public function validationData(): array
    {
        // Merge the current permission ID into the request data for validation
        return array_merge($this->request->all(), [
            'permission' => $this->route('permission'),
        ]);
    }
}
