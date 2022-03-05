<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class VehicleMap extends Eloquent
{
	protected $collection = 'vehicle_maps';
	protected $fillable = [
        'vehicle_id', 'file_name', 'map_image', 'upload_data',
    ];
}
