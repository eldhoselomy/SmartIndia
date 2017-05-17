<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Team;
use App\Models\Member;
use App\Models\Topic;
use App\Models\Feedback;
use App\Models\Notification;
use Log;
use Session;
use Auth;
use Illuminate\Contracts\Auth\Guard;
use Validator;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

   // protected $user; 
     protected $auth;

    public function __construct(Guard $auth, User $user)
    {
        $this->user = $user; 
        $this->auth = $auth;
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function login()
    {
        Log::info('ajoooo');
        return view('login');
    }
    public function signin(Guard $auth,Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');

        Log::info("email =============".$email);
        Log::info("password ================" . $password);

        $user = User::where('email', $email)
                ->first();
       
        if($user) {
           if (Auth::attempt(['email' => $email, 'password' => $password, 'status' => 1])) {

                Log::info("aaaaaaaaaaaaaaaaaaaaa");
                $userid =  Auth::user()->id;
                Log::info($userid);
                return view('index');
                
            }else{
                 return redirect('user/login')->withErrors([
                'email' => 'The credentials you entered did not match our records. Try again?',
                ]);    
            }
  
        }else{
            return redirect('user/login')->withErrors([
                'email' => 'The credentials you entered did not match our records. Try again?',
                ]); 
        }
    }

     
    public function logout()
    {  

    Log::info("cccccccccccccccccccccccc");     
        Auth::logout();
        Session::flush();
        return redirect('user/login');
    }

    
}
