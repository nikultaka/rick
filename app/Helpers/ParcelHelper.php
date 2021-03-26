<?php

namespace App\Helpers;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


/**
 * Description of ParcelHelper
 *
 * @author Appinventiv Technologies
 */
class ParcelHelper
{

    /**
     *
     * @param type $exception
     * @return type
     */
    public static function showException($exception)
    {
        $code = $exception->getCode() ? $exception->getCode() : 500;
        //setting message
        // $message = self::isProduction() ? Config('ErrorCode.' . $code) : $exception->getMessage();
        $message = $exception->getMessage();

        $exceptionErrorResponse = [
            "CODE"    => $code,
            "MESSAGE" => $message,
            "RESULT"  => [],
            // "LINE" => $exception->getLine(),
            // "FILE" => $exception->getFile()
        ];

        $responseCode = (is_numeric($code) && $code > 0) ? $code : config('HttpCodes.fail');

        (new Response($exceptionErrorResponse, $responseCode))->header('Content-Type', 'application/json')->send();
        exit;
    }


    /**
     *
     * @param array $post
     * @param array $rules
     */
    public static function validateRequest(array $post, array $rules)
    {
        $validator = Validator::make($post, $rules, self::validationMessage());
        //Check input parameter validation
        if ($validator->fails()) {
            self::showValidationError($validator);
        }
    }


    /**
     *
     * @param type $validator
     */
    public static function showValidationError($validator)
    {
        //setting message
        // $message = self::isProduction() ? Config('ErrorCodes.' . config('HttpCodes.required')) : $validator->messages()->first();
        $message = $validator->messages()->first();

        $validationErrorResponse = [
            "CODE"    => config('HttpCodes.required'),
            "MESSAGE" => $message,
            "RESULT"  => []
        ];

        (new Response($validationErrorResponse, config('HttpCodes.success')))->header('Content-Type', 'application/json')->send(); //config('HttpCodes.required')
        exit;
    }

    /**
     * @param string $msg
     * @param int $code
     * @param array $data
     */
    public static function noDataFound($msg = 'Sorry! No data found', $code = 450, $data = [])
    {

        $response = [
            config('api.CODE')    => $code,
            config('api.MESSAGE') => $msg,
            config('api.RESULT')  => []
        ];

        (new Response($response, $code))->header('Content-Type', 'application/json')->send();
        exit;
    }

    /**
     *
     * @param type $validator
     */
    public static function badRequest($msg = 'Sorry! You are not authorize to perform this action', $code = 400, $data = [])
    {

        $response = [
            config('api.CODE')    => $code,
            config('api.MESSAGE') => $msg,
            config('api.RESULT')  => []
        ];

        (new Response($response, config('HttpCodes.required')))->header('Content-Type', 'application/json')->send();
        exit;
    }

    /**
     *
     * @param type $validator
     */
    public static function serverError($msg = 'Something went wrong. Please try again', $code = 500, $data = [])
    {

        $response = [
            config('api.CODE')    => $code,
            config('api.MESSAGE') => $msg,
            config('api.RESULT')  => []
        ];

        (new Response($response, config('HttpCodes.required')))->header('Content-Type', 'application/json')->send();
        exit;
    }

    /**
     *
     * @param type $validator
     */
    public static function sendNewResponse(array $response, $code = 200)
    {
        (new Response($response, $code))->header('Content-Type', 'application/json')->send();
        exit;
    }


    /**
     *
     * @param type $response
     * @return type
     */
    public static function sendResponse(array $response, $code = 200)
    {
        try {

            $log = [
                'RESPONSE' => $response,
            ];
            Log::info(json_encode($log));
            return (new Response($response, $code))->send();
            exit;
        } catch (Exception $ex) {
            showException($ex);
        }
    }


    /**
     * to check Environment is Production or development or staging
     *
     * @return boolean
     */
    public static function isProduction()
    {
        $flag = true;
        // The environment is either local OR staging...
        if (app()->environment('local', 'staging')) {
            $flag = false;
        }
        return $flag;
    }


    /**
     * Used to set default values to needed array index
     * pass to array First for values and Second for default values with same indexes
     * If in value array index has value then Ok
     * Otherwise second array index value will set
     *
     *
     * @function defaultValue
     * @description To set default value to the arrays required fields
     *
     * @param array $value array to check values
     * @param array $default Array having default values
     */
    public static function defaultValue($value = array(), $default = array())
    {
        $response = array();
        foreach ($default as $key => $values) {
            $response[$key] = (isset($value[$key]) && !empty($value[$key])) ? $value[$key] : $default[$key];
        }
        return ($response);
    }


    /*
     * method to return all required values used for pagination
     *
     */

    public static function paginatorSubsets($limit = '', $page = '')
    {
        $page = !empty($page) ? $page : 1;
        return [
            !empty($limit) ? $limit : PAGE_LIMIT,
            $page,
            ($page - 1) * $limit
        ];
    }


    /**
     * Used to set Validation messages
     *
     * @return Array
     */
    public static function validationMessage()
    {
        return [
            'required'                        => __('lang.required'),
            'required_with'                   => __('lang.required'),
            'numeric'                         => __('lang.numeric'),
            'unique'                          => __('lang.unique'),
            'integer'                         => __('lang.integer'),
            'date'                            => __('lang.date'),
            'courier_id.required_if'          => 'The courier id field is required when package type is incoming',
            'package_status.unique'           => 'This action is already performed',
            'signing_person_name.required_if' => 'Please provide signature person name',
            'signature_image_url.required_if' => 'Please provide signature image',
            'courier_id_number.required_if'   => 'Courier Id Number is required, when adding courier',
            'floor_rep_id.exists'             => trans('Messages.noFloorReps'),
            'email.exists'                    => "Sorry, but we couldn't locate a user with the email address entered.  Please Try Again",
        ];
    }


    /**
     * Get User IP Address
     *
     * @return type
     */
    public static function getIp()
    {
        foreach (array(
                     'HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED',
                     'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR'
                 ) as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
    }


    /**
     * @function encryptDecrypt
     * @description A common function to encrypt or decrypt desired string
     *
     * @param string $string String to Encrypt
     * @param string $type option encrypt or decrypt the string
     * @return type
     */
    public static function encryptDecrypt($string, $type = 'encrypt')
    {

        if ($type == 'decrypt') {
            #$enc_string = decrypt_with_openssl($string);
            $enc_string = self::base64decryption($string);
        }
        if ($type == 'encrypt') {
            #$enc_string = encrypt_with_openssl($string);
            $enc_string = self::base64encryption($string);
        }
        return $enc_string;
    }


    /**
     * @funciton base64encryption
     * @description will Encrypt data in base64
     *
     * @param type $string
     */
    private static function base64encryption($string)
    {
        return base64_encode($string);
    }


    /**
     * @funciton base64decryption
     * @description will decrypt data in base64
     *
     * @param type $string
     */
    private static function base64decryption($string)
    {
        return base64_decode($string);
    }


    public static function accessDenied($msg)
    {
        $message = '' != $msg ? $msg : 'Access Denied';
        abort(ACCESS_DENIED, $message);
    }


    /**
     * phone formatting
     *
     * @param type $phone_number
     * @return type
     */
    public function formatTelephone($phoneNumber = '')
    {
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        if (strlen($phoneNumber) > 6) {
            //$countryCode = substr($phoneNumber, 0, strlen($phoneNumber)-10);
            $areaCode    = substr($phoneNumber, 0, 3);
            $nextThree   = substr($phoneNumber, 3, 3);
            $lastFour    = substr($phoneNumber, 6);
            $phoneNumber = $areaCode . '-' . $nextThree . '-' . $lastFour;
        } else if (strlen($phoneNumber) > 3) {
            $areaCode    = substr($phoneNumber, 0, 3);
            $nextThree   = substr($phoneNumber, 3);
            $phoneNumber = $areaCode . '-' . $nextThree;
        }
        return $phoneNumber;
    }


    public function localeTime($utcDatetime, $format)
    {
        $gmt = session()->get('tz');
        //$utcDatetime = Carbon::createFromTimestampUTC($utcDatetime);
        return $utcDatetime->setTimezone($gmt)->format($format);
    }

    public function returnAgeByDob($dob)
    {
        $dobArr = explode('-', $dob);
        return Carbon::create($dobArr[0], $dobArr[1], $dobArr[2])->diff(Carbon::now())->format('%y years, %m months and %d days');
    }

    /**
     * To check if variable is set and not empty & replace with replacer
     *
     * @param [type] $param
     * @param string $replace
     * @return void
     */
    public static function ifEmpty($param, $replace = '')
    {
        if (!isset($param) || empty($param)) {
            $param = $replace;
        }

        return $param;
    }

    /**
     * To check key is exist & replace with replacer
     *
     * @param [type] $key
     * @param [type] $array
     * @param boolean $replace
     * @return boolean
     */
    public static function isKeyExists($key, array $array, $replace = false)
    {
        return array_key_exists($key, $array) ? $array[$key] : ($replace ? $replace : '');
    }

    /**
     * TO throw exception
     *
     * @param boolean $msg
     * @param integer $code
     * @return void
     */
    public static function throwException($msg = false, $code = 500)
    {
        $exceptionMsg = trans('Messages.tryAgain');
        if ($msg) {
            $exceptionMsg = $msg;
        }
        throw new \Exception($exceptionMsg, $code);
    }

    /**
     * TO check logged in user is site manager or not
     *
     * @return void
     */
    public static function siteManagerCheck()
    {
        if (Auth::user()->user_type == config('userTypes.floor_representative')) {
            self::badRequest(trans('Messages.StCheck'));
        }
    }

    /**
     * TO check logged in user is floor manager or not
     *
     * @return void
     */
    public static function floorManagerCheck()
    {
        if (Auth::user()->user_type != config('userTypes.floor_representative')) {
            self::badRequest(trans('Messages.frCheck'));
        }
    }


    /**
     * Parse adat
     *
     * @param [type] $data
     * @return void
     */
    public static function parseData($data)
    {
        $jsonData         = json_decode($data->toJson()); /// convert object to string then decode it to json
        $response['data'] = $jsonData->data;

        if (!is_null($jsonData->next_page_url)) {
            $arr                   = explode('page=', $jsonData->next_page_url);
            $response['next_page'] = $arr[1];   // set next page instead of full next page url
        } else {
            $response['next_page'] = -1;
        }
        return $response;
    }


    /**
     * To send user password
     *
     * @param integer $user_id
     * @param string $password
     * @return void
     */
    public static function sendPasswordMaili(int $user_id, string $password)
    {
        $user = App\Models\User::find($user_id);
        $data = [
            'email'    => $user->email,
            'name'     => $user->name,
            'password' => $password
        ];
        Mail::to($data['email'])->queue(new SendPasswordMail($data));
    }
}
