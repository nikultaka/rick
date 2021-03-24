<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Helpers\ParcelHelper;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $currentURL = url()->current();
        if (strpos($currentURL, 'api') !== false) { 
            $response = [
                config('api.CODE')    => config('HttpCodes.accessDenied'),
                config('api.MESSAGE') => config('Messages.invalidCredentials'),
                config('api.RESULT')  => []
            ];
            ParcelHelper::sendResponse($response,config('HttpCodes.success'));
            exit;
        } else {
            $this->middleware('guest')->except('logout');    
        }
        
    }
}
