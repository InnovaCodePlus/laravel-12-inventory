<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\Category\CategoryResource;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::simplePaginate(5);

        return new CategoryCollection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        // $request->validated();

        $request["slug"] = $this->createSlug( $request["name"] );

        $category = Category::create($request->all());

        return response()->json([
            "message" => "Categoria creada con exito",
            "category" => $category,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $category = Category::find($id);
        
        if( !$category ){
            return response()->json([
                "message" => "La categoria no existe"
            ], 404);
        }
        
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $category = $this->show($id);

        $category = Category::find($id);
        
        if( !$category ){
            return response()->json([
                "message" => "La categoria no existe"
            ], 404);
        }

        $request["slug"] = $this->createSlug($request["name"]);

        $category->update($request->all());

        return response()->json([
            "message" => "Categoria actualizada",
            "category" => $category
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        
        if( !$category ){
            return response()->json([
                "message" => "La categoria no existe"
            ], 404);
        }

        $category->delete();

        return response()->json([
            "message" => "Categoria eliminada",
            "category" => $category
        ], 200);
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
