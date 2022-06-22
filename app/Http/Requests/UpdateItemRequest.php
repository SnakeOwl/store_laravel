<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => "required|max:255",
            'price' => "required|numeric|min:1",
            'description' => "required",
            "amount" => "required|numeric",
            "discount" => "nullable|numeric",
            "category_id" => "required"

        ];
    }
}
