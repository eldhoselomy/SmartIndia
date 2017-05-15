<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Log;

class LoginController extends Controller
{
    public function __construct()
    {
        
    }
    public function test()
    {
        Log::info('ajoooo');
        return view('Login/login');
    }
}
