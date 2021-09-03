<?php

namespace App\Http\Requests\Seller;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
        if ($this->isMethod('GET')) {
            return [];
        }

        switch ($this->route()->parameter('tab')) {
            case 'withdraw':
                return [
                    'method_name' => 'required',
                    'bank_name' => 'required_if:method_name,Bank',
                    'account_name' => 'required_if:method_name,Bank',
                    'branch' => 'required_if:method_name,Bank',
                    'routing_no' => 'required_if:method_name,Bank',
                    'account_type' => 'required',
                    'account_number' => 'required',
                ];
            case 'store':
                return [
                    'store_logo' => 'required',
                ];
        }
    }
}
