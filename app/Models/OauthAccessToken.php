<?php

namespace App\Models;

use Eloquent;

/**
 * Class OauthAccessToken
 *
 * @property string $id
 * @property int $user_id
 * @property int $client_id
 * @property string $name
 * @property string $scopes
 * @property bool $revoked
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $expires_at
 *
 * @package App\Models
 */
class OauthAccessToken extends Eloquent
{
    public    $incrementing = false;
    protected $dates        = [
        'expires_at'
    ];
    protected $fillable     = [
        'user_id',
        'client_id',
        'name',
        'scopes',
        'revoked',
        'expires_at'
    ];

    public static function getUserTokens($user_id)
    {
        return self::select('oauth_access_tokens.*')->orderBy('created_at', 'desc')
            ->where('oauth_access_tokens.user_id', '=', $user_id)
            ->get();
    }
    public static function removeToken($id)
    {
        OauthAccessToken::find($id)->delete();
    }

    public static function deleteTokenFromOtherDevice($userId)
    {
        return self::select('oauth_access_tokens.id')
            ->where('oauth_access_tokens.user_id', '=', $userId)
            ->delete();


    }
}
