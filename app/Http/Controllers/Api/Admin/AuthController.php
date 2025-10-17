<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

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
            $admin = Admin::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);
         return response()->json([
            'message' => 'user registered successfully',
             'user'=>$admin
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
        $admin = Admin::where('email', $request->email)->first();

        if (! $admin || ! Hash::check($request->password, $admin->password)) {
            return response()->json(['message' => 'incorrect email or password'], 401);
        }

        $token = $admin->createToken('admin_token', ['admin'])->plainTextToken;
         return response()->json([
            'message' => 'Login successful',
            'token'   => $token,
            'user'    => $admin
        ], 200);
    }

    public function profile(Request $request)
    {
        return response()->json([
            'admin' => $request->user()
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
