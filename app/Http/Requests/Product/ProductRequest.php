<?php

namespace App\Http\Requests\Product;

use Orion\Http\Requests\Request;

class ProductRequest extends Request 
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function storeRules(): array
    {
        return [
            "name" => "required|unique:products,name",
            "category_id" => "required|exists:categories,id",
            "slug" => "nullable",
            "description" => "required",
            "price" => "required|numeric",
            "stock" => "required|numeric",
            "image" => "required|string",
            "status" => "nullable",
        ];
    }

    // REGLAS DE STORERULES EN ESPAÑOL
    public function storeMessages(): array
    {
        return [
            "name.required" => "El nombre es obligatorio",
            "name.unique" => "El nombre ya existe",
            "category_id.required" => "La categoría es obligatoria",
            "category_id.exists" => "La categoría no existe",
            "slug.nullable" => "El slug es opcional",
            "description.required" => "La descripción es obligatoria",
            "price.required" => "El precio es obligatorio",
            "price.numeric" => "El precio debe ser un número",
            "stock.required" => "El stock es obligatorio",
            "stock.numeric" => "El stock debe ser un número",
            "image.required" => "La imagen es obligatoria",
            "image.string" => "La imagen debe ser un string",
            "status.nullable" => "El estado es opcional",
        ];
    }


    // REGLAS DE UPDATERULES EN ESPAÑOL
    public function updateRules(): array
    {
        return [
            "name" => "required|unique:products,name,",
            "category_id" => "required|exists:categories,id",
            "slug" => "nullable",
            "description" => "required",
            "price" => "required|numeric",
            "stock" => "required|numeric",
            "image" => "required|string",
            "status" => "nullable",
        ];
    }

    public function updateMessages(): array
    {
        return [
            "name.required" => "El nombre es obligatorio",
            "name.unique" => "El nombre ya existe",
            "category_id.required" => "La categoría es obligatoria",
            "category_id.exists" => "La categoría no existe",
            "slug.nullable" => "El slug es opcional",
            "description.required" => "La descripción es obligatoria",
            "price.required" => "El precio es obligatorio",
            "price.numeric" => "El precio debe ser un número",
            "stock.required" => "El stock es obligatorio",
            "stock.numeric" => "El stock debe ser un número",
            "image.required" => "La imagen es obligatoria",
            "image.string" => "La imagen debe ser un string",
            "status.nullable" => "El estado es opcional",
        ];
    }



}
