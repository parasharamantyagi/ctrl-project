<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class VehicleLogo extends Eloquent
{
    protected $collection = 'vehicle_logos';
	protected $fillable = [
        'vehicle_id', 'brand', 'pad2_image', 'logo_image', 'icone_image', 'pad3_image',
		'start_engine_sound','idle_motor_sound','acceleration_sound','deceleration_sound',
		'gear_shift_sound_1','gear_shift_sound_2','shut_off_sound','blinkers_sound','full_screen_movie_links'
    ];
	
	public function vehicle()
	{
		return $this->belongsTo('App\Vehicle');
	}
}
