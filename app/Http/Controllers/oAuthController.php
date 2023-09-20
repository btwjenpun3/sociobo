<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Abraham\TwitterOAuth\TwitterOAuth;

class oAuthController extends Controller
{   
    private $twitterOAuth;
    private $callback;

    public function __construct() {
        $consumerKey = env('TWITTER_CONSUMER_KEY');
        $consumerSecret = env('TWITTER_CONSUMER_SECRET');
        $accessToken = env('TWITTER_ACCESS_TOKEN');
        $accessTokenSecret = env('TWITTER_ACCESS_TOKEN_SECRET');
        $this->callback = env('TWITTER_CALLBACK_URL');
        $this->twitterOAuth = new TwitterOAuth(
            $consumerKey, 
            $consumerSecret, 
            $accessToken, 
            $accessTokenSecret
        );
    }
    

    public function authorizeTwitter() {         
        $request_token = $this->twitterOAuth->oauth('oauth/request_token', array('oauth_callback' => $this->callback)); 
        $user = User::find(auth()->id());
        $user->update([
            'oauth_token' => json_decode($request_token->oauth_token),
            'oauth_token_secret' => json_decode($request_token->oauth_token_secret)
        ]);

        return redirect()->route('twitter');
    }

    // public function redirectToProviderTwitter() {
    //     return Socialite::driver('twitter')->redirect();
    // }  

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