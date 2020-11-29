<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::orderBy('id', 'asc')->get();
        return response()->json(["data" => $reports], 200);
    }

    public function show($id)
    {
        $theReport = Report::with('post')->find($id);

        if ($theReport != null) {
            return response()->json(["data" => $theReport], 200);
        }
        return response()->json(['error' => 'Post not found'], 404);
    }

    public function store(Request $request)
    {
        $postId = $request->input('post_id');
        $username = $request->input('username');
        $content = $request->input('content');

        Report::create([
            'post_id' => $postId,
            'username' => $username,
            'content' => $content,
            'status' => 'UNSOLVED',
        ]);

        $newReport = Report::get()->sortBy('id')->last();
        return response()->json(['data' => $newReport], 201);

    }

    public function update($id)
    {
        $theReport = Report::find($id);

        if ($theReport == null) {
            return response()->json(['error' => 'Comment not found'], 404);
        }

        $theReport->status == 'UNSOLVED' ? $theReport->status = 'SOLVED' : $theReport->status = 'UNSOLVED';
        $theReport->save();

        return response()->json(['data' => $theReport, 'message' => "Update successfully"], 200);
    }

    public function delete($id)
    {
        $theReport = Report::find($id);

        if ($theReport == null) {
            return response()->json(['error' => 'Report not found'], 404);
        }

        $theReport->delete();
        return response()->json(['message' => 'Delete successfully'], 200);
    }
}
