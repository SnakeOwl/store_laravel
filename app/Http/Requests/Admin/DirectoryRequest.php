<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DirectoryRequest extends FormRequest
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
        $rules = [
            'name' => 'required|min:3|max:255',
            'alias' => 'required|min:3|max:255',
        ];

        if ($this->route()->named('directories.store'))
        {
            $rules['name'] .= '|unique:directories,name';
            $rules['alias'] .= '|unique:directories,alias';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => 'Нужно заполнить поле :attribute.',
            'min' => 'Поле :attribute должно иметь не менее :min символов',
            'max' => 'Поле :attribute должно иметь не более :max символов',
            'name.min' => 'Поле Название должно иметь не менее :min символов',
            'alias.min' => 'Поле Алиас должно иметь не менее :min символов',
        ];
    }
}
