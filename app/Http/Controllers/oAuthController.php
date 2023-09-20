<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\oAuth;
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
        $connection = new TwitterOAuth($this->consumerKey, $this->consumerSecret, $request_token['oauth_token'], $request_token['oauth_token_secret']);
        $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));        
        // $access_token = $connection->oauth("oauth/access_token", [
        //     "oauth_verifier" => $connection['oauth_verifier']
        // ]);        
        // oAuth::create([
        //     'user_id' => auth()->id(),
        //     'provider' => 'twitter',
        //     'provider_user_id' => $access_token->user_id,
        //     'screen_name' => $access_token->screen_name,
        //     'oauth_token' => $access_token->oauth_token,
        //     'oauth_token_secret' => $access_token->oauth_token_secret
        // ]);
        return redirect()->route('twitter');
    }     

    public function handleProviderCallbackTwitter() {        
        return redirect()->route('twitter');
    }
}