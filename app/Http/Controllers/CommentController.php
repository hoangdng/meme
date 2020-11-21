<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function show($postId)
    {
        $thePost = Post::find($postId);

        if ($thePost == null) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        $comments = $thePost->comments()->get();
        return response()->json(["data" => $comments], 200);
    }

    public function store(Request $request)
    {
        $postId = $request->input('post_id');
        $username = $request->input('username');
        $content = $request->input('content');

        Comment::create([
            'post_id' => $postId,
            'username' => $username,
            'content' => $content,
        ]);

        $newComment = Comment::get()->sortBy('id')->last();
        return response()->json(['data' => $newComment], 201);

    }

    public function update(Request $request, $id)
    {
        $theComment = Comment::find($id);

        if ($theComment == null) {
            return response()->json(['error' => 'Comment not found'], 404);
        }

        $theComment->update($request->only(['content']));
        return response()->json(['data' => $theComment, 'message' => "Update successfully"], 200);
    }

    public function delete($id)
    {
        $theComment = Comment::find($id);

        if ($theComment == null) {
            return response()->json(['error' => 'Comment not found'], 404);
        }

        $theComment->delete();
        return response()->json(['message' => 'Delete successfully'], 200);
    }
}
