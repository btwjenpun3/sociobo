<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\oAuth;

class SettingController extends Controller
{
    public function oAuthTwitter() {
        $count = oAuth::where('provider', 'twitter')->count();
        if($count > 0) {
            $oauth = oAuth::where('provider', 'twitter')->first();
            $oauth_token = $oauth->oauth_token;
            $oauth_token_secret = $oauth->oauth_token_secret;
            return view('Pages.Settings.oauth', [
                'authorize_button' => 1,
                'oauth_token' => $oauth_token,
                'oauth_token_secret' => $oauth_token_secret
            ]);
        } else {
            return view('Pages.Settings.oauth', [
                'authorize_button' => 0,
                'oauth_token' => NULL,
                'oauth_token_secret' => NULL
            ]);
        }
        
    }
}
