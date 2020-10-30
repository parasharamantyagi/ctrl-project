<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Vehicle extends Eloquent
{
    protected $collection = 'vehicles';
	
	protected $fillable = [
        'brand','model','user_id','model_spec','car_quote','release_year','art_no','license_plate','moter_type','horse_power','gearbox_amount_of_gears','max_speed_per_gears',
        'torque','km_h_0_100','km_h_0_160','km_h_100_0','deceleration_speed','distance','weight','max_weight','max_rpm','idle_rpm',
        'manufacturer','scale','vehicle_type','special_car_specialization','lenght','length_front_of_car',
        'wheelbase','track_width','width','wheel_diameter','height','transmission_ratios','reverse_gear_ratio','top_speed'
	];
	
	public function vehicle_setting()
        {
            return $this->hasOne('App\VehicleSetting');
        }
		
	public function vehicle_logo()
        {
            return $this->hasOne('App\VehicleLogo');
        }
}
