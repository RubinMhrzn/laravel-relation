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
                'name' => 'required|min:5|string|max:20',
                'description' => 'nullable|string',
                'specification' => 'nullable|string',
                'features' => 'nullable|string',
                'brand' => 'required|string',
                'summary' => 'nullable|string',
                'variants' => 'array|required',
                'variants.*.price' => 'required|numeric|min:0',
                'variants.*.color_id' => 'nullable|exists:colors,id',
                'variants.*.size_id' => 'nullable|exists:sizes,id',
                'variants.*.is_parent' => 'boolean',
                'variants.*.base_price' => 'required|numeric|min:0',
                'variants.*.stock' => 'required|integer|min:0',
                'variants.*.status' => 'boolean',
                'files' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096'
            ];
        }

        if ($this->isMethod('PUT') || $this->isMethod('PATCh')) {
            return [
                'name' => 'sometimes|required|min:5|string|max:20',
                'description' => 'sometimes|nullable|string',
                'specification' => 'sometimes|nullable|string',
                'features' => 'sometimes|nullable|string',
                'brand' => 'sometimes|required|string',
                'summary' => 'sometimes|nullable|string',
                'variants' => 'sometimes|array|required',
                'variants.*.price' => 'sometimes|required|numeric|min:0',
                'variants.*.color_id' => 'sometimes|nullable|exists:colors,id',
                'variants.*.size_id' => 'sometimes|nullable|exists:sizes,id',
                'variants.*.is_parent' => 'sometimes|boolean',
                'variants.*.base_price' => 'sometimes|required|numeric|min:0',
                'variants.*.stock' => 'sometimes|required|integer|min:0',
                'variants.*.status' => 'sometimes|boolean',
                'files' => 'sometimes|nullable|image|mimes:jpg,jpeg,png,webp|max:4096'
            ];
        }

        return [];
    }

    public function messages()
    {
        return [
            'name.required' => 'My name is rubin'
        ];
    }
}
