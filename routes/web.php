<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/login/redirect', [AuthenticatedSessionController::class, 'redirectToProvider']);
Route::get('/login/callback', [AuthenticatedSessionController::class, 'handlProviderCallback']);

Route::get('/register/{provider}', [RegisteredUserController::class, 'redirectToProvider']);
Route::get('/register/{provider}/callback', [RegisteredUserController::class, 'handlProviderCallback']);


// Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
// Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

// Route::get('/login/redirect', function () {
//     return Socialite::driver('github')->redirect();
// });

// Route::get('/login/callback', function () {
//     $user = Socialite::driver('github')->user();
//     dd($user);
// });


require __DIR__.'/auth.php';
