<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([

            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),


        ]);
        return response()->json([

            "code" => 201,
            "data" => $user
        ], 201);
    }
}
