<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'sale_price' => $this->sale_price,
            'stocks' => $this->stocks,
            'image' => $this->image,
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'brand' => BrandResource::make($this->whenLoaded('brand')),
            'user' => UserResource::make($this->whenLoaded('user')),
            'is_featured' => $this->is_featured,
            'is_sale' => $this->is_sale,
            'is_new' => $this->is_new,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at->toFormattedDateString(),
            'updated_at' => $this->updated_at->diffForHumans(),
        ];
    }
}
