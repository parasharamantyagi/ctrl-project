<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class VehicleLedSequenceConfig extends Eloquent
{
	protected $collection = 'vehicle_led_sequence_config';
	protected $fillable = [
        'vehicle_id', 'excel_leds',
    ];
}
