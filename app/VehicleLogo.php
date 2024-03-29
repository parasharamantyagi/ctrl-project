<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class VehicleLogo extends Eloquent
{
    protected $collection = 'vehicle_logos';
	protected $fillable = [
        'vehicle_id', 'user_setting_id', 'brand', 'pad2_image', 'logo_image', 'icone_image', 'pad3_image', 'pad4_image', 'larger_logo',
		'start_engine_sound','idle_motor_sound','acceleration_sound','deceleration_sound', 'p_larger_logo',
		'gear_shift_sound_1','gear_shift_sound_2','shut_off_sound','blinkers_sound','horn_sound','full_screen_movie_links','car_button','train_button',
		'p_pad2_image','p_logo_image','p_icone_image','p_pad3_image','p_pad4_image','p_start_engine_sound','p_idle_motor_sound','p_acceleration_sound',
		'p_deceleration_sound','p_gear_shift_sound_1','p_gear_shift_sound_2','p_shut_off_sound','p_blinkers_sound','p_horn_sound'
    ];
	
	public function vehicle()
	{
		return $this->belongsTo('App\Vehicle');
	}
}
