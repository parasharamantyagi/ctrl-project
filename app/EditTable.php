<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class EditTable extends Eloquent
{
	protected $collection = 'edittables';
	protected $fillable = [
        'vehicle_id', 'user_id', 'users',
    ];
}
