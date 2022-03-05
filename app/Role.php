<?php

namespace App;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Role extends Eloquent
{
    protected $collection = 'roles';

	protected $fillable = [
        'roll_id','roll',
	];
	
       public function user()
        {
            return $this->hasOne('App\User');
        }
}
