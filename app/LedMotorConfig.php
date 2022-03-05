<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class LedMotorConfig extends Eloquent
{
    protected $collection = 'led_motor_configs';
	protected $fillable = [
        'user_id', 'cordinate'
    ];
	
	
}
