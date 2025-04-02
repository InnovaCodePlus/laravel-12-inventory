<?php

namespace App\Http\Controllers\Product;

use App\Http\Requests\Product\ProductRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\Controller;
use Orion\Http\Requests\Request;

class ProductController extends Controller
{
    use DisableAuthorization;

    protected $model = Product::class;

    protected $resource = ProductResource::class;    
    protected $collectionResource = ProductCollection::class;
    
    protected $request = ProductRequest::class;


    protected function beforeSave(Request $request, $product)
    {
        $product->slug = $this->createSlug($request["name"]);   
    }


    private function createSlug($text)
    {
        $text = strtolower($text);

        $text = preg_replace('/[^a-z0-9]+/', '-', $text);

        $text = trim($text, '-');

        $text = preg_replace('/_+/', '-', $text);

        return $text;
    }
}
