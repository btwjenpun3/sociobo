<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    protected $redirectTo = '/';

    public function index() {
        return view('/Pages/Login/index', [
            'title' => 'Sociobo Login'
        ]);
    }

    public function redirectToProvider() {
        return Socialite::driver('twitter')->redirect();
    }

    public function findOrCreateUser($user) {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        return User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'provider' => 'twitter',
            'provider_id' => $user->id
        ]);
    }

    public function handleProviderCallback() {
        $user = Socialite::driver('twitter')->user();
        $authUser = $this->findOrCreateUser($user, 'twitter');
        Auth::login($authUser, true);
        return redirect($this->redirectTo);
    }    
   
}
