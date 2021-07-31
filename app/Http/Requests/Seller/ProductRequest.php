<?php

namespace App\Http\Requests\Seller;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    private const RULES = [
        'media' => 'array',

        'sku' => '',
        'name' => 'required|max:255',
        'slug' => 'nullable|max:255',
        'description' => 'required',

        'brand' => 'nullable|integer',
        'categories' => 'required|array',

        'price' => 'required|integer|gt:0',
        'discount_amount' => 'required|integer|gt:-1',
        'discount_type' => 'required',
        'discount_from' => 'nullable',
        'discount_till' => 'nullable',

        'stock_track' => 'required|boolean',
        'stock_count' => 'required|integer',
        'pickup_point' => 'required|max:255',
    ];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->isMethod('POST')) {
            return $this->user()->can('create', Product::class);
        }
        return $this->user()->can('update', $this->route('product'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('POST')) {
            return static::RULES;
        }

        return array_merge(static::RULES, [

        ]);
    }
}
