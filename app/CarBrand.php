<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class CarBrand extends Eloquent
{
	protected $collection = 'car_brands';
	protected $fillable = [
        'brand_name', 'art_no',
    ];
}
