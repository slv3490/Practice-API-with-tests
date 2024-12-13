<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function createUser(Request $request)
    {
        $user = User::create($request->all());
        $token = $user->createToken("TOKEN_NAME")->plainTextToken;

        return response()->json(["token" => $token]);
    }
}
