<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        if ($products) {
            // return response()->json([
            //     'status' => true,
            //     'message' => 'Products retrieved successfully',
            //     'data' => $products,
            // ]);
            return ProductResource::collection($products);
        } else {
            return response()->json(['message' => 'No products found'], 404);
        }
    }

    public function store()
    {
        //
    }
}
