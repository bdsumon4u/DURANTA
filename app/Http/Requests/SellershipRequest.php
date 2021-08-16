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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $RULES = [
            'store_name' => 'required',
            'store_email' => 'required|email',
            'store_phone' => 'required|numeric|digits:11',
            'store_address' => 'required|max:255',
        ];

        return $this->isSeller() ? $RULES : array_merge($RULES, [
            'status' => 'required',
        ]);
    }
}
