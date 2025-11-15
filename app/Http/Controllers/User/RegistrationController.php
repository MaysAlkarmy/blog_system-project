<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class RegistrationController extends Controller
{

    public function showRegister()
    {
        return view('user.register');
    }

    public function register(Request $request){

        $fields= Validator::make($request->all(),[
          'name' => 'required|string|max:255',
          'email'=> 'required|string|email',
          
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
        if($fields->fails()){
            return response()->json($fields->errors());
    }
    
            $user= User::create([
                'name'=> $request->name,
                'email'=> $request->email,
                'password'=> Hash::make($request->password),
                
            ]);
            
       // Attempt login
        Auth::guard('web')->login($user);

        // Redirect to dashboard
        return redirect()->route('posts.index')->with('success', 'Registration successful!');
        
} 

   public function showLogin(){

    return view('user.login');
   }

   public function login(Request $request){

    // 1. Validate input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Attempt login
        if (Auth::guard('web')->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('posts.index')->with('success', 'Welcome back!');
        }

        return back()->withErrors(['email' => 'Invalid credentials.'])->onlyInput('email');
   }

   public function logout()
    {
        Auth::guard('web')->logout();
        return view('welcome');
    }

   public function dashboard()
    {
        return view('welcome');
    }
}
