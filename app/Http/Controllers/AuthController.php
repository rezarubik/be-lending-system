<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Register new user
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'phone_number' => 'required|string|unique:users',
            'id_card_number' => 'required|string|unique:users',
            // 'id_card_photo' => 'required|file',
            'monthly_income' => 'required|numeric',
            'role' => 'required|in:borrower,lender',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'birth_place' => $request->birth_place,
            'birth_date' => $request->birth_date,
            'phone_number' => $request->phone_number,
            'id_card_number' => $request->id_card_number,
            // 'id_card_photo' => $request->file('id_card_photo')->store('id_cards'),
            'monthly_income' => $request->monthly_income,
            'role' => $request->role,
            'password' => Hash::make('password123'),
        ]);

        $token = auth()->login($user);
        return response()->json(['token' => $token], 201);
    }


    // Login and create JWT token
    public function login(Request $request)
    {
        $credentials = $request->only('phone_number', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }

        return response()->json(['token' => $token]);
    }


    // Logout user (invalidate JWT token)
    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['message' => 'Successfully logged out']);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not log out'], 500);
        }
    }

    // Get authenticated user
    public function getUser()
    {
        return response()->json(auth()->user());
    }
}
