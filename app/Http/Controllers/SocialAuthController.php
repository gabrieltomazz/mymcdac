<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SocialAccountService;
use Socialite;

class SocialAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();   
    } 
    public function redirectGoogle()
    {
        return Socialite::driver('google')->redirect();   
    }   

    public function callback(SocialAccountService $service)
    {
        // when facebook call us a with token 
        $user = $service->createOrGetUser(Socialite::driver('facebook')->user());

        auth()->login($user);

        return redirect()->to(route('register'));
    }
    public function callbackGoogle(SocialAccountService $service)
    {
        // when google call us a with token 
        $user = $service->createOrGetUserGoogle(Socialite::driver('google')->user());

        auth()->login($user);

        return redirect()->to(route('register'));
    }
}