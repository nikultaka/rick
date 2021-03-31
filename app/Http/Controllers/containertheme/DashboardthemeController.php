<?php

namespace App\Http\Controllers\containertheme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardthemeController extends Controller
{
    public function index(){
    	return view('container/dashboard');
    }
}