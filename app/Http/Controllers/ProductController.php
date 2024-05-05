<?php

namespace App\Http\Controllers;

use App\Models\Product;
// use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function createProduct(Request $request)
    {
        $request->validate([
            'product_name' => 'required|min:3|max:200|string',
            'description' => 'required|min:3|max:200|string',
            'price' => 'required|numeric|string',
        ]);

        Product::create([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return response()->json([
            'message' => 'Product created successfully',
            'status' => 200
        ], 200);
    }

    public function getAllProducts()
    {
        // $userId = auth()->user()->id;
        // $user = User::find($userId);
        $products = Product::get();

        return response()->json([
            'message' => 'All products',
            'status' => 200,
            // 'user' => $user,
            'data' => $products
        ], 200);
    }

    public function getSingleProduct($productId)
    {
        $product = Product::findOrFail($productId);

        return response()->json([
            'message' => 'Single product',
            'status' => 200,
            'data' => $product
        ], 200);
    }

    public function updateProduct(Request $request, $productId)
    {
        $request->validate([
            'product_name' => 'required|min:3|max:200|string',
            'description' => 'required|min:3|max:200|string',
            'price' => 'required|numeric|string',
        ]);

        Product::findOrFail($productId)->update([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return response()->json([
            'message' => 'Product updated successfully',
            'status' => 200,
        ], 200);
    }

    public function deleteProduct($productId)
    {
        $productToDelete = Product::find($productId);

        $productToDelete->delete();

        return response()->json([
            'message' => 'Product deleted successfully',
            'status' => 200,
        ], 200);
    }
}
