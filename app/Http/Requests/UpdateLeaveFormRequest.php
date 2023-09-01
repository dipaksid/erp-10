<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLeaveFormRequest extends FormRequest
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
            'leave_dat_frm' => 'required',
            'leave_dat_to' => 'required|date_format:d/m/Y|after_or_equal:leave_dat_frm',
            'leave_duration' => 'required',
            'leave_reason' => 'required',
            'designation' => 'required',
            'leave_typ' => 'required',
        ];
    }
}
