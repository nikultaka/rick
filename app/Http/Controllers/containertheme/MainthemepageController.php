<?php

namespace App\Http\Controllers\containertheme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainthemepageController extends Controller
{
    public function login(){
    	return view('containerlayouts/login');
    }

    public function forgotpassword(){
    	return view('containerlayouts/getemail');
    }

    public function register(){
    	return view('containerlayouts/register');
    }

    public function newpassword($token){
        $data['token'] = $token;
		 return view('containerlayouts/forgotpassword', $data);
    }

    
}