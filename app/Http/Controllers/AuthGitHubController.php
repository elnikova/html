<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class AuthGitHubController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handlProviderCallback()
    {
        $githubUser = Socialite::driver('github')->user();
        
        $user = User::where('email',  $githubUser->getEmail())->first();
        
        //Create a new user in our database
        if(!$user){
            $user = User::create([
                'name' => $githubUser->getName(),
                'email' => $githubUser->getEmail(),
            ]);
        }
        
        //Log the user 
        auth()->login($user, true);
        //Redirect to dashboard
        return redirect('dashboard');
    }
}
