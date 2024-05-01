<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Reguster API (POST)
    public function register(Request $request){

        // Data validation
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|confirmed"
        ]);

        // Create User
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password) 
        ]);

        return response()->json([
            "status" => true,
            "message" => "User created successfully"
        ]);
    }

    //Login API (POST)

    public function login(Request $request){

        // Data validation
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        // User login check
        if(Auth::attempt([
            "email" => $request->email,
            "password" => $request->password
        ])){

            // User exists
            $user = Auth::user();

            $token = $user->createToken("userToken")->accessToken;

            return response()->json([
                "status" => true,
                "message" => "User logged in successfully",
                "token" => $token
            ]);
        }else{
            return response()->json([
                "status" => false,
                "message" => "Invalid login details"
            ]);
        }

    }

    //Profile API (GET)

    public function profile(){

        $user = Auth::user();

        return response()->json([
            "status" => true,
            "message" => "Profile information",
            "data" => $user
        ]);
    }

    //Logout

    public function logout(){
        
        auth()->user()->token()->revoke();  
        return response()->json([
            "status" => true,
            "message" => "User Logged out"

        ]);
    }
}
