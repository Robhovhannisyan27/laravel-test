<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Auth;
use Mail;
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
    protected $redirectTo = '/register/verify';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['verify', 'confirm']);
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
            'confirm_token' => str_random(30)
        ]);
    }

    protected function verify(){
        if(Auth::user()->success == 0){
            $token = Auth::user()->confirm_token;
            $url = env('APP_URL', 'http://blog.dev').'/verify/'. $token;
            $email = Auth::user()->email;

            Mail::send('auth.confirmEmail', ['url' => $url], function($message) use ($email){
                $message->from('hovhannisyanrob27@gmail.com', 'blog');
                $message->to($email);
                $message->subject('Please confirm your email address!!!');
            });
            return view('auth.verify');
        }
        else {
            return redirect('home');
        }
    }


    protected function confirm($token){
        $user = User::where('confirm_token', $token)->first();
        
        if(!is_null($user)){
            $user->success = 1;
            $user->confirm_token = '';
            $user->save();
            return redirect('login')->with('status', 'Your activation is completed');
        }
        return redirect('login')->with('status', 'Something went wrong');

    }

}
