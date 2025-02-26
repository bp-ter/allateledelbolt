<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [

            "id" => $this->id,
            "name" => $this->name,
            "brand" => $this->brand->brand,
            "category" => $this->category->category,
            "package" => $this->package->package,
            "price" => $this->price
        ];
    }
}
