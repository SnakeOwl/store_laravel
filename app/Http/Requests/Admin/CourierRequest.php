<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CourierRequest extends FormRequest
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
        return [
            'name' => 'required|min:3|max:255',
            'city' => 'min:3|max:255',
            'active' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Нужно заполнить поле :attribute.',
            'min' => 'Поле :attribute должно иметь не менее :min символов',
            'max' => 'Поле :attribute должно иметь не более :max символов',
            'name.min' => 'Поле Имя должно иметь не менее :min символов',
        ];
    }
}
