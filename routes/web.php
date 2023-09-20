<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\oAuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Social\TwitterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// ----------------------------------------------------------- //
// ------------!! Login Route !!------------ //

Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('loginAuthenticate');

// ----------------------------------------------------------- //
// ------------!! Register Route !!------------ //

Route::get('/register', [RegisterController::class, 'index'])->name('register');

Route::post('/register', [RegisterController::class, 'register'])->name('userRegister');

// ----------------------------------------------------------- //
// ------------!! Dashboard Route !!------------ //

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// ----------------------------------------------------------- //
// ------------!! Twitter Route !!------------ //

Route::get('/twitter', [TwitterController::class, 'index'])->name('twitter');

Route::get('/twitter/follower', [TwitterController::class, 'getFollower']);

// ------------!! Twitter oAuth !!------------ //

Route::get('/oauth/twitter/login', [oAuthController::class, 'redirectToProviderTwitter'])->name('loginTwitter');

Route::get('/oauth/twitter/callback', [oAuthController::class, 'handleProviderCallbackTwitter'])->name('callbackTwitter');



