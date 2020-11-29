<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'asc')->get();
        return response()->json(["data" => $posts], 200);
    }

    public function show($id)
    {
        $thePost = Post::with(['comments', 'categories'])->find($id);
        if ($thePost != null) {
            return response()->json(["data" => $thePost], 200);
        }

        return response()->json(['error' => 'Post not found'], 404);
    }

    public function store(PostRequest $request)
    {
        $file = $request->file('image');
        $fileExtension = $file->getClientOriginalExtension();
        $fileName = 'image_' . Auth::user()->username . '_' . time() . '.' . $fileExtension;
        $file->move('upload/images/', $fileName);

        Post::create([
            'title' => $request->input('title'),
            'image' => $fileName,
            'posted_date' => Carbon::now(),
            'username' => Auth::user()->username,
            'status' => 'PENDING',
            'vote_up' => 0,
            'vote_down' => 0,
        ]);

        $newPost = Post::get()->sortBy('id')->last();
        return response()->json(['data' => $newPost], 201);
    }

    public function update(PostRequest $request, $id)
    {
        $thePost = Post::find($id);

        if ($thePost == null) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        $thePost->update($request->except(['username', 'image']));
        return response()->json(['data' => $thePost, 'message' => "Post updated"], 200);
    }

    public function delete(PostRequest $request, $id)
    {

        $thePost = Post::find($id);

        if ($thePost == null) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        $thePost->votes()->delete();
        $thePost->comments()->delete();
        $thePost->delete();
        return response()->json(['message' => 'Delete successfully'], 200);
    }
}
