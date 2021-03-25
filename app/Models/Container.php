<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\ContainerType;
use App\Models\User;

class Container extends Authenticatable
{
	protected $table = 'containers';

	public function containerTypeData()
    {
        return $this->hasOne(ContainerType::class,'id','container_type');
    }

    public function usersData()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
		
}
