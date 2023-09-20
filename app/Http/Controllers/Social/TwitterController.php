<?php

namespace App\Http\Controllers\Social;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterController extends Controller
{
    public function index() {        
        $user = User::where('id', auth()->id())->first();
        return view('Pages.Social Media.Twitter.index', [
            'provider' => $user->provider,
            'provider_id' => $user->provider_id
        ]);
    }    

    public function getFollower() {
        $consumerKey = env('TWITTER_CONSUMER_KEY');
        $consumerSecret = env('TWITTER_CONSUMER_SECRET');
        $accessToken = env('TWITTER_ACCESS_TOKEN');
        $accessTokenSecret = env('TWITTER_ACCESS_TOKEN_SECRET');
        $callback = env('TWITTER_CALLBACK_URL');
        $twitterOAuth = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
        $request_token = $twitterOAuth->oauth('oauth/request_token', array('oauth_callback' => $callback));
        // return view('Pages.Social Media.Twitter.follower', [
        //     'followers' => $followers
        // ]);
        return response()->json($request_token);
        
    }
}
