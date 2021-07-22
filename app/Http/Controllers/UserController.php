<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => "required",
            "password" => "required"
        ]);
        $user = User::where('email', $validated['email'])->first();
        if (!$user) {
            abort(400, "Invalid Info");
        }
        if (Hash::check($validated['password'], $user->password)) {
            $user->tokens()->delete();
            $token = $user->createToken("default");
            return response()->json($token->plainTextToken);
            return ['token' => $token->plainTextToken];
        }
        abort(400, "Invalid Info");
    }
}
