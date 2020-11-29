<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'asc')->get();
        return response()->json(["data" => $posts], 200);
    }

    public function show($id)
    {
        $thePost = Post::find($id);
        if ($thePost != null) {
            return response()->json(["data" => $thePost], 200);
        }

        return response()->json(['error' => 'Post not found'], 404);
    }

    public function store(Request $request)
    {
        $title = $request->input('title');
        $imageLocation = $request->input('image_location');
        $postedDate = Carbon::now();
        $username = $request->input('username');
        $status = "PENDING";
        $voteUp = 0;
        $voteDown = 0;

        Post::create([
            'title' => $title,
            'image_location' => $imageLocation,
            'posted_date' => $postedDate,
            'username' => $username,
            'status' => $status,
            'vote_up' => $voteUp,
            'vote_down' => $voteDown,
        ]);

        $newPost = Post::get()->sortBy('id')->last();
        return response()->json(['data' => $newPost], 201);

    }

    public function update(Request $request, $id)
    {
        $thePost = Post::find($id);

        if ($thePost != null) {
            $thePost->update($request->except(['username']));
            return response()->json(['data' => $thePost, 'message' => "Update successfully"], 200);
        }

        return response()->json(['error' => 'Post not found'], 404);
    }

    public function delete($id)
    {
        $thePost = Post::find($id);

        if ($thePost != null) {
            $thePost->votes()->delete();
            $thePost->comments()->delete();
            $thePost->delete();
            return response()->json(['message' => 'Delete successfully'], 200);
        }

        return response()->json(['error' => 'Post not found'], 404);
    }
}
