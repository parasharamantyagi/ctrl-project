<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Vehicle extends Eloquent
{
    protected $collection = 'vehicles';
	
	protected $fillable = [
        'brand','model','model_spec','release_year','moter_type','horse_power',
        'torque','km_h_0_100','km_h_0_160','km_h_100_0','weight','max_weight',
        'manufacturer','scale','vehicle_type','special_car_specialization','lenght','length_front_of_car',
        'wheelbase','track_width','width','wheel_diameter','height'
	];
}
