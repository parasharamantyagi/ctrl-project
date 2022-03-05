<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Vehicle extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {	
		$resultData = array(
						'_id' => $this->_id,
						'brand' => ($this->brand && !empty($this->brand)) ? $this->brand : '',
						'model' => ($this->model && !empty($this->model)) ? $this->model : '',
						'model_spec' => ($this->model_spec && !empty($this->model_spec)) ? $this->model_spec : '',
						'release_year' => ($this->release_year && !empty($this->release_year)) ? (int)$this->release_year : 0,
						'art_no' => ($this->art_no && !empty($this->art_no)) ? $this->art_no : '',
						'moter_type' => ($this->moter_type && !empty($this->moter_type)) ? $this->moter_type : '',
						'horse_power' => ($this->horse_power && !empty($this->horse_power)) ? (int)$this->horse_power : 0,
						'torque' => ($this->torque && !empty($this->torque)) ? (int)$this->torque : 0,
						'km_h_0_100' => ($this->km_h_0_100 && !empty($this->km_h_0_100)) ? floatval($this->km_h_0_100) : 0,
						'km_h_0_160' => ($this->km_h_0_160 && !empty($this->km_h_0_160)) ? floatval($this->km_h_0_160) : 0,
						'deceleration_speed' => ($this->deceleration_speed && !empty($this->deceleration_speed)) ? (int)$this->deceleration_speed : 0,
						'distance' => ($this->distance && !empty($this->distance)) ? (int)$this->distance : 0,
						'weight' => ($this->weight && !empty($this->weight)) ? (int)$this->weight : 0,
						'max_weight' => ($this->max_weight && !empty($this->max_weight)) ? (int)$this->max_weight : 0,
						'scale' => ($this->scale && !empty($this->scale)) ? $this->scale : '',
						'lenght' => ($this->lenght && !empty($this->lenght)) ? (int)$this->lenght : 0,
						'length_front_of_car' => ($this->length_front_of_car && !empty($this->length_front_of_car)) ? (int)$this->length_front_of_car : 0,
						'wheelbase' => ($this->wheelbase && !empty($this->wheelbase)) ? (int)$this->wheelbase : 0,
						'track_width' => ($this->track_width && !empty($this->track_width)) ? (int)$this->track_width : 0,
						'width' => ($this->width && !empty($this->width)) ? (int)$this->width : 0,	
						'wheel_diameter' => ($this->wheel_diameter && !empty($this->wheel_diameter)) ? floatval($this->wheel_diameter) : 0,
						'height' => ($this->height && !empty($this->height)) ? (int)$this->height : 0,
						'from_id' => ($this->from_id && !empty($this->from_id)) ? $this->from_id : '',
						'updated_at' => ($this->updated_at && !empty($this->updated_at)) ? $this->updated_at : '',
						'manufacturer' => ($this->manufacturer && !empty($this->manufacturer)) ? $this->manufacturer : '',
						'special_car_specialization' => ($this->special_car_specialization && !empty($this->special_car_specialization)) ? $this->special_car_specialization : '',
						'car_value' => ($this->car_value && !empty($this->car_value)) ? $this->car_value : 0,
						'vehicle_type' => ($this->vehicle_type && !empty($this->vehicle_type)) ? $this->vehicle_type : '',
						'idle_rpm' => ($this->idle_rpm && !empty($this->idle_rpm)) ? (int)$this->idle_rpm : 0,
						'max_rpm' => ($this->max_rpm && !empty($this->max_rpm)) ? (int)$this->max_rpm : 0,
						'gearbox_amount_of_gears' => ($this->gearbox_amount_of_gears && !empty($this->gearbox_amount_of_gears)) ? (int)$this->gearbox_amount_of_gears : 0,
						'max_speed_per_gears' => ($this->max_speed_per_gears && !empty($this->max_speed_per_gears)) ? $this->max_speed_per_gears : '',
						'transmission_ratios' => ($this->transmission_ratios && !empty($this->transmission_ratios)) ? $this->transmission_ratios : '',
						'reverse_gear_ratio' => ($this->reverse_gear_ratio && !empty($this->reverse_gear_ratio)) ? $this->reverse_gear_ratio : '',
						'top_speed' => ($this->top_speed && !empty($this->top_speed)) ? $this->top_speed : '',
						'car_quote' => ($this->car_quote && !empty($this->car_quote)) ? $this->car_quote : '',
						'license_plate' => ($this->license_plate && !empty($this->license_plate)) ? $this->license_plate : '',
						'config_url' => 'get-config/'.$this->_id,
		);
		return $resultData;
        // return parent::toArray($request);
    }
}
