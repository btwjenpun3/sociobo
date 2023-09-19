<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index() {
        return view('/Pages/Register/index', [
            'title' => 'Sociobo',
            'register' => 'Register Now'
        ]);
    }

    public function register(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'email' => ['required', 'unique:users', 'email'],
            'password' => 'required'
        ]);
        if($data) {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
            return redirect()->route('login')->with('registerSuccess', 'User Registration successfully. Please Login.');
        } 
        return redirect()->route('register')->with(['registerFailed' => 'User Registration error, please contact support']);
    }
}
