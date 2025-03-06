<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function attributes(): array
    {
        return [
            'category' => 'Product category'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->isMethod('POST')) {
            return [
                'name' => 'required|min:6|string',
                'color' => 'required|string',
                'category' => 'required|string',
                'price' => 'required|numeric'
            ];
        }

        if ($this->isMethod('PUT') || $this->isMethod('PATCh')) {
            return [
                'name' => 'sometimes|required|min:6|string',
                'color' => 'sometimes|required|string',
                'category' => 'sometimes|required|string',
                'price' => 'sometimes|required|numeric'
            ];
        }

    }

    public function messages()
    {
        return [
            'name.required' => 'My name is rubin'
        ];
    }
}
