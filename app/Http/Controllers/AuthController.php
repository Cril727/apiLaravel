<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller{

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'string'
        ]);

        if ($validate->fails()){
            return response()->json([
                'errors' => $validate->errors()
            ], 422);
    
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role ?? 'user',
            'password' => Hash::make($request->password)
        ]);

        try {
            $token = JWTAuth::fromUser($user); 
            return response()->json([
                'success' => true,
                'user' => $user,
                'token' => $token
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Could not create token'
            ], 500);
        }
    }

    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8'
        ]);
        
        if($validate->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validate->errors()
            ], 422);
        }

        //
        $credentials = $request->only('email', 'password');
        if(!$token = JWTAuth::attempt($credentials)){
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'token' => $token
        ], 200);

    }

    public function logout(Request $request)
    {
        try {
            $user = JWTAuth::user();
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json([
                'success' => true,
                'message' => $user->name . 'User logged out successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Could not logout user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function me(){
        return response()->json([
            'success' => true,
            'user' => JWTAuth::user(),
        ]);
    }
}   