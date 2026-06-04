<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateShopProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $product = $this->route('product');

        return [
            'club_id' => ['sometimes', 'integer', 'exists:clubs,id'],
            'slug' => ['sometimes', 'string', 'max:255', Rule::unique('shop_products', 'slug')->ignore($product?->id)],
            'name_fr' => ['sometimes', 'string', 'max:255'],
            'name_en' => ['sometimes', 'string', 'max:255'],
            'category' => ['sometimes', 'string', 'max:100'],
            'price' => ['sometimes', 'string', 'max:50'],
            'image' => ['sometimes', 'string', 'max:255'],
            'is_new' => ['boolean'],
            'is_sale' => ['boolean'],
            'old_price' => ['nullable', 'string', 'max:50'],
            'rating' => ['nullable', 'integer', 'min:0', 'max:5'],
            'reviews' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['boolean'],
        ];
    }
}