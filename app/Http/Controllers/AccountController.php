<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{

    public function store(Request $request)
    {
        //validate request data
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:100|alpha_num|unique:accounts',
            'password' => 'required|between:6,100|alpha_num',
            'email' => 'required|email|unique:accounts',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 409);
        } else {
            //store new user in table accounts
            Account::create([
                'email' => $request->input('email'),
                'username' => $request->input('username'),
                'password' => Hash::make($request->input('password')),
            ]);
            $newAccount = Account::latest()->first();

            //call method store from UserController to store new user info in table users
            app()->call('App\Http\Controllers\UserController@store', [$request->input('username')]);

            return response()->json(['data' => $newAccount], 201);
        }
    }
}
