<?php

namespace Softce\Type\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as Request;

class TypeRequest extends Request
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
            'name' => 'array|max:255',
            'name.'.app()->getLocale() => 'required',
        ];

        return $rules;
    }
}
