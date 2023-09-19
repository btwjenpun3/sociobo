<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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

Route::get('/login', [LoginController::class, 'index']);

// ------------!! Twitter oAuth !!------------ //

Route::get('/oauth/twitter/login', [LoginController::class, 'redirectToProvider'])->name('loginTwitter');

Route::get('/oauth/twitter/callback', [LoginController::class, 'handleProviderCallback'])->name('callbackTwitter');

// ----------------------------------------------------------- //
// ------------!! Login Route !!------------ //
