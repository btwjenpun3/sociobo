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

    public function handleProviderCallbackTwitter() {
        $user = Socialite::driver('twitter')->user();
        $data = User::where('id', auth()->id())->first();
        $data->update([
            'provider' => 'twitter',
            'provider_id' => $user->id
        ]);
        // Auth::attempt($authUser);
        return redirect()->route('twitter');
    }
}