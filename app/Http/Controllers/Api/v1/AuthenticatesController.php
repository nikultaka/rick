<?php

namespace App\Http\Controllers\Api\v1;

use Auth;
use App\Helpers\ParcelHelper;
use App\Http\Controllers\Controller;
use App\Models\OauthAccessToken;
use App\Models\User;
use App\Models\Session;
use App\Models\AppVersion;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class AuthenticatesController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param Request $request
     */
    public function login(Request $request)
    {

        try {
            //Validate all requested data
            ParcelHelper::validateRequest($request->all(), self::loginValidationRules($request->all()));

            if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                $credentials = array(
                    'email'    => $request->email,
                    'password' => $request->password,
                );
            } 

            if (!Auth::attempt($credentials)) {
                /*throw new Exception(config('Messages.invalidCredentials'), config('HttpCodes.accessDenied')); //send response*/
                $response = [
                    config('api.CODE')    => config('HttpCodes.accessDenied'),
                    config('api.MESSAGE') => config('Messages.invalidCredentials'),
                    config('api.RESULT')  => []
                ];
                ParcelHelper::sendResponse($response,config('HttpCodes.success'));
                exit;
            }

            //check if user is active or not
            if (config('UserStatus.approved') != auth()->user()->user_status) {
                throw new Exception(config('Messages.accountDisapproved'), config('HttpCodes.accessDenied'));
            }

            // If user is authenticated then we have to delete there all token and relogin again this way
            // we can logout from all the devices as there no way for API on Laravel Default

            OauthAccessToken::deleteTokenFromOtherDevice(auth()->user()->id);

            Auth::attempt($credentials);


            //get user from Auth
            $user = User::find(auth()->user()->id);


            
            //Fetching session id if exist in session
            $sessionId = Session::getSessionId($user->id);



            // Check for query alteration starts here
            DB::beginTransaction();

            //Passport Auth Token
            $authToken = $user->createToken('accessToken')->accessToken;


            // Check for query alteration ends here
            DB::commit();

            //set response array
            $user->accessToken = $authToken;

            $response = [
                config('api.CODE')    => config('HttpCodes.success'),
                config('api.MESSAGE') => config('Messages.successLogin'),
                config('api.RESULT')  => $user
            ];

            //send response
            ParcelHelper::sendResponse($response, config('HttpCodes.success'));
        } catch (Exception $e) {
            //Rollback query alteration if exception
            DB::rollback();

            //show exception response
            ParcelHelper::showException($e, $e->getCode());
        }
    }


   
    /**
     * @param Request $request
     */
    public function logout(Request $request)
    {
        try {
            $userId = null;
            if (Auth::check()) {
                $tokenId = auth()->user()->token()->id;
                $userId  = Auth::user()->id;
                if (!empty($userId)) {
                    Session::where('user_id',$userId)->update(array('device_token'=>''));
                }
                OauthAccessToken::find($tokenId)->delete();
            }   
            /**
             * Deleting user details from session on logout
             */
            //auth()->user()->token()->revoke();
            $response = [
                config('api.CODE')    => Config('HttpCodes.success'),
                config('api.MESSAGE') => config('Messages.successLogout')
            ];

            //send response
            ParcelHelper::sendResponse($response, Config('HttpCodes.success'));
        } catch (Exception $e) {
            ParcelHelper::showException($e, $e->getCode());
        }
    }

    private static function loginValidationRules(): array
    {
        return [
            'email'        => 'required',
            'password'     => 'required|string|min:5',
        ];
    }


}
