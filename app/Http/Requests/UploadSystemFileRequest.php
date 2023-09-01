<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadSystemFileRequest extends FormRequest
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
            'systemfile56' => 'required_without:appfile|file|mimetypes:application/x-7z-compressed',
            'systemfile' => 'required_without:appfile|file|mimetypes:application/x-7z-compressed',
            'sqlfile' => 'file|mimetypes:text/plain',
        ];
    }
}
