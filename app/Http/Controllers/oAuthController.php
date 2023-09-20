<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\oAuth;
use App\Models\TempToken;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Abraham\TwitterOAuth\TwitterOAuth;

class oAuthController extends Controller
{   
    private $consumerKey;
    private $consumerSecret;
    private $twitterOAuth;
    private $callback;

    public function __construct() {
        $this->consumerKey = env('TWITTER_CONSUMER_KEY');
        $this->consumerSecret = env('TWITTER_CONSUMER_SECRET');
        $accessToken = env('TWITTER_ACCESS_TOKEN');
        $accessTokenSecret = env('TWITTER_ACCESS_TOKEN_SECRET');
        $this->callback = env('TWITTER_CALLBACK_URL');
        $this->twitterOAuth = new TwitterOAuth(
            $this->consumerKey, 
            $this->consumerSecret, 
            $accessToken, 
            $accessTokenSecret
        );
    }   

    public function authorizeTwitter() {         
        $request_token = $this->twitterOAuth->oauth('oauth/request_token', array('oauth_callback' => $this->callback));
        $url = $this->twitterOAuth->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token'])); 
        TempToken::create([
            'user_id' => auth()->id(),
            'oauth_token' => $request_token['oauth_token'],
            'oauth_token_secret' => $request_token['oauth_token_secret']
        ]);
        return redirect($url);
    }     

    public function handleProviderCallbackTwitter(Request $request) {  
        $tempToken = TempToken::where('user_id', auth()->id())->latest('user_id')->first();                   
        $connection = new TwitterOAuth($this->consumerKey, $this->consumerSecret, $tempToken->oauth_token, $tempToken->oauth_token_secret);
        $access_token = $connection->oauth("oauth/access_token", ["oauth_verifier" => $_REQUEST['oauth_verifier']]);

        return response()->json($access_token);
    }
}