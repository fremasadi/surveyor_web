<?php

// app/Http/Controllers/AuthController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Find the user by email and check their role
    $user = User::where('email', $request->email)->first();

    if (!$user || $user->role !== 'user' || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect or the user is not authorized.'],
        ]);
    }

    // Generate a token for the user
    $token = $user->createToken('YourAppName')->plainTextToken;

    return response()->json([
        'message' => 'Login Berhasil',
        'data' => [
            'userId' => $user->id,  // Wrap userId in the data array
            'name' => $user->name,   // Wrap name in the data array
            'email' => $user->email  // Wrap email in the data array
        ],
        'token' => $token,

    ]);
}

}
