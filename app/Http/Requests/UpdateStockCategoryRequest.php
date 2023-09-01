<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStockCategoryRequest extends FormRequest
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
        //dd($this->request->get('isactive'), $this->request->get('isshowdb'));
        return [
            'categorycode' => 'required|unique:stock_categories,categorycode,' . $this->route('stockcategory')->id . '|max:20',
            'description' => 'required|max:200',
            'isactive' => 'nullable|boolean',
            'isshowdb' => 'nullable|boolean',
        ];
    }

    public function validationData()
    {
        $data = $this->all();

        if ($this->has('isactive')) {
            $data['isactive'] = true; // Checkbox is checked
        } else {
            $data['isactive'] = false; // Checkbox is not checked
        }

        if ($this->has('isshowdb')) {
            $data['isshowdb'] = true; // Checkbox is checked
        } else {
            $data['isshowdb'] = false; // Checkbox is not checked
        }

        return $data;
    }
}
