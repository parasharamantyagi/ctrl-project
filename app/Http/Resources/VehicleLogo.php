<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VehicleLogo extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
		$userData = array(
					'_id' => $this->_id,
					'pad2_image' => ($this->pad2_image && !empty($this->pad2_image)) ? $this->pad2_image : '',
					'logo_image' => ($this->logo_image && !empty($this->logo_image)) ? $this->logo_image : '',
					'icone_image' => ($this->icone_image && !empty($this->icone_image)) ? $this->icone_image : '',
					'pad3_image' => ($this->pad3_image && !empty($this->pad3_image)) ? $this->pad3_image : '',
					'full_screen_movie_links' => ($this->full_screen_movie_links && !empty($this->full_screen_movie_links)) ? $this->full_screen_movie_links : '',
					'start_engine_sound' => ($this->start_engine_sound && !empty($this->start_engine_sound)) ? $this->start_engine_sound : '',
					'idle_motor_sound' => ($this->idle_motor_sound && !empty($this->idle_motor_sound)) ? $this->idle_motor_sound : '',
					'acceleration_sound' => ($this->acceleration_sound && !empty($this->acceleration_sound)) ? $this->acceleration_sound : '',
					'deceleration_sound' => ($this->deceleration_sound && !empty($this->deceleration_sound)) ? $this->deceleration_sound : '',
					'gear_shift_sound_1' => ($this->gear_shift_sound_1 && !empty($this->gear_shift_sound_1)) ? $this->gear_shift_sound_1 : '',
					'gear_shift_sound_2' => ($this->gear_shift_sound_2 && !empty($this->gear_shift_sound_2)) ? $this->gear_shift_sound_2 : '',
					'shut_off_sound' => ($this->shut_off_sound && !empty($this->shut_off_sound)) ? $this->shut_off_sound : '',
					'blinkers_sound' => ($this->blinkers_sound && !empty($this->blinkers_sound)) ? $this->blinkers_sound : '',
					'horn_sound' => ($this->horn_sound && !empty($this->horn_sound)) ? $this->horn_sound : '',
					'car_button' => ($this->car_button && !empty($this->car_button)) ? $this->car_button : '',
					'train_button' => ($this->train_button && !empty($this->train_button)) ? $this->train_button : '',
				);
				
        return $userData;
    }
}
