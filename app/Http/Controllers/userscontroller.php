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

	public function store(Request $Request){
		User::create($Request->all());
		return 'sucess';
		return $Request->all(); 
	}
}
