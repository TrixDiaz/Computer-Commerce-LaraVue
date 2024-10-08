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
            'series' => SeriesResource::make($this->whenLoaded('series')),
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'brand' => BrandResource::make($this->whenLoaded('brand')),
            'user' => UserResource::make($this->whenLoaded('user')),

            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'sale_price' => $this->sale_price,
            'stocks' => $this->stocks,
            'image_url' => $this->image ? asset('storage/' . $this->image) : null,
            'hover_image_url' => $this->hover_image ? asset('storage/' . $this->hover_image) : null,
            'is_featured' => $this->is_featured,
            'is_sale' => $this->is_sale,
            'is_new' => $this->is_new,
            'is_active' => $this->is_active,

            'created_at' => $this->created_at->toFormattedDateString(),
            'updated_at' => $this->updated_at->diffForHumans(),
        ];
    }
}
