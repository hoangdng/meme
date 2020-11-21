<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{

    public function store(Request $request)
    {
        $email = $request->input('email');
        $username = $request->input('username');
        $password = $request->input('password');

        //store new user in table accounts
        Account::create([
            'email' => $email,
            'username' => $username,
            'password' => Hash::make($password),
        ]);
        $newAccount = Account::latest()->first();

        //call method store from UserController to store new user info in table users
        app()->call('App\Http\Controllers\UserController@store', [$username]);

        return response()->json(['data' => $newAccount], 201);
    }

}
