<?php

namespace App\Http\Requests\Admin;

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
            case 'general':
                return [
                    'logo' => 'nullable',
                    'favicon' => 'nullable',
                    'site_name' => 'required',
                    'tagline' => 'required|max:255',
                    'contact_email' => 'required|email',
                    'contact_phone' => 'required',
                    'company_address' => 'required',
                ];
            case 'social':
                return [
                    'facebook' => 'nullable|max:255',
                    'twitter' => 'nullable|max:255',
                    'instagram' => 'nullable|max:255',
                    'youtube' => 'nullable|max:255',
                ];
            case 'other':
                return [
                    //
                ];
        }
    }
}
