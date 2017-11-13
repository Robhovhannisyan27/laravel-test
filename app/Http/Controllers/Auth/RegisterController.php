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
    
    use RegistersUsers;

    
    protected $redirectTo = '/register/verify';

    
    public function __construct()
    {
        $this->middleware('guest')->except(['verify', 'confirm']);
    }

    
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    
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
