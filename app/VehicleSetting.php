<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class VehicleSetting extends Eloquent
{
	protected $collection = 'vehicle_settings';
	
	protected $fillable = [
        'user_id','vehicle_id','background_color','pad_background_color','daylight_auto_on','motor_off','front_motor','gearbox_amount_of_gears',
        'acceleration_curve','motor_trim_kit','idle_rpm','lower_gear_shift_value','gear_retio','led_configuration','pad_line_color','reverse_steer_motor',
		'motion_sensor_level_1','motion_sensor_level_2','motion_sensor_theft','out_of_range','brake_lights_1','brake_lights_2','pad_design_2_directional',
		'front_motor_resistor_value','front_motor_off_ms','rear_motor_resistor_value','rear_motor_off_ms','onboard_sound','screen_rotation_landscape',
		'zoom_factor_speed','zoom_factor_steer','train_view','motor_configuration',
        'button_style','reverse_speed_motor','steering_control_point','firmware','rear_motor','max_speed_per_gears','hall_sensor_frequency','electric_motor_re_built',
        'max_rpm','upper_gear_shift_value','cell_value_steer_pad','max_steering_angle','button_config_for_each_menu','motor_steps_for_max_steering',
        'from_id','setting_status','asset_folder','setting_art_no','setting_use_status','bar_code_id','gear_shift_a_value','gear_shift_b_value','gear_shift_a_rpm_value'
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
