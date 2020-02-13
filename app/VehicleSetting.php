<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class VehicleSetting extends Eloquent
{
	protected $collection = 'vehicle_settings';
	
	protected $fillable = [
        'vehicle_id','background_color','pad_background_color','daylight_auto_on','motor_off','front_motor','gearbox_amount_of_gears',
        'speed_curve','idle_rpm','lower_gear_shift_value','gear_retio','led_configuration','pad_line_color',
        'button_style','reverse_speed_motor','steering_control_point','firmware','rear_motor','max_speed_per_gears',
        'max_rpm','upper_gear_shift_value','cell_value_steer_pad','max_steering_angle','button_config_for_each_menu',
        'from_id','setting_status','asset_folder','setting_art_no','setting_use_status'
	];
   
		public function vehicle()
        {
            return $this->belongsTo('App\Vehicle');
        }
		
		public function getvehicle()
        {
            return $this->hasOne('App\Vehicle', '_id', 'vehicle_id');
        }
		
		
		
		
		
}
