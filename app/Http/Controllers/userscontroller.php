<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class userscontroller extends Controller
{
	public function index(){

	}

	public function create(){
		return view('admin.users.create');
	}

	public function store(Request $request){
		User::create([
			//$request->all()
			'name' => $request['name'],
			'email' => $request['email'],
			'password' => bcrypt($request['password']),
			]);
		return 'sucess';
		// return $Request->all(); 
	}
}
