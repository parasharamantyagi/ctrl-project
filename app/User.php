<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Laravel\Passport\HasApiTokens;

class User extends Eloquent implements Authenticatable
{
    use Notifiable;
    use AuthenticableTrait;
	use HasApiTokens;


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
        'name', 'email', 'password', 'role_id', 'phone_no', 'image', 'status',
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
