<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function store($username)
    {
        User::create([
            'username' => $username,
            'status' => 'ACTIVE',
            'role' => 'ROLE_MEMBER',
        ]);

        $newUser = User::latest()->first();
        return response()->json(['data' => $newUser], 201);
    }

    public function index()
    {
        $users = User::orderBy('id', 'asc')->get();
        return response()->json(['data' => $users], 200);
    }

    public function show($id)
    {
        $theUser = User::find($id);
        return response()->json(['data' => $theUser], 200);
    }

    public function update(Request $request, $id)
    {
        $theUser = User::find($id);

        if ($theUser != null) {
            $theUser->update($request->except(['username', 'avatar']));
            return response()->json(['data' => $theUser, 'message' => "Update successfully"], 200);
        }

        return response()->json(['error' => 'Username is not found in database'], 404);
    }

    //delete user in table users and account of deleted user in table accounts
    public function delete($id)
    {
        $username = User::find($id)->username;

        Account::where('username', $username)->delete();
        User::where('username', $username)->delete();

        return response()->json(['message' => "User {$username} deleted"], 200);
    }

    public function uploadAvatar(Request $request)
    {
        if ($request->hasfile('avatar')) {
            $file = $request->file('avatar');
            $fileExtension = $file->getClientOriginalExtension();
            $fileName = 'avatar_' . Auth::user()->username . '.' . $fileExtension;
            $file->move('upload/avatars/', $fileName);

            $user = User::find(Auth::user()->id);
            $user->avatar = $fileName;
            $user->save();

            return response()->json(['message' => "Avatar uploaded"], 200);
        } else {
            return response()->json(['error' => 'Upload file not found'], 404);
        }
    }
}
