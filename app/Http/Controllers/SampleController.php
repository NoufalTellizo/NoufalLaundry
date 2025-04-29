<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryNewResource;
use App\Models\Category;
use App\Models\CategoryNew;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SampleController extends Controller
{
    public function showCategory($id)
    {
        $category = CategoryNew::whereId($id)->first();
        if (!$category) {
            return response()->json([
                'success' => false,
                'category' => null,
                'message' => 'No response to fetch.'
            ]);
        } elseif ($category = new CategoryNewResource(CategoryNew::whereId($id)->first())) {
            return response()->json([
                'success' => true,
                'category' => $category,
                'message' => 'Response success'
            ]);
        }
    }
    public function createProduct(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required',
                'category_id' => 'required',
                'sku' => 'required|unique:product_new_twos,sku,',
                'purchase_price' => 'required|numeric|min:0',
                'opening_balance' => 'nullable|numeric|min:0'
            ]);
        } catch (ValidationException $e) {
            $errors = [];

            foreach ($e->errors() as $field => $messages) {
                $errors[] = [
                    'error_field' => $field,
                    'messages' => $messages[0],
                ];
            }

            return response()->json([
                'success' => false,
                'errors' => $errors,
            ], 422);
        }
        $product = new \App\Models\ProductNewTwo();
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->sku = $request->sku;
        $product->purchase_price = $request->purchase_price;
        $product->opening_balance = $request->opening_balance;
        $product->description = $request->description;
        $product->is_active = $request->is_active;
        $product->save();
    }
}
