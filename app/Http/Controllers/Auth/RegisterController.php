<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Socialite;
use App\SocialProvider;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }




    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

   
    public function handleProviderCallback()
    {
        


        try {
            $social_user = Socialite::driver('facebook')->user();
        }
        catch(\Exception $e) {
            return redirect('/');    
        }

        $socialProvider=SocialProvider::where('provider_id', $social_user->getId())->first();
        
        if(!$socialProvider) {
            $user = User::firstOrCreate(
                ['email' => $social_user->getEmail()],
                ['name' => $social_user->getName()]
            );
            $user->socialProviders()->create(
                ['provider_id'=> $social_user->getId(), 'provider' => 'facebook']
            );

        } else {
            $user = $socialProvider->user;



        }

        // $user=User::where('facebook_id', $social_user->getId())->first();
        // if(!$user) {
        //     User::create([
        //         'facebook_id' => $social_user->getId(),
        //         'name' => $social_user->getName(),
        //         'email' => $social_user->getEmail()
        //     ]);
        // }

        auth()->login($user);

        return redirect()->to('/home');

      //  return $social_user->getEmail();
    }
}
