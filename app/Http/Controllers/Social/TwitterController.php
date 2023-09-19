<?php

namespace App\Http\Controllers\Social;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class TwitterController extends Controller
{
    public function index(Request $id) {
        $user = User::find($id);
        $userData = $user->first();
        return view('Pages.Social Media.Twitter.index', [
            'provider' => $userData->provider,
            'provider_id' => $userData->provider_id
        ]);
    }
}
