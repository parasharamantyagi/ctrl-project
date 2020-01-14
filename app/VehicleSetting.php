<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class VehicleSetting extends Eloquent
{
   protected $collection = 'vehicle_settings';
   
		public function vehicle()
        {
            return $this->belongsTo('App\Vehicle');
        }
		
		public function getvehicle()
        {
            return $this->hasOne('App\Vehicle', '_id', 'vehicle_id');
        }
		
		
		
		
		
}
