@extends('layouts.appuser')

@section('content')
	<style>
	.form-control { width: 25% !important;}
	.form-group.none {display: none;}
	</style>
	<div class="page-content-wrap">
                    <!-- START ALERT BLOCKS -->

<!-- END ALERT BLOCKS -->                    	
		<form method="POST" action="{{ url($formaction) }}" id="Updateuser" enctype="multipart/form-data">
			{{ csrf_field() }}
			<input type="hidden" name="id" value="{{$userForm->_id}}" id="id">
			<div class="modal-header">
				<h5 id="Subscription"><div id="subscription_label">{{ $page_info['page_title'] }}</div></h5>
				<div class="header-link">
					<a href="{{ url(user_role().'/led-motor-config?vehicle_id='.$userForm->vehicle_id) }}" class="btn btn-secondary">LED & Motor config</a>
					<a href="{{ url(user_role().'/multimedia/'.$userForm->_id) }}" class="btn btn-secondary">Multimedia</a>
					<a href="{{ url(user_role().'/vehicle') }}" class="btn btn-secondary">View settings</a>
				</div>
			</div>
			
			<div class="modal-body">
				<div class="row">
				<div class="col-md-12">
					
					<input type="hidden" name="vehicle_id"  value="<?php echo (!empty($userForm->vehicle_id)) ? $userForm->vehicle_id : $_GET['vehicle_id']; ?>">

					<!-- div class="form-group">
						<label>Select car</label> <br/>
						<select class="form-control selectpicker" data-size="5" data-live-search="true" name="vehicle_id" id="vehicle_id" required="">
						  <option value="2021">Select vehicle</option>
							@foreach($vichle_name as $vichle_name)
							  <option value="{{$vichle_name->_id}}" <?php //echo ($vichle_name->_id === $userForm->vehicle_id) ? 'selected':''; ?>>{{$vichle_name->brand .' ('.$vichle_name->model.')'}}</option>
							@endForeach;
						</select>
					</div -->
					<div class="form-group">
						<label>Background color</label>
						<input type="color" class="form-control" name="background_color" value="{{$userForm->background_color}}" id="background_color">
					</div>
					<div class="form-group">
						<label>Pad line color</label>
						<input type="color" class="form-control" name="pad_line_color" value="{{$userForm->pad_line_color}}" id="pad_line_color">
					</div>	
					<div class="form-group">
						<label>Pad background color</label>
						<input type="color" class="form-control" name="pad_background_color" value="{{$userForm->pad_background_color}}" id="pad_background_color">
					</div>
					<!-- div class="form-group">
						<label>Button style Future of "no to be used ?</label><br>
						<input type="radio" class="" name="button_style" placeholder="Button style" value="true" id="button_style" required="">
					</div -->
					<div class="form-group">
						<label>Reverse speed motor</label>
						<select class="form-control" name="reverse_speed_motor" id="reverse_speed_motor">
							  <option value="on" selected disabled>Reverse speed motor</option>
							  <option value="on" <?php echo ($userForm->reverse_speed_motor === 'on') ? 'selected':''; ?>>Yes</option>
							  <option value="off" <?php echo ($userForm->reverse_speed_motor === 'off') ? 'selected':''; ?>>No</option>
						</select>
					</div>

					<div class="form-group">
						<label>Speed motor mA limitation</label>
						<select class="form-control" name="speed_motor_ma_limitation" id="speed_motor_ma_limitation">
							@for($speedma=25; $speedma<=100; $speedma++)
								@if($speedma%5 == 0)
								<option value="{{$speedma}} %" <?php echo ($userForm->speed_motor_ma_limitation === $speedma.' %') ? 'selected':''; ?>>{{$speedma}} %</option>
								@endIf
							@endFor
						</select>
					</div>
					
					<div class="form-group">
						<label>Reverse steer motor</label>
						<select class="form-control" name="reverse_steer_motor" id="reverse_steer_motor">
							  <option value="on" selected disabled>Reverse steer motor</option>
							  <option value="on" <?php echo ($userForm->reverse_steer_motor === 'on') ? 'selected':''; ?>>Yes</option>
							  <option value="off" <?php echo ($userForm->reverse_steer_motor === 'off') ? 'selected':''; ?>>No</option>
						</select>
					</div>
					<div class="form-group">
						<label>Steer motor mA limitation</label>
						<select class="form-control" name="steer_motor_ma_limitation" id="steer_motor_ma_limitation">
							@for($steerma=25; $steerma<=100; $steerma++)
								@if($steerma%5 == 0)
								<option value="{{$steerma}} %" <?php echo ($userForm->steer_motor_ma_limitation === $steerma.' %') ? 'selected':''; ?>>{{$steerma}} %</option>
								@endIf
							@endFor
						</select>
					</div>
					
					<div class="form-group">
						<label>Micro steps</label>
						<select class="form-control" name="micro_steps" id="micro_steps">
							<option value="0">No</option>
							<option value="1" <?php echo ($userForm->micro_steps == '1') ? 'selected':''; ?>>Yes</option>
						</select>
					</div>
					
					<div class="form-group">
						<label>Steer rotation limit per 100 ms</label>
						<input type="text" class="form-control numeric-val" name="steer_angle_limit_per_100_ms" value="{{(int)$userForm->steer_angle_limit_per_100_ms}}" id="steer_angle_limit_per_100_ms">
					</div>

					<!-- div class="form-group">
						<label>Steering control point</label>
						<input type="text" class="form-control" name="steering_control_point" value="{{$userForm->steering_control_point}}" id="steering_control_point">
					</div>
					<div class="form-group">
						Asset folder(custom images) <input type="file" class="form-control" name="asset_folder" value="" id="asset_folder">
					</div>
					<div class="form-group">
						<label>Firmware version (updated from car)</label>
						<input type="text" class="form-control numeric-val" name="firmware" value="{{$userForm->firmware}}" id="firmware" disabled>
					</div -->
					
					<div class="form-group">
						<label>Motor off when standing still</label>
						<select class="form-control btn-toggle" name="motor_off" id="motor_off">
							  <option value="on" <?php echo ($userForm->motor_off === 'on') ? 'selected':''; ?>>On</option>
							  <option value="off" <?php echo ($userForm->motor_off === 'off') ? 'selected':''; ?>>Off</option>
						</select>
					</div>
					
					<div class="form-group motor_off_status" <?php echo ($userForm->motor_off != 'on') ? 'style="display: none"':''; ?>>
						<label>Front motor resistor value</label>
						<select class="form-control" name="front_motor_resistor_value" id="front_motor_resistor_value">
							  <option value="0" selected disabled>Select value</option>
							  <?php for($front_motor = 20; $front_motor > 4; $front_motor--) { ?>
								<option value="<?php echo (int)($front_motor.'0'); ?>" <?php echo ($userForm->front_motor_resistor_value == $front_motor.'0') ? 'selected':''; ?>><?php echo $front_motor.'0'.' %'; ?></option>
							  <?php } ?>
						</select>
					</div>
					<div class="form-group motor_off_status" <?php echo ($userForm->motor_off != 'on') ? 'style="display: none"':''; ?>>
						<label>Front motor OFF ms</label>
						<select class="form-control" name="front_motor_off_ms" id="front_motor_off_ms">
								<?php for($fmom = 0; $fmom <= 255; $fmom++) { ?>
										<option value="{{(int)$fmom}}" <?php echo ($userForm->front_motor_off_ms == $fmom) ? 'selected':''; ?>>{{$fmom}}</option>
								<?php } ?>
						</select>
					</div>
					<div class="form-group motor_off_status" <?php echo ($userForm->motor_off != 'on') ? 'style="display: none"':''; ?>>
						<label>Rear motor resistor value</label>
						<select class="form-control" name="rear_motor_resistor_value" id="rear_motor_resistor_value">
							  <option value="0" selected disabled>Select value</option>
							  <?php for($rear_motor = 20; $rear_motor > 4; $rear_motor--) { ?>
								<option value="<?php echo (int)($rear_motor.'0'); ?>" <?php echo ($userForm->rear_motor_resistor_value == $rear_motor.'0') ? 'selected':''; ?>><?php echo $rear_motor.'0'.' %'; ?></option>
							  <?php } ?>
						</select>
					</div>
					<div class="form-group motor_off_status" <?php echo ($userForm->motor_off != 'on') ? 'style="display: none"':''; ?>>
						<label>Rear motor OFF ms</label>
						<select class="form-control" name="rear_motor_off_ms" id="rear_motor_off_ms">
								<?php for($rmom = 0; $rmom <= 255; $rmom++) { ?>
										<option value="{{(int)$rmom}}" <?php echo ($userForm->rear_motor_off_ms == $rmom) ? 'selected':''; ?>>{{$rmom}}</option>
								<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<!-- label>Acc/dec speed curves</label -->
						<label>Acceleration curve</label>
						<input type="text" class="form-control" name="acceleration_curve" value="{{$userForm->acceleration_curve}}" id="acceleration_curve" disabled>
					</div>
					<div class="form-group">
						<label>Motor trim kit</label>
						<select class="form-control" name="motor_trim_kit" id="motor_trim_kit">
							<option value="0" <?php echo ($userForm->motor_trim_kit == 0) ? 'selected':''; ?>>0 %</option>
								<?php for($mo_t_k = 1; $mo_t_k <= 6; $mo_t_k++) {
									$mo_t_k_5  = $mo_t_k * 5;
								?>
										<option value="{{(int)$mo_t_k_5}}" <?php echo ($userForm->motor_trim_kit == $mo_t_k_5) ? 'selected':''; ?>>{{$mo_t_k_5.' %'}}</option>
								<?php } ?>
						</select>
					</div>
					
					<div class="form-group none">
						<label>Shift value normal</label>
						<input type="text" class="form-control numeric-val" name="upper_gear_shift_value" value="{{(int)$userForm->upper_gear_shift_value}}" id="upper_gear_shift_value">
					</div>
					
					<div class="form-group none">
						<label>Shift value race</label>
						<input type="text" class="form-control numeric-val" name="shift_value_race" value="{{(int)$userForm->shift_value_race}}" id="shift_value_race">
					</div>
					
					<div class="form-group none">
						<label>Brake threshold value</label>
						<input type="number" class="form-control numeric-val" min="10" max="50" name="lower_gear_shift_value" value="{{(int)$userForm->lower_gear_shift_value}}" id="lower_gear_shift_value">
					</div>
					<div class="form-group none">
						<label>Gear shift A value (ms) + revving</label>
						<input type="text" class="form-control numeric-val" name="gear_shift_a_value" value="{{(int)$userForm->gear_shift_a_value}}" id="gear_shift_a_value">
					</div>
					<div class="form-group none">
						<label>Gear shift B value (ms)</label>
						<input type="text" class="form-control numeric-val" name="gear_shift_b_value" value="{{(int)$userForm->gear_shift_b_value}}" id="gear_shift_b_value">
					</div>
					<div class="form-group none">
						<label>Gear shift A (rpm value) + revving</label>
						<input type="text" class="form-control numeric-val" name="gear_shift_a_rpm_value" value="{{(int)$userForm->gear_shift_a_rpm_value}}" id="gear_shift_a_rpm_value">
					</div>
					<!-- div class="form-group">
						<label>Cell value steer pad</label>
						<input type="text" class="form-control numeric-val" name="cell_value_steer_pad" value="{{$userForm->cell_value_steer_pad}}" id="cell_value_steer_pad">
					</div -->
					<div class="form-group none">
						<label>Car speed factor/Gear ratio</label>
						<input type="text" class="form-control numeric-val" name="gear_retio" value="{{$userForm->gear_retio}}" id="gear_retio">
					</div>
					<div class="form-group none">
						<label for="">Max steering angle</label>
						<input type="text" class="form-control numeric-val" name="max_steering_angle" value="{{$userForm->max_steering_angle}}" id="max_steering_angle">
					</div>
					<!-- div class="form-group">
						<label>LED configuration</label>
						<input type="text" class="form-control" name="led_configuration" value="{{$userForm->led_configuration}}" id="led_configuration">
					</div>
					<div class="form-group">
						<label>Button config for each button</label>
						<input type="text" class="form-control" name="button_config_for_each_menu" value="{{$userForm->button_config_for_each_menu}}" id="button_config_for_each_menu">
					</div>
					<div class="form-group">
						Sound file folder <input type="file" class="form-control" name="sound_file_folder" value="{{$userForm->sound_file_folder}}" id="sound_file_folder">
					</div -->
					
					<div class="form-group none">
						<label>Motor steps for max steering</label>
						<input type="text" class="form-control numeric-val" name="motor_steps_for_max_steering" value="{{$userForm->motor_steps_for_max_steering}}" id="motor_steps_for_max_steering">
					</div>
					<div class="form-group none">
						<label>Hall sensor frequency</label>
						<input type="text" class="form-control numeric-val" name="hall_sensor_frequency" value="{{$userForm->hall_sensor_frequency}}" id="hall_sensor_frequency">
					</div>
					<!-- div class="form-group">
						<label>Value</label>
						<input type="text" class="form-control" name="Value" id="Value" value="">
					</div -->
					<div class="form-group">
						<label>Daylight auto ON (if any)</label>
						<select class="form-control" name="daylight_auto_on" id="daylight_auto_on" disabled>
							  <option value="off" selected disabled></option>
							  <option value="on" <?php echo ($userForm->daylight_auto_on == 'on') ? 'selected':''; ?>>Yes</option>
							  <option value="off" <?php echo ($userForm->daylight_auto_on == 'off') ? 'selected':''; ?>>No</option>
						</select>
					</div>
					<div class="form-group">
						<label>Brakelights threshold</label>
						<br/>
						<img class="img-fluid img-profile mx-auto mb-2 brakelights-threshold" src="{{ url('/public/assets/ctrlImages/imgpsh_fullsize_anim.png') }}" alt="">
					</div>
					<div class="form-group row margin-max-speed">
							<select class="form-control select-box-1" name="brake_lights_1" id="brake_lights_1" disabled>
									<?php for($br_li = 0; $br_li <= 255; $br_li++) { ?>
											<option value="{{$br_li}}" <?php echo ($userForm->brake_lights_1 == $br_li) ? 'selected':''; ?>>{{$br_li}}</option>
									<?php } ?>
							</select>
							<select class="form-control select-box-1" name="brake_lights_2" id="brake_lights_2" disabled>
									<?php for($br_li2 = 0; $br_li2 <= 255; $br_li2++) { ?>
											<option value="{{$br_li2}}" <?php echo ($userForm->brake_lights_2 == $br_li2) ? 'selected':''; ?>>{{$br_li2}}</option>
									<?php } ?>
							</select>
					</div>
					<div class="form-group">
						<label>Motion sensor level1</label>
						<select class="form-control" name="motion_sensor_level_1" id="motion_sensor_level_1">
								<?php for($level_1 = 0; $level_1 <= 255; $level_1++) { ?>
										<option value="{{$level_1}}" <?php echo ($userForm->motion_sensor_level_1 == $level_1) ? 'selected':''; ?>>{{$level_1}}</option>
								<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label>Motion sensor level2</label>
						<select class="form-control" name="motion_sensor_level_2" id="motion_sensor_level_2">
								<?php for($level_2 = 0; $level_2 <= 255; $level_2++) { ?>
										<option value="{{$level_2}}" <?php echo ($userForm->motion_sensor_level_2 == $level_2) ? 'selected':''; ?>>{{$level_2}}</option>
								<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label>Motion sensor theft</label>
						<select class="form-control" name="motion_sensor_theft" id="motion_sensor_theft">
								<?php for($theft = 0; $theft <= 255; $theft++) { ?>
										<option value="{{$theft}}" <?php echo ($userForm->motion_sensor_theft == $theft) ? 'selected':''; ?>>{{$theft}}</option>
								<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label>Out of range</label>
						<select class="form-control" name="out_of_range" id="out_of_range">
							<?php for($outRange = 0; $outRange <= 255; $outRange++) { 
								$sec_outRange = $outRange. ' sec';
							?>
									<option value="{{$sec_outRange}}" <?php echo ($userForm->out_of_range == $sec_outRange) ? 'selected':''; ?>>{{$sec_outRange}}</option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label>Onboard sound</label>
						<select class="form-control" name="onboard_sound" id="onboard_sound">
							  <option value="on" selected disabled>Onboard sound</option>
							  <option value="on" <?php echo ($userForm->onboard_sound == 'on') ? 'selected':''; ?>>Yes</option>
							  <option value="off" <?php echo ($userForm->onboard_sound == 'off') ? 'selected':''; ?>>No</option>
						</select>
					</div>
					<div class="form-group">
						<label>Zoom factor - Speed</label>
						<input type="text" class="form-control numeric-val" name="zoom_factor_speed" value="{{$userForm->zoom_factor_speed}}" id="zoom_factor_speed">
					</div>
					<div class="form-group">
						<label>Zoom factor - Steer</label>
						<input type="text" class="form-control numeric-val" name="zoom_factor_steer" value="{{$userForm->zoom_factor_steer}}" id="zoom_factor_steer">
					</div>
					<div class="form-group none">
						<label>Screen view</label>
						<select class="form-control" name="screen_rotation_landscape" id="screen_rotation_landscape">
							  <option value="Car view" selected disabled>Screen view landscape</option>
							  <option value="Car view" <?php echo ($userForm->screen_rotation_landscape == 'Car view') ? 'selected':''; ?>>Car view</option>
							  <option value="Train view" <?php echo ($userForm->screen_rotation_landscape == 'Train view') ? 'selected':''; ?>>Train view</option>
						</select>
					</div>
					<div class="form-group">
						<label>Train view (Option: Left/right)</label>
						<select class="form-control" name="train_view" id="train_view">
							  <option value="Left" selected disabled>Train view (Option: Left/right)</option>
							  <option value="Left" <?php echo ($userForm->train_view == 'Left') ? 'selected':''; ?>>Left</option>
							  <option value="Right" <?php echo ($userForm->train_view == 'Right') ? 'selected':''; ?>>Right</option>
						</select>
					</div>
					<div class="form-group none">
						<label>Pad design 2-directional</label>
						<select class="form-control" name="pad_design_2_directional" id="pad_design_2_directional">
							  <option value="on" selected disabled>Pad design 2-directional</option>
							  <option value="on" <?php echo ($userForm->pad_design_2_directional == 'on') ? 'selected':''; ?>>Yes</option>
							  <option value="off" <?php echo ($userForm->pad_design_2_directional == 'off') ? 'selected':''; ?>>No</option>
						</select>
					</div>
					<div class="form-group">
						<label>Motor configuration</label>
						<select class="form-control" name="motor_configuration" id="motor_configuration">
							  <option value="Speed + Steer" selected disabled>Motor configuration</option>
							  <option value="Speed + Steer" <?php echo ($userForm->motor_configuration == 'Speed + Steer') ? 'selected':''; ?>>Speed + Steer</option>
							  <option value="Speed + Speed" <?php echo ($userForm->motor_configuration == 'Speed + Speed') ? 'selected':''; ?>>Speed + Speed</option>
						</select>
					</div>
					<div class="form-group">
						<label>Electric motor re-built</label>
						<select class="form-control" name="electric_motor_re_built" id="electric_motor_re_built">
							  <option value="on" selected disabled>Electric motor re-built</option>
							  <option value="on" <?php echo ($userForm->electric_motor_re_built == 'on') ? 'selected':''; ?>>Yes</option>
							  <option value="off" <?php echo ($userForm->electric_motor_re_built == 'off') ? 'selected':''; ?>>No</option>
						</select>
					</div>
				  </div>
				  
				</div>



			</div>
			<div class="modal-footer">
			<input type="button" class="btn btn-secondary" onclick="form_return()" value="Back">
			<input type="submit" class="btn btn-primary" value="Save changes">
			</div>
		</form>
		
		
                    
    </div>


@endsection


@section('script')
	<script>
				$(document).ready(function(){
					$('#Updateuser').submit(function(event){
						// $('#publisherEmailValidation').html('<div class="author_loading"><img src="{{ url('public/ctrl-icon/loder.gif') }}" height="150" width="150"></div>');
						 $.ajax({
						   type:this.method,
						   url: this.action,
						   contentType: false, 
						   processData:false,   
						   data: new FormData(this),
						   success:function(response)
						   {
								var result = JSON.parse(response);
								window.location.href = "../redirectsetting/vehicle?message="+result.message;

								// $.toaster({ priority : 'success', title : 'Success', message : result.message });
								// if(result.action === 'add_form')
									// $("#Updateuser").trigger("reset");
						   }
						});
						event.preventDefault();
					});
					
					// $('select[name="vehicle_id"]').change(function(){
						// $.ajax({
							// type: 'GET',
							// dataType : 'json',
							// url: 'settings/'+$(this).val(),
							// success: function (response) {
								// if(response.data) {
									// $('input[name="background_color"]').val(response.data.background_color);
									// $('input[name="pad_line_color"]').val(response.data.pad_line_color);
									// $('input[name="pad_background_color"]').val(response.data.pad_background_color);
									// $('input[name="button_style"]').val(response.data.button_style);
									
									// $('input[name="daylight_auto_on"]').val(response.data.daylight_auto_on);
									// $('input[name="reverse_speed_motor"]').val(response.data.reverse_speed_motor);
									// $('input[name="reverse_steer_motor"]').val(response.data.reverse_steer_motor);
									
									// $('input[name="motor_off"]').val(response.data.motor_off);
									// $('input[name="steering_control_point"]').val(response.data.steering_control_point);
									// $('input[name="asset_folder"]').val(response.data.asset_folder);
									
									// $('input[name="firmware"]').val(response.data.firmware);
									// $('input[name="front_motor"]').val(response.data.front_motor);
									// $('input[name="rear_motor"]').val(response.data.rear_motor);
									// $('input[name="gearbox_amount_of_gears"]').val(response.data.gearbox_amount_of_gears);
									// $('input[name="max_speed_per_gears"]').val(response.data.max_speed_per_gears);
									
									// $('input[name="speed_curve"]').val(response.data.speed_curve);
									// $('input[name="max_rpm"]').val(response.data.max_rpm);
									// $('input[name="idle_rpm"]').val(response.data.idle_rpm);
									// $('input[name="upper_gear_shift_value"]').val(response.data.upper_gear_shift_value);
									
									// $('input[name="lower_gear_shift_value"]').val(response.data.lower_gear_shift_value);
									// $('input[name="cell_value_steer_pad"]').val(response.data.cell_value_steer_pad);
									// $('input[name="gear_retio"]').val(response.data.gear_retio);
									// $('input[name="max_steering_angle"]').val(response.data.max_steering_angle);
									// $('input[name="led_configuration"]').val(response.data.led_configuration);
									// $('input[name="button_config_for_each_menu"]').val(response.data.button_config_for_each_menu);
								// }
							// },
							// error: function() {
								 // console.log(response);
							// }
						// });
					// });

					
				});
				function form_return()
					{
						window.history.back();
					}
				
	</script>
	
@endsection
