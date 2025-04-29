<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryNewResource;
use App\Models\CategoryNew;
use App\Models\Unit;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function showCategories()
    {
        $categories = CategoryNewResource::collection(CategoryNew::get());
        if (!$categories) 
        {
            return response()->json([
                'success' => false,
                'message' => 'No response to fetch.'
            ]);
        }
        return response()->json([
            'success' => true,
            'data' => $categories,
            'message' => 'Response success'
        ]);
    }
}
