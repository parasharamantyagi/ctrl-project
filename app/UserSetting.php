<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class UserSetting extends Eloquent
{
    protected $collection = 'user_settings';
	protected $fillable = [
        'user_id','vehicle_id','setting_id','background_color','pad_background_color','daylight_auto_on','motor_off','front_motor','onboard_sound',
        'acceleration_curve','motor_trim_kit','lower_gear_shift_value','gear_retio','led_configuration','pad_line_color','gear_shift_b_value',
		'motion_sensor_level_1','motion_sensor_level_2','motion_sensor_theft','out_of_range','brake_lights_1','brake_lights_2','gear_shift_a_value',
		'front_motor_resistor_value','front_motor_off_ms','rear_motor_resistor_value','rear_motor_off_ms','gear_shift_a_rpm_value','hall_sensor_frequency',
        'button_style','reverse_speed_motor','steering_control_point','firmware','rear_motor','motor_steps_for_max_steering','electric_motor_re_built',
        'upper_gear_shift_value','cell_value_steer_pad','max_steering_angle','button_config_for_each_menu','max_rpm','screen_rotation_landscape',
        'from_id','setting_status','asset_folder','setting_art_no','setting_use_status','bar_code_id','pad_design_2_directional','reverse_steer_motor','idle_rpm'
	];
}


