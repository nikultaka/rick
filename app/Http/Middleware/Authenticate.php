<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\Helpers\ParcelHelper;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
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
            if (! $request->expectsJson()) {
                return route('login');
            }    
        }
        
    }
}
