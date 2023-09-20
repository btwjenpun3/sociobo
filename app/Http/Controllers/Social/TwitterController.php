<?php

namespace App\Http\Controllers\Social;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\oAuth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterController extends Controller
{  
    private $consumerKey;
    private $consumerSecret;

    public function __construct() {
        $this->consumerKey = env('TWITTER_CONSUMER_KEY');
        $this->consumerSecret = env('TWITTER_CONSUMER_SECRET'); 
    }

    public function index() {        
        $userData = oAuth::where('user_id', auth()->id())->first();
        $connection = new TwitterOAuth($this->consumerKey, $this->consumerSecret, $userData->oauth_token, $userData->oauth_token_secret);
        if(isset($userData)) {   
            $user = $connection->get('account/verify_credentials', ['tweet_mode' => 'extended', 'include_entities' => 'true']);         
            // return view('Pages.Social Media.Twitter.index', [
            //     'name' => $userData->screen_name,
            // ]);
            return response()->json($user);
        } else {
            return view('Pages.Social Media.Twitter.index');
        }
    }  
}
