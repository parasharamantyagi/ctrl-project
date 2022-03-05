<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class VehicleLedMotorExcelSheet extends Eloquent
{
	protected $collection = 'vehicle_led_motor_excel_sheets';
	protected $fillable = [
        'vehicle_id', 'excel_leds',
    ];
}
