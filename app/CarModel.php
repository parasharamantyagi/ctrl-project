<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class CarModel extends Eloquent
{
	protected $collection = 'car_models';
	protected $fillable = [
        'model_name', 'art_no', 'vehicle_id',
    ];
}
