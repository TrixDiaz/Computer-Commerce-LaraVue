<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'stocks' => 'required|integer',
            'image' => 'nullable|image',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'series_id' => 'nullabled|exists:series,id',
            'is_featured' => 'required|boolean',
            'is_sale' => 'required|boolean',
            'is_new' => 'required|boolean',
            'is_active' => 'required|boolean',
        ];
    }
    
}
