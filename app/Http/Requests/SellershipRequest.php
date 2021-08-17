<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellershipRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if ($this->isSeller()) {
            $this->merge([
                'status' => 'PENDING',
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'store_name' => 'required',
            'store_email' => 'required|email',
            'store_phone' => 'required|numeric|digits:11',
            'store_address' => 'required|max:255',
            'status' => 'required',
        ];
    }
}
