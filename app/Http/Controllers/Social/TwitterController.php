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
}
