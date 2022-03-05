<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class LedExternalBoardid extends Eloquent
{
	protected $collection = 'led_external_board_ids';
	protected $fillable = [
        'user_id', 'vehicle_id', 'data_leds', 'excel_leds',
    ];
}
