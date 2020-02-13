<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class CreateNewCar extends Eloquent
{
	protected $collection = 'create_new_cars';
	protected $fillable = [
        'user_id', 'data_leds',
    ];
}
