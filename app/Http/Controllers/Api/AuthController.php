<?php

namespace App\Http\Controllers\Api;

use App\User;
use Auth;
use Mail;
use Socialite;
use App\SocialProvider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(){
        return response().json(['a' => 'a'], 200);
    }
    public function login(Request $request, User $user)
    {

        $email = $request->get('email');
        $pass = $request->get('password');


        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        $inputs = ['email' => $request->get('email'), 'password' => $request->get('password')];
        if(!Auth::attempt($inputs, $request->has('remember'))){
            return response()->json(['message'=>"Incorect Login or Password"],403);
        }

        $user = $user->where('email', $request->get('email'))->first();
        Auth::login($user);
     
        return response()->json(['user' => Auth::user()],200);
    }

    public function get_user($user_id, User $user){
        $user = $user->where('id', $user_id)->first();
        return response()->json(['user' => $user], 200);
    }

    public function logout(){
        \Auth::logout();
        return response()->json(['message'=>"403"], 200);
    }

    public function register(RegisterRequest $request) {

    	
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'confirm_token' => md5(time().str_random(2)),
        ]);
        //dd($user);
        Auth::login($user);
        return response()->json(['user'=>Auth::user()], 200);
    }
    
   
}
