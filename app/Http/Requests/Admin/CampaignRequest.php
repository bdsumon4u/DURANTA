<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class CampaignRequest extends FormRequest
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
        $this->merge([
            'slug' => $this->get('slug', Str::slug($this->name)),
            'starts_at' => Carbon::parse($this->starts_at),
            'ends_at' => Carbon::parse($this->ends_at)->endOfDay(),
            'deadline' => Carbon::parse($this->deadline)->endOfDay(),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->has('product_id') ? [] : [
            'name' => 'required',
            'slug' => 'required',
            'starts_at' => 'required|date',
            'ends_at' => 'required|date',
            'deadline' => 'required|date',
            'image' => 'nullable',
        ];
    }
}
