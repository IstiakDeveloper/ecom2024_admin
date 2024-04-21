<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return response()->json($products);
    }

    public function getProductsByCategory($category_name)
    {
        // Retrieve the category based on its name
        $category = Category::where('name', $category_name)->first();

        if (!$category) {
            // Handle case when category does not exist
            return response()->json(['error' => 'Category not found'], 404);
        }

        // Retrieve products belonging to the category with category data included
        $products = Product::where('category_id', $category->id)->with('category')->get();

        return response()->json($products);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
