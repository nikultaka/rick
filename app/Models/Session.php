<?php

namespace App\Models;

use Eloquent;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * Class Session
 *
 * @property int $id
 * @property int $user_id
 * @property string $device_id
 * @property string $device_token
 * @property string $device_arn
 * @property string $device_model
 * @property string $platform
 * @property \Carbon\Carbon $login_time
 * @property \Carbon\Carbon $logout_time
 * @property bool $login_status
 *
 * @package App\Models
 */
class Session extends Eloquent
{
    public    $timestamps = false;
    protected $dates      = [
        'login_time',
        'logout_time'
    ];
    /*protected $hidden     = [
        'device_token'
    ];*/
    protected $fillable   = [
        'user_id',
        'device_id',
        'device_token',
        'device_arn',
        'device_model',
        'platform',
        'login_time',
        'logout_time',
        'login_status'
    ];

    /**
     * @param $userId
     * @param string $type
     * @return mixed
     */
    public static function getSessionId($userId, $type = 'user')
    {
        if ($type == 'user') {
            return Session::select('id')->whereUserId($userId)->whereType($type)->value('id');
        } else {
            return Session::select('id')->whereTenantContactId($userId)->whereType($type)->value('id');
        }
    }

    /**
     * @param $requestDataArray
     * @param $userId
     * @param string $deviceArn
     * @return int
     */
    public static function saveData($requestDataArray, $userId, $deviceArn = '')
    {

        $session            = new Session;
        $session->device_id = $requestDataArray['device_id'];
        if (isset($requestDataArray['type']) && $requestDataArray['type'] == 'tenant_contact') {
            $session->tenant_contact_id = $userId;
        } else {
            $session->user_id = $userId;
        }
        if (!empty($requestDataArray['device_token'])) {
            $session->device_token = $requestDataArray['device_token'];
        }
        $session->platform     = $requestDataArray['platform'];
        $session->device_arn   = $deviceArn;
        $session->login_time   = Carbon::now();
        $session->login_status = 1;
        $session->type         = isset($requestDataArray['type']) ? $requestDataArray['type'] : 'user';
        $session->save();
        return $session->id;
    }

    /**
     * @param $requestDataArray
     * @param $sessionId
     * @param $userId
     * @param string $deviceArn
     * @return mixed
     */
    public static function updateData($requestDataArray, $sessionId, $userId, $deviceArn = "")
    {

        $session            = Session::find($sessionId);
        $session->device_id = $requestDataArray['device_id'];
        if (isset($requestDataArray['type']) && $requestDataArray['type'] == 'tenant_contact') {
            $session->tenant_contact_id = $userId;
        } else {
            $session->user_id = $userId;
        }
        $session->device_arn = $deviceArn;
        if (isset($requestDataArray['device_token'])) {
            $session->device_token = $requestDataArray['device_token'];
        }
        $session->platform     = $requestDataArray['platform'];
        $session->login_time   = Carbon::now();
        $session->login_status = 1;
        return $session->save();
    }

    /**
     * Used to remove users' session data
     *
     * @param Request $request
     * @return Boolean
     */
    public static function removeSession()
    {
        $where      = ['user_id' => Auth::user()->id];
        $updateData = [
            'device_arn'   => '',
            'login_status' => 0,
            'logout_time'  => Carbon::now()
        ];

        return Session::where($where)->update($updateData);
    }


    /**
     * To add new entry in session table
     *
     * @param [type] $request
     * @param string $arn
     * @return integer
     */
    public static function addNewSession($request, string $arn = ''): int
    {
        $session               = new Session;
        $session->device_id    = $request->device_id;
        $session->user_id      = Auth::user()->id;
        $session->device_token = $request->device_token;
        $session->platform     = 1;
        $session->device_arn   = $arn;
        $session->login_time   = Carbon::now();
        $session->login_status = 1;
        $session->save();
        return $session->id;
    }
}
