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
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'image' => $this->image,
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'brand' => BrandResource::make($this->whenLoaded('brand')),
            'user' => UserResource::make($this->whenLoaded('user')),
            'created_at' => $this->created_at->toFormattedDateString(),
            'updated_at' => $this->updated_at->diffForHumans(),
        ];
    }
}
