<?php

namespace App\Http\Controllers\Social;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\oAuth;
use App\Http\Controllers\oAuthController;
use Illuminate\Support\Facades\Http;
use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterController extends Controller
{    
    private $consumerKey;
    private $consumerSecret;
    private $twitterOAuth;
    private $callback;
    private $connection;
    private $userAccessToken;

    public function __construct() {
        $this->consumerKey = env('TWITTER_CONSUMER_KEY');
        $this->consumerSecret = env('TWITTER_CONSUMER_SECRET');
        $this->callback = env('TWITTER_CALLBACK_URL');
        $this->twitterOAuth = new TwitterOAuth(
            $this->consumerKey, 
            $this->consumerSecret
        );
        $userAccessToken = oAuth::where('user_id', auth()->id())->first();
        $this->connection = new TwitterOAuth($this->consumerKey, $this->consumerSecret, $userAccessToken->oauth_token, $userAccessToken->oauth_token_secret);
    }

    public function index() {        
        $userData = $this->userAccessToken;
        if(isset($userData)) {   
            $user = $this->connection->get('account/verify_credentials', ['tweet_mode' => 'extended', 'include_entities' => 'true']);         
            // return view('Pages.Social Media.Twitter.index', [
            //     'name' => $userData->screen_name,
            // ]);
            return response()->json($user);
        } else {
            return view('Pages.Social Media.Twitter.index');
        }
    }  
}
