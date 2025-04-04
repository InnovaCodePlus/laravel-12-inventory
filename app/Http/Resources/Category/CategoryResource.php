<?php

namespace App\Http\Resources\Category;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{

    public static $wrap = "category";
    
    
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // $products = Product::where("category_id", $this->id)->get();
        // $products = $this->products;

        return [
            "id" => $this->id,
            "name" => $this->name,
            "slug" => $this->slug,
            // "products" => $products,
            "createdAt" => $this->created_at,
            "updatedAt" => $this->updated_at,
        ];
    }
}
