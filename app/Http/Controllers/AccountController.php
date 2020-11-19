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

        Account::create([
            'email' => $email,
            'username' => $username,
            'password' => Hash::make($password),
        ]);

        $newAccount = Account::find(1);
        return response()->json(['data' => $newAccount], 201);
    }

}
