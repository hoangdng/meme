<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    public function store(CommentRequest $request)
    {
        Comment::create([
            'post_id' => $request->input('post_id'),
            'username' => Auth::user()->username,
            'content' => $request->input('content'),
        ]);

        $newComment = Comment::get()->sortBy('id')->last();
        return response()->json(['data' => $newComment], 201);

    }

    public function update(CommentRequest $request, $id)
    {
        $theComment = Comment::find($id);

        if ($theComment == null) {
            return response()->json(['error' => 'Comment not found'], 404);
        }

        $theComment->update($request->only(['content']));
        return response()->json(['data' => $theComment, 'message' => "Update successfully"], 200);
    }

    public function delete(CommentRequest $request, $id)
    {
        $theComment = Comment::find($id);

        if ($theComment == null) {
            return response()->json(['error' => 'Comment not found'], 404);
        }

        $theComment->delete();
        return response()->json(['message' => 'Delete successfully'], 200);
    }
}
