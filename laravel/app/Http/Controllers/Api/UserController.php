<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    // Register API (POST)
    public function register(Request $request){

        // Data validation
        $validatedData = $request->validate([
            "name" => "required|string|min:3|max:255|regex:/^[a-zA-Z\s]+$/",
            "email" => "required|email|unique:users|max:255",
            "password" => "required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/"
        ], [
            'name.regex' => 'Name can only contain letters and spaces.',
            'password.regex' => 'Password must include at least one uppercase letter, one lowercase letter, and one number.'
        ]);

        // Create User
        User::create([
            "name" => htmlspecialchars($validatedData['name']),
            "email" => htmlspecialchars($validatedData['email']),
            "password" => Hash::make($validatedData['password']),
            "role" => "user" // Default role is 'user'
        ]);

        Log::info('User registered', ['email' => $request->email]);

        return response()->json([
            "status" => true,
            "message" => "User created successfully"
        ]);
    }

    // Login API (POST)
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

            Log::info('User registered', ['email' => $request->email]);

            return response()->json([
                "status" => true,
                "message" => "User logged in successfully",
                "token" => $token,
                "role" => $user->role // Include user role in the response
            ]);
        }else{
            return response()->json([
                "status" => false,
                "message" => "Invalid login details"
            ]);
        }

    }

    // Profile API (GET)
    public function profile(){

        $user = Auth::user();

        return response()->json([
            "status" => true,
            "message" => "Profile information",
            "data" => $user
        ]);
    }

    // Logout
    public function logout(){
        
        auth()->user()->token()->revoke();  
        return response()->json([
            "status" => true,
            "message" => "User Logged out"

        ]);
    }

    // Delete a user
    public function delete(){

        $user = Auth::user(); //variable

        try{ //vins kaut ko meigina
            $user->delete(); //izdzees user
            auth()->user()->token()->revoke(); //atnem tam fujakam cepumu
            return response()->json([
                "message" => "User Deleted"
            ]);
                
        }catch (\Exception $e) { //vins noker eroru lai vins neaizskrien un nesaples man visu vietni
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    // Update user profile
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Profile updated successfully',
            'data' => $user
        ]);
    }

    public function index()
    {
    $users = User::all();
    return response()->json($users, 200);
    }
    public function destroy($id)
    {
    $user = User::findOrFail($id);
    $user->delete();
    return response()->json(['message' => 'User deleted successfully!'], 200);
    }
}
