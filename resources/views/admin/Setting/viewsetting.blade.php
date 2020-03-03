@extends('layouts.appadmin')

@section('content')
	<style>
	form {
			background-color: #fff;
	}
	</style>
	<div class="page-content-wrap updateuserSetting">
                    <!-- START ALERT BLOCKS -->

<!-- END ALERT BLOCKS -->                    	
		<form method="POST" action="{{ url($formaction) }}" id="UpdateuserSetting" enctype="multipart/form-data">
			{{ csrf_field() }}
			<input type="hidden" name="id" value="{{$userForm->_id}}" id="id">
			<div class="modal-header">
				<h5 id="Subscription"><div id="subscription_label">{{ $page_info['page_title'] }}</div></h5>
			</div>
			
			<div class="modal-body">
				<div class="row">
				<?php if(!isset($_GET['vehicle_id'])) { ?>
				<div class="form-group">
						<div class="col-sm-12 col-xs-12">
							<label>Select vehicle</label><br>
							<select class="form-control selectpicker" data-size="5" data-live-search="true" name="vehicle_id" id="vehicle_id" required="">
							  <option value="2019">Select vehicle</option>
							  @foreach($vichle_name as $vichle_name)
								  <option value="{{$vichle_name->_id}}" <?php echo ($vichle_name->_id === $userForm->vehicle_id) ? 'selected':''; ?>>{{$vichle_name->brand .' ('.$vichle_name->model.')'}}</option>
							  @endForeach;
							</select>
						</div>
				</div>
				<?php }else{ ?>
					<input type="hidden" name="vehicle_id"  value="<?php echo $_GET['vehicle_id']; ?>">
				<?php } ?>
				
				  <div class="col-md-12">
					<div class="form-group">
						<label>Colors/Background color</label>
						<input type="color" class="form-control" name="background_color" value="{{$userForm->background_color}}" id="background_color" required="">
					</div>
					<div class="form-group">
						<label>Colors/Pad line color</label>
						<input type="color" class="form-control" name="pad_line_color" value="{{$userForm->pad_line_color}}" id="pad_line_color" required="">
					</div>	
					<div class="form-group">
						<label>Pad background color</label>
						<input type="color" class="form-control" name="pad_background_color" value="{{$userForm->pad_background_color}}" id="pad_background_color" required="">
					</div>
					<!-- div class="form-group">
						<label>Button style Future of "no to be used ?</label><br>
						<input type="radio" class="" name="button_style" placeholder="Button style" value="true" id="button_style" required="">
					</div -->
					<div class="form-group">
						<label>Daylight auto ON (if any)</label>
						<select class="form-control" name="daylight_auto_on" id="daylight_auto_on" required="">
							  <option value="on" selected disabled>Daylight auto ON (if any)</option>
							  <option value="on" <?php echo ($userForm->daylight_auto_on === 'on') ? 'selected':''; ?>>Yes</option>
							  <option value="off" <?php echo ($userForm->daylight_auto_on === 'off') ? 'selected':''; ?>>No</option>
						</select>
					</div>
					<div class="form-group">
						<label>Reverse speed motor</label>
						<select class="form-control" name="reverse_speed_motor" id="reverse_speed_motor" required="">
							  <option value="on" selected disabled>Reverse speed motor</option>
							  <option value="on" <?php echo ($userForm->reverse_speed_motor === 'on') ? 'selected':''; ?>>Yes</option>
							  <option value="off" <?php echo ($userForm->reverse_speed_motor === 'off') ? 'selected':''; ?>>No</option>
						</select>
					</div>
					<div class="form-group">
						<label>Reverse steer motor</label>
						<select class="form-control" name="reverse_steer_motor" id="reverse_steer_motor" required="">
							  <option value="on" selected disabled>Reverse steer motor</option>
							  <option value="on">Yes</option>
							  <option value="off">No</option>
						</select>
					</div>
					<div class="form-group">
						<label>Steering control point</label>
						<input type="text" class="form-control" name="steering_control_point" value="{{$userForm->steering_control_point}}" id="steering_control_point" required="">
					</div>
					<div class="form-group">
						Asset folder(custom images) <input type="file" class="form-control" name="asset_folder" value="" id="asset_folder">
					</div>
					<div class="form-group">
						<label>Firmware version (updated from car)</label>
						<input type="text" class="form-control" name="firmware" value="{{$userForm->firmware}}" id="firmware" required="" onkeypress="javascript:return isNumeric(event)">
					</div>
					<div class="form-group">
						<label>Front motor resistor value</label>
						<select class="form-control" name="front_motor_resistor_value" id="front_motor_resistor_value" required="">
							  <option value="on" selected disabled>Select value</option>
							  <?php for($front_motor = 20; $front_motor > 4; $front_motor--) { ?>
								<option value="<?php echo $front_motor; ?>"><?php echo '0,'.$front_motor.'0'; ?></option>
							  <?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label>Rear motor resistor value</label>
						<select class="form-control" name="rear_motor_resistor_value" id="rear_motor_resistor_value" required="">
							  <option value="on" selected disabled>Select value</option>
							  <?php for($rear_motor = 20; $rear_motor > 4; $rear_motor--) { ?>
								<option value="<?php echo $rear_motor; ?>"><?php echo '0,'.$rear_motor.'0'; ?></option>
							  <?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label>Motor off</label>
						<input type="hidden" class="form-control" name="motor_off" value="true" id="motor_off">
						<button type="button" class="btn btn-sm btn-secondary btn-toggle" data-toggle="button" aria-pressed="true" autocomplete="off"><div class="handle"></div></button>
					</div>
					<div class="form-group motor_off_status" style="display: none">
						<label>Front motor resistor value</label>
						<input type="text" class="form-control" name="front_motor" value="{{$userForm->front_motor}}" id="front_motor">
					</div>
					<div class="form-group motor_off_status" style="display: none">
						<label>Rear motor resistor value</label>
						<input type="text" class="form-control" name="rear_motor" value="{{$userForm->rear_motor}}" id="rear_motor">
					</div>
					<div class="form-group">
						<label>Gearbox amount of gears</label>
						<input type="text" class="form-control" name="gearbox_amount_of_gears" value="{{$userForm->gearbox_amount_of_gears}}" id="gearbox_amount_of_gears" required="">
					</div>
					<div class="form-group">
						<label>Max speed per gears</label>
						<input type="text" class="form-control" name="max_speed_per_gears" value="{{$userForm->max_speed_per_gears}}" id="max_speed_per_gears" required="" onkeypress="javascript:return isNumeric(event)">
					</div>
					<div class="form-group">
						<label>Acc/dec speed curves</label>
						<input type="text" class="form-control" name="speed_curve" value="{{$userForm->speed_curve}}" id="speed_curve" required="" onkeypress="javascript:return isNumeric(event)">
					</div>
					<div class="form-group">
						<label>Max rpm</label>
						<input type="text" class="form-control" name="max_rpm" value="{{$userForm->max_rpm}}" id="max_rpm" required="" onkeypress="javascript:return isNumeric(event)">
					</div>
					<div class="form-group">
						<label>Idle rpm</label>
						<input type="text" class="form-control" name="idle_rpm" value="{{$userForm->idle_rpm}}" id="idle_rpm" required="" onkeypress="javascript:return isNumeric(event)">
					</div>
					<div class="form-group">
						<label>Upper gear shift value</label>
						<input type="text" class="form-control" name="upper_gear_shift_value" value="{{$userForm->upper_gear_shift_value}}" id="upper_gear_shift_value" required="" onkeypress="javascript:return isNumeric(event)">
					</div>
					<div class="form-group">
						<label>Lower gear shift value</label>
						<input type="text" class="form-control" name="lower_gear_shift_value" value="{{$userForm->lower_gear_shift_value}}" id="lower_gear_shift_value" required="" onkeypress="javascript:return isNumeric(event)">
					</div>
					<div class="form-group">
						<label>Gear shift A value (ms)</label>
						<input type="text" class="form-control" name="gear_shift_a_value" id="gear_shift_a_value" required="" onkeypress="javascript:return isNumeric(event)">
					</div>
					<div class="form-group">
						<label>Gear shift B value (ms)</label>
						<input type="text" class="form-control" name="gear_shift_b_value" id="gear_shift_b_value" required="" onkeypress="javascript:return isNumeric(event)">
					</div>
					<div class="form-group">
						<label>Gear shift A (rpm value)</label>
						<input type="text" class="form-control" name="gear_shift_a_rpm_value" id="gear_shift_a_rpm_value" required="" onkeypress="javascript:return isNumeric(event)">
					</div>
					<div class="form-group">
						<label>Cell value steer pad</label>
						<input type="text" class="form-control" name="cell_value_steer_pad" value="{{$userForm->cell_value_steer_pad}}" id="cell_value_steer_pad" required="" onkeypress="javascript:return isNumeric(event)">
					</div>
					<div class="form-group">
						<label>Car speed factor/Gear ratio</label>
						<input type="text" class="form-control" name="gear_retio" value="{{$userForm->gear_retio}}" id="gear_retio" required="">
					</div>
					<div class="form-group">
						<label for="">Max steering angle</label>
						<input type="text" class="form-control" name="max_steering_angle" value="{{$userForm->max_steering_angle}}" id="max_steering_angle" required="">
					</div>
					<div class="form-group">
						<label>LED configuration</label>
						<input type="text" class="form-control" name="led_configuration" value="{{$userForm->led_configuration}}" id="led_configuration" required="">
					</div>
					<div class="form-group">
						<label>Button config for each button</label>
						<input type="text" class="form-control" name="button_config_for_each_menu" value="{{$userForm->button_config_for_each_menu}}" id="button_config_for_each_menu" required="">
					</div>
					<div class="form-group">
						Sound file folder <input type="file" class="form-control" name="sound_file_folder" value="" id="sound_file_folder">
					</div>
					<div class="form-group">
						<label>Hall sensor frequency</label>
						<input type="text" class="form-control" name="hall_sensor_frequency" id="hall_sensor_frequency" required="" onkeypress="javascript:return isNumeric(event)">
					</div>
					<div class="form-group">
						<label>Motor steps for max steering (see ID 76)</label>
						<input type="text" class="form-control" name="motor_steps_for_max_steering" id="motor_steps_for_max_steering" required="" onkeypress="javascript:return isNumeric(event)">
					</div>
					<div class="form-group">
						<label>Value</label>
						<input type="text" class="form-control" name="Value" id="Value" required="">
					</div>
					<div class="form-group">
						<label>Onboard sound</label>
						<select class="form-control" name="onboard_sound" id="onboard_sound" required="">
							  <option value="on" selected disabled>Onboard sound</option>
							  <option value="on">Yes</option>
							  <option value="off">No</option>
						</select>
					</div>
					<div class="form-group">
						<label>Screen rotation landscape</label>
						<select class="form-control" name="screen_rotation_landscape" id="screen_rotation_landscape" required="">
							  <option value="on" selected disabled>Screen rotation landscape</option>
							  <option value="on">Yes</option>
							  <option value="off">No</option>
						</select>
					</div>
					<div class="form-group">
						<label>Pad design 2-directional</label>
						<select class="form-control" name="pad_design_2_directional" id="pad_design_2_directional" required="">
							  <option value="on" selected disabled>Pad design 2-directional</option>
							  <option value="on">Yes</option>
							  <option value="off">No</option>
						</select>
					</div>
					<div class="form-group">
						<label>Electric motor re-built</label>
						<select class="form-control" name="electric_motor_re_built" id="electric_motor_re_built" required="">
							  <option value="on" selected disabled>Electric motor re-built</option>
							  <option value="on">Yes</option>
							  <option value="off">No</option>
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
	@if(session()->has('flash-message'))
	  <script>
		jQuery(document).ready(function () {
		  $.toaster({ priority : 'success', title : 'Success', message : "{{ session()->get('flash-message') }}" });
		});
	  </script>
	@endif
	
@endsection
