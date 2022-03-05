<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class LedMotorExcelSheet extends Eloquent
{
	protected $collection = 'led_motor_excel_sheets';
	protected $fillable = [
        'user_id', 'excel_leds',
    ];
}
