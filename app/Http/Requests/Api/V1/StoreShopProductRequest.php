<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreShopProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'club_id' => ['required', 'integer', 'exists:clubs,id'],
            'slug' => ['required', 'string', 'max:255', 'unique:shop_products,slug'],
            'name_fr' => ['required', 'string', 'max:255'],
            'name_en' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'price' => ['required', 'string', 'max:50'],
            'image' => ['required', 'string', 'max:255'],
            'is_new' => ['boolean'],
            'is_sale' => ['boolean'],
            'old_price' => ['nullable', 'string', 'max:50'],
            'rating' => ['nullable', 'integer', 'min:0', 'max:5'],
            'reviews' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['boolean'],
        ];
    }
}