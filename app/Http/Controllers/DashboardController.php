<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function index() {
        $user = User::where('id', auth()->id())->first();        
        return view('/Pages/Dashboard/index', [
            'name' => $user->name
        ]);
    }
}
