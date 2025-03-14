<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //register user
    public function register(Request $request)
    {
        $request->validate
        ([
            "name"=>'required|string|max:255',
            "email"=>'required|string|email|unique:users',
            'password'=>'required|string|min:6|confirmed',
        ]);

        $user = User::create
        ([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role' => 'customer' // Default role is 'customer'
        ]);

        $token=$user->createToken('auth_token')->plainTextToken;

        return response()->json(['token'=>$token , 'user'=>$user],201);
    }


    //login user

    public function login(Request $request)
    {
        $request->validate
            ([
                "email"=>'required|email',
                'password'=>'required',
            ]);

            $user = User::where('email' , $request->email)->first();
            if(!$user || !Hash::check($request->password , $user->password))
            {
                throw ValidationException::withMessages
                ([
                    'email' => ['Invalid credentials.'],
                ]);
            }

            $token=$user->createToken('auth_token')->plainTextToken;
            return response()->json(['token' => $token , 'user' => $user] , 200);
    }


    //logout User
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully'],200);
    }

    //Get Authenticated User

    public function me(Request $request)
    {
        return response()->json($request->user());
    }


    public function updateRole(Request $request, $id)
    {
        // Make sure the user exists
        $user = User::findOrFail($id);
    
        // Only allow admins to update roles
        if (auth()->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized. Only admins can change roles.'], 403);
        }
    
        // Update the role
        $user->update(['role' => $request->role]);
    
        return response()->json(['message' => 'Role updated successfully', 'user' => $user]);
    }
    
}
