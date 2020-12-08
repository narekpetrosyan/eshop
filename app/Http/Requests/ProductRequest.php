<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "code" => "required|max:20|unique:categories,code",
            "name" => "required|min:8",
            "price" => "required|numeric|min:1",
            "description" => "min:8|max:255",
        ];
    }

    public function messages()
    {
        return [
            "required" => "This field :attribute is required."
        ];
    }
}
