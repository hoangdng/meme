<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class PostCategoryController extends Controller
{
    public function showCategories($postId)
    {
        $thePost = Post::find($postId);

        if ($thePost == null) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        $categories = $thePost->categories()->get();
        return response()->json(["data" => $categories], 200);
    }

    public function showPosts($categoryId)
    {
        $theCategory = Category::find($categoryId);

        if ($theCategory == null) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        $posts = $theCategory->posts()->get();
        return response()->json(["data" => $posts], 200);
    }
}
