<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{    
    public function index() {
        return view('/Pages/Login/index', [
            'title' => 'Sociobo'
        ]);
    }  

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
            ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); 
            return redirect()->intended('/dashboard');
        }
        return redirect()->route('login')->with('loginError', 'Credentials doesnt match. Please try again.');
    }
}
