<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Laravel\Passport\HasApiTokens;


class User extends Eloquent implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
	use Authenticatable, Authorizable, CanResetPassword, Notifiable, HasApiTokens;
	
    // public function post()
        // {
            // return $this->hasOne('App\Post');
        // }
		
	public function role()
	{
		return $this->belongsTo('App\Role');
	}

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	
    protected $collection = 'users';
    protected $fillable = [
        'name', 'first_name', 'last_name', 'parent_first_name', 'parent_last_name', 'email', 'password', 'role_id', 'phone_no', 'image', 'status','country','driver_name','short_id','address',
		'address_2','company_name','city','postal_code','state','language','date_of_birth','train_direction',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
