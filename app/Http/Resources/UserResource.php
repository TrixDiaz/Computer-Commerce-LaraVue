<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'role_id' => $this->role_id,
            'phone' => $this->phone,
            'address' => $this->address,
            'role' =>  RoleResource::make($this->whenLoaded('role')),
            'birth_date' => $this->birth_date,
            'created_at' => $this->created_at->toFormattedDateString(),
            'updated_at' => $this->updated_at->diffForHumans(),
        ];
    }
}
