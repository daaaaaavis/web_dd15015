<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public funciton login(){
    	return view('auth.login')
    }

    
}
