<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(Request $request){

        $fields= Validator::make($request->all(),[
 
           'name'     => 'required|string|max:255',
           'email'    => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ],
        ]);
        if ($fields->fails()) {
            return response()->json(['errors' => $fields->errors()], 422);
        }

        try {
            $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);
         return response()->json([
            'message' => 'user registered successfully',
             'user'=>$user
            ]);

        } catch (\Exception $exception) {
            return response()->json(['error'=>$exception->getMessage()]);
          
        }   
    }

    public function login(Request $request){

         $fields = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($fields->fails()) {
            return response()->json(['errors' => $fields->errors()], 422);
        }
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'incorrect email or password'], 401);
        }

        $token = $user->createToken('user_token')->plainTextToken;
         return response()->json([
            'message' => 'Login successful',
            'token'   => $token,
            'user'    => $user
        ], 200);
    }

    public function profile(Request $request)
    {
        return response()->json([
            'user' => $request->user()
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }

    
}
