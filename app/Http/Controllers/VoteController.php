<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoteRequest;
use App\Models\Post;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function store(VoteRequest $request)
    {
        $postId = $request->input('post_id');
        $type = $request->input('type');

        Vote::create([
            'post_id' => $postId,
            'username' => Auth::user()->username,
            'type' => $type,
        ]);

        $type == 'UP' ? Post::find($postId)->increment('vote_up') : Post::find($postId)->increment('vote_down');

        $newVote = Vote::get()->sortBy('id')->last();
        return response()->json(['data' => $newVote], 201);

    }

    public function update(VoteRequest $request, $id)
    {
        $theVote = Vote::find($id);

        if ($theVote == null) {
            return response()->json(['error' => 'Vote not found'], 404);
        }

        $theVote->type == 'UP' ? $theVote->type = 'DOWN' : $theVote->type = 'UP';
        $theVote->save();

        $postId = $theVote->post_id;
        if ($theVote->type == 'UP') {
            Post::find($postId)->increment('vote_up');
            Post::find($postId)->decrement('vote_down');
        } else {
            Post::find($postId)->increment('vote_down');
            Post::find($postId)->decrement('vote_up');
        }

        return response()->json(['data' => $theVote, 'message' => "Update successfully"], 200);
    }

    public function delete(VoteRequest $request, $id)
    {
        $theVote = Vote::find($id);

        if ($theVote == null) {
            return response()->json(['error' => 'Vote not found'], 404);
        }

        $postId = $theVote->post_id;
        $theVote->type == 'UP' ? Post::find($postId)->decrement('vote_up') : Post::find($postId)->decrement('vote_down');

        $theVote->delete();
        return response()->json(['message' => 'Delete successfully'], 200);
    }
}
