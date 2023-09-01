<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCompanySettingRequest extends FormRequest
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
        $companyId = isset($this->route('company_setting')->id) ? $this->route('company_setting')->id : null;

        return [
            'companycode' => [
                'required',
                'max:20',
                Rule::unique('company_settings')->ignore($companyId),
            ],
            'companyname'=>'required|max:200',
            'registrationno'=>'max:50',
            'registrationno2'=>'max:50',
            'gstno'=>'max:30',
            'bankacc1'=>'max:20',
            'bankacc2'=>'max:20',
            'address1'=>'max:40',
            'address2'=>'max:40',
            'address3'=>'max:40',
            'address4'=>'max:40',
            'city'=>'max:50',
            'zipcode'=>'max:5',
            'contactperson'=>'max:50',
            'contactperson2'=>'max:50',
            'phoneno1'=>'max:20',
            'phoneno2'=>'max:20',
            'email'=>'max:50',
            'email2'=>'max:50',
            'companyltrheader'=>'image|max:5048',
            'companyltrfooter'=>'image|max:5048',
        ];
    }
}
