<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSystemSettingRequest extends FormRequest
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
            'jobrefreshtime' => 'required|integer',
            'jobnotifyday' => 'required|integer',
            'srvchgsendnotify' => 'required|max:1',
            'allinvdvylh' => 'required|max:1',
            'allcnlh' => 'required|max:1',
            'emailsender' => 'max:100',
            'invoiceprinter' => 'max:100',
            'poprinter' => 'max:100',
            'receiptprinter' => 'max:100',
            'paymentprinter' => 'max:100',
            'creditnoteprinter' => 'max:100',
            'stickerprinter' => 'max:100',
            'reportprinter' => 'max:100',
        ];
    }
}
