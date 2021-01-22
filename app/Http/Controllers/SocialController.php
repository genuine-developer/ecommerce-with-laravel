<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    /**
     * Github Login
     */
    function LoginWithGithub(){
        return Socialite::driver('github')->redirect();
    }
    /**
     * CallBack url Function for GITHUB
     */
    function GithubCallBack(){
        $user = Socialite::driver('github')->user();

        if( User::where('email', $user->getEmail())->exists()) {
            $get_user = User::where('email', $user->getEmail())->first();
            Auth::guard()->login($get_user, ture);

            return redirect()->to('/home');
        }
        else {
            $create_user = User::create([
                'name' =>  $user->getName(),
                'email' => $user->getEmail(),
                'provider' => 'github',
                'provider_id' => $user->getId(),
            ]);
            Auth::guard()->login($create_user, ture);
            return redirect()->to('/home');
        }
        // return $create_user;
        //return $create_user;
    }


    /**
     * Google Login
     */
    function LoginWithGoogle(){
        return Socialite::driver('google')->redirect();
    }
    /**
     * CallBack url Function for Google
     */
    function GoogleCallBack(){
        $user = Socialite::driver('google')->user();

        if( User::where('email', $user->getEmail())->exists()) {
            $get_user = User::where('email', $user->getEmail())->first();
            Auth::guard()->login($get_user, ture);

            return redirect()->to('/home');
        }
        else {
            $create_user = User::create([
                'name' =>  $user->getName(),
                'email' => $user->getEmail(),
                'provider' => 'github',
                'provider_id' => $user->getId(),
            ]);
            Auth::guard()->login($create_user, ture);
            return redirect()->to('/home');
        }
        // return $create_user;
        //return $create_user;
    }
}
