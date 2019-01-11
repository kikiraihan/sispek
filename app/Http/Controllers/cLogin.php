<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class cLogin extends Controller
{
	public function __construct()
    {
        $this->middleware('guest');
    }

	public function getLogin(){
		return view('login.login');
	}

	public function postLogin(Request $request){

		// dd($user = Auth::user());
		// dd(Auth::attempt([
		// 	'username' => $request->usernameEmail, 
		// 	'password' => $request->password,
		// 	'kategori' => $request->kategori,
		// ]));

		
		if (Auth::attempt([
			'username' => $request->usernameEmail, 
			'password' => $request->password,
			'kategori' => $request->kategori,
		])){
			// if ($request->kategori=='Admin') 			return 'ini admin';
			// else if ($request->kategori=='Operator') 	return 'ini operator';
			return redirect('/');
		} 
		elseif (Auth::attempt([
			'email' => $request->usernameEmail, 
			'password' => $request->password,
			'kategori' => $request->kategori,
		])) {
			return redirect('/');
		}
		else{
			return 'salah datanya';
		}

	}
}
