<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    
    use AuthenticatesUsers;

    
    protected $redirectTo = '/home';

    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToFacebookProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

   
    public function handleFacebookProviderCallback()
    {

       $SocialUser =  Socialite::driver('facebook')->user();
        $findUser = User::where('email', $SocialUser->email)->first();
        if ($findUser) {
            Auth::login($findUser);
            return redirect('home');

        } else {
            $user = new User;
            $user->name=$SocialUser->name;
            $user->email=$SocialUser->email;
            $user->password=bcrypt(str_random(10));
            $user->save();
            Auth::login($user);
            return redirect('home');
        }
    }
}
