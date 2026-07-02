<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => [
                'fr' => $this->name_fr,
                'en' => $this->name_en,
            ],
            'category' => $this->category,
            'price' => $this->price,
            'image' => env('APP_URL') . $this->image,
            'isNew' => $this->is_new,
            'isSale' => $this->is_sale,
            'oldPrice' => $this->old_price,
            'rating' => $this->rating,
            'reviews' => $this->reviews,
        ];
    }
}
