<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('Personal_Access_Token');

            return response()->json(['token' => $token->plainTextToken,'user' => $user], 200);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }


    public function Register(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'password'=> ['required', 'min:6', 'max:32'],
        ]);

        $user  = User::create($validatedData);
        $token = $user->createToken('Personal_Access_Token');

        auth()->setUser($user);

        event(new Registered($user));

        return response(
            [
                'token' => $token->plainTextToken,
                'user'  => $user,
            ], 201);

    }
}
