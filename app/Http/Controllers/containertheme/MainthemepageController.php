<?php

namespace App\Http\Controllers\containertheme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class MainthemepageController extends Controller
{
    public function login() {
        if (Auth::user()) {
            return redirect('/dashboard-theme');
        } 
    	return view('containerlayouts/login');
    }

    public function forgotpassword(){
        if (Auth::user()) {
            return redirect('/dashboard-theme');
        }
    	return view('containerlayouts/getemail');
    }

    public function register(){
    	return view('containerlayouts/register');
    }

    public function newpassword($token){
        if (Auth::user()) {
            return redirect('/dashboard-theme');
        }
        $data['token'] = $token;
		return view('containerlayouts/forgotpassword', $data);
    }

    
}