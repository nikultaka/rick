<?php

namespace App\Http\Controllers\containertheme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainthemepageController extends Controller
{
    public function login(){
    	return view('containerlayouts/login');
    }
}