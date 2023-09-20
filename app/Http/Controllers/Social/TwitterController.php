<?php

namespace App\Http\Controllers\Social;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\oAuth;
use Illuminate\Support\Facades\Http;
use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterController extends Controller
{      
    public function index() {        
        $userData = oAuth::where('user_id', auth()->id())->first();
        return view('Pages.Social Media.Twitter.index', [
            'name' => $userData->screen_name,
        ]);
    }  
}
