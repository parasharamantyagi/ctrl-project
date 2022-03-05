<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class UserCoordinate extends Eloquent
{
	protected $collection = 'user_coordinates';
	protected $fillable = [
        'user_id', 'vehicle_id', 'coordinate',
    ];
}
