<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
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
     * CallBack url Function
     */
    function GithubCallBack(){
        $user = Socialite::driver('github')->user();

        $user->getId();
        $user->getNickname();
        $user->getName();
        $user->getEmail();
        $user->getAvatar();
    }
}
