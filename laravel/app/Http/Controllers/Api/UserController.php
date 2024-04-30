<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

    }

    //Profile API (GET)

    public function profile(){

    }

    //Logout

    public function logout(){
        
    }
}
