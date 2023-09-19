<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class oAuthController extends Controller
{
    protected $redirectTo = '/';

    public function redirectToProviderTwitter() {
        return Socialite::driver('twitter')->redirect();
    }

    // public function createUser($user) {
    //     // $authUser = User::where('provider_id', $user->id)->first();        
    //     return User::update([
    //         // 'name'     => $user->name,
    //         // 'email'    => $user->email,
    //         'provider' => 'twitter',
    //         'provider_id' => $user->id
    //     ]);
    // }

    public function handleProviderCallbackTwitter() {
        $user = Socialite::driver('twitter')->user();
        $data = User::where('id', auth()->id())->first();
        $authUser = $data->update([
            'provider' => 'twitter',
            'provider_id' => $user->id
        ]);
        Auth::login($authUser);
        return redirect()->route('twitter');
    }
}