<?php

namespace App\Http\Requests;

use App\Facades\Cart;
use Illuminate\Foundation\Http\FormRequest;
use Laravel\Jetstream\Jetstream;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !!$this->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('POST')) {
            return [
                'address' => 'required|integer',
                'contact_name' => 'required',
                'contact_phone' => 'required|numeric|digits:11',
                'term' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
            ];
        }

        return [
            'status' => 'required',
        ];
    }

    public function all($keys = null)
    {
        return array_merge(parent::all($keys), [
            'address_id' => $this->get('address'),
            'subtotal' => Cart::subtotal(),
            'discount' => Cart::discount(),
            'total' => Cart::total(),
        ]);
    }
}
