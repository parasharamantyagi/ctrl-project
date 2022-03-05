<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VehicleSetting extends JsonResource
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
					'user_id' => $this->user_id,
					'setting_id' => $this->setting_id,
					'vehicle_id' => $this->vehicle_id,
					'background_color' => !empty($this->background_color) ? $this->background_color : '',
					'pad_line_color' => !empty($this->pad_line_color) ? $this->pad_line_color : '',
					'pad_background_color' => !empty($this->pad_background_color) ? $this->pad_background_color : '',
					'reverse_speed_motor' => !empty($this->reverse_speed_motor) ? $this->reverse_speed_motor : '',
					'reverse_steer_motor' => !empty($this->reverse_steer_motor) ? $this->reverse_steer_motor : '',
					'motor_off' => !empty($this->motor_off) ? $this->motor_off : '',
					'front_motor_off_ms' => (int)$this->front_motor_off_ms,
					'rear_motor_resistor_value' => (int)$this->rear_motor_resistor_value,
					'front_motor_resistor_value' => (int)$this->front_motor_resistor_value,
					'rear_motor_off_ms' => (int)$this->rear_motor_off_ms,
					'acceleration_curve' => !empty($this->acceleration_curve) ? $this->acceleration_curve : '',
					'motor_trim_kit' => (int)$this->motor_trim_kit,
					'upper_gear_shift_value' => (int)$this->upper_gear_shift_value,
					'steer_angle_limit_per_100_ms' => !empty($this->steer_angle_limit_per_100_ms) ? floatval($this->steer_angle_limit_per_100_ms) : 7.5,
					'shift_value_race' => (int)$this->shift_value_race,
					'lower_gear_shift_value' => (int)$this->lower_gear_shift_value,
					'gear_shift_a_value' => (int)$this->gear_shift_a_value,
					'gear_shift_b_value' => (int)$this->gear_shift_b_value,
					'gear_shift_a_rpm_value' => (int)$this->gear_shift_a_rpm_value,
					'gear_retio' => !empty($this->gear_retio) ? $this->gear_retio : '',
					'max_steering_angle' => !empty($this->max_steering_angle) ? floatval($this->max_steering_angle) : 0,
					'motor_steps_for_max_steering' => !empty($this->motor_steps_for_max_steering) ? $this->motor_steps_for_max_steering : '',
					'hall_sensor_frequency' => !empty($this->hall_sensor_frequency) ? $this->hall_sensor_frequency : '',
					'daylight_auto_on' => !empty($this->daylight_auto_on) ? $this->daylight_auto_on : '',
					'brake_lights_1' => !empty($this->brake_lights_1) ? $this->brake_lights_1 : '',
					'brake_lights_2' => !empty($this->brake_lights_2) ? $this->brake_lights_2 : '',
					'motion_sensor_level_1' => !empty($this->motion_sensor_level_1) ? $this->motion_sensor_level_1 : '',
					'motion_sensor_level_2' => !empty($this->motion_sensor_level_2) ? $this->motion_sensor_level_2 : '',
					'motion_sensor_theft' => !empty($this->motion_sensor_theft) ? $this->motion_sensor_theft : '',
					'out_of_range' => !empty($this->out_of_range) ? $this->out_of_range : '',
					'onboard_sound' => !empty($this->onboard_sound) ? $this->onboard_sound : '',
					'sound_level_factor' => !empty($this->sound_level_factor) ? $this->sound_level_factor : '1.0',
					'screen_rotation_landscape' => !empty($this->screen_rotation_landscape) ? $this->screen_rotation_landscape : '',
					'pad_design_2_directional' => !empty($this->pad_design_2_directional) ? $this->pad_design_2_directional : '',
					'motor_configuration' => !empty($this->motor_configuration) ? $this->motor_configuration : '',
					'electric_motor_re_built' => !empty($this->electric_motor_re_built) ? $this->electric_motor_re_built : '',
					'from_id' => !empty($this->from_id) ? $this->from_id : '',
					'setting_status' => !empty($this->setting_status) ? $this->setting_status : '',
					'asset_folder' => !empty($this->asset_folder) ? $this->asset_folder : '',
					'setting_art_no' => !empty($this->setting_art_no) ? $this->setting_art_no : '',
					'setting_use_status' => !empty($this->setting_use_status) ? $this->setting_use_status : '',
					'speed_motor_ma_limitation' => !empty($this->speed_motor_ma_limitation) ? $this->speed_motor_ma_limitation : '',
					'steer_motor_ma_limitation' => !empty($this->steer_motor_ma_limitation) ? $this->steer_motor_ma_limitation : '',
					'micro_steps' => !empty($this->micro_steps) ? $this->micro_steps : 0,
					'train_view' => !empty($this->train_view) ? $this->train_view : '',
					'zoom_factor_speed' => !empty($this->zoom_factor_speed) ? $this->zoom_factor_speed : '',
					'zoom_factor_steer' => !empty($this->zoom_factor_steer) ? $this->zoom_factor_steer : '',
					'car_short_id' => ($this->car_short_id) ? $this->car_short_id : '',
					'carId' => rand(111111,999999),
					'updated_at' => $this->updated_at,
					'created_at' => $this->created_at,
					'coordinate' => ($this->coordinate) ? $this->coordinate : (object)array()
				);
				
        return $userData;
		// return parent::toArray($userData);
    }
}
