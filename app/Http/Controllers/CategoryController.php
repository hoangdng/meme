<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'asc')->get();
        return response()->json(["data" => $categories]);
    }

    public function show($id)
    {
        $theCategory = Category::with('posts')->find($id);
        if ($theCategory != null) {
            return response()->json(["data" => $theCategory], 200);
        }
        return response()->json(["error" => "Category not found"], 404);
    }
}
