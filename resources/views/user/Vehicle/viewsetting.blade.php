@extends('layouts.appuser')

@section('content')
	
	<div class="page-content-wrap">
                    <!-- START ALERT BLOCKS -->

<!-- END ALERT BLOCKS -->                    	
		<form method="POST" action="{{ url($formaction) }}" id="Updateuser" enctype="multipart/form-data">
			{{ csrf_field() }}
			<input type="hidden" name="id" value="{{$userForm->_id}}" id="id">
			<div class="modal-header">
				<h5 id="Subscription"><div id="subscription_label">{{ $page_info['page_title'] }}</div></h5>
				<a href="vehicle-setting/all" class="btn btn-primary">All settings</a>
			</div>
			
			<div class="modal-body">
				<div class="row">
				<div class="form-group">
						<div class="col-sm-12 col-xs-12">
							<label for="">Select car</label>
							<select class="form-control selectpicker" data-size="5" data-live-search="true" name="vehicle_id" id="vehicle_id" required="">
							  <option value="2019">Select vehicle</option>
							  @foreach($vichle_name as $vichle_name)
								  <option value="{{$vichle_name->_id}}" <?php echo ($vichle_name->_id === $userForm->vehicle_id) ? 'selected':''; ?>>{{$vichle_name->brand .' ('.$vichle_name->model.')'}}</option>
							  @endForeach;
							</select>
						</div>
				</div>
				
				  <div class="col-md-6">
					<div class="form-group">
						<label for="">Background color</label>
						<input type="text" class="form-control" name="background_color" value="{{$userForm->background_color}}" id="background_color" required="">
					</div>
					
					<div class="form-group">
						<label for="">Pad background color</label>
						<input type="text" class="form-control" name="pad_background_color" value="{{$userForm->pad_background_color}}" id="pad_background_color" required="">
					</div>
					
					<div class="form-group">
						<label for="">Daylight auto ON (if any)</label>
						<input type="text" class="form-control email" name="daylight_auto_on" value="{{$userForm->daylight_auto_on}}" id="daylight_auto_on" required="">
					</div>
					
					<div class="form-group">
						<label for="">Motor off</label>
						<input type="text" class="form-control" name="motor_off" value="{{$userForm->motor_off}}" id="motor_off" required="">
					</div>
					
					<div class="form-group">
						<label for="">Asset folder(custom images)</label>
						<input type="text" class="form-control" name="asset_folder" value="{{$userForm->asset_folder}}" id="asset_folder" required="">
					</div>
					
					<div class="form-group">
						<label for="">Front motor</label>
						<input type="text" class="form-control" name="front_motor" value="{{$userForm->front_motor}}" id="front_motor" required="">
					</div>
					
					<div class="form-group">
						<label for="">Gearbox amount of gears</label>
						<input type="text" class="form-control" name="gearbox_amount_of_gears" value="{{$userForm->gearbox_amount_of_gears}}" id="gearbox_amount_of_gears" required="">
					</div>
					
					<div class="form-group">
						<label for="">Speed curve</label>
						<input type="text" class="form-control" name="speed_curve" value="{{$userForm->speed_curve}}" id="speed_curve" required="">
					</div>
					
					<div class="form-group">
						<label for="">Idle rpm</label>
						<input type="text" class="form-control" name="idle_rpm" value="{{$userForm->idle_rpm}}" id="idle_rpm" required="">
					</div>
					
					<div class="form-group">
						<label for="">Lower gear shift value</label>
						<input type="text" class="form-control" name="lower_gear_shift_value" value="{{$userForm->lower_gear_shift_value}}" id="lower_gear_shift_value" required="">
					</div>
					
					<div class="form-group">
						<label for="">Gear retio</label>
						<input type="text" class="form-control" name="gear_retio" value="{{$userForm->gear_retio}}" id="gear_retio" required="">
					</div>
					
					<div class="form-group">
						<label for="">LED configuration for each button</label>
						<input type="text" class="form-control" name="led_configuration" value="{{$userForm->led_configuration}}" id="led_configuration" required="">
					</div>
					
					
				  </div>
				  
				  
				  
					<!--       two way contant    -->
					
					
				  
				  <div class="col-md-6">
					<div class="form-group">
						<label for="">Pad line color</label>
						<input type="text" class="form-control" name="pad_line_color" value="{{$userForm->pad_line_color}}" id="pad_line_color" required="">
					</div>	
					
					<div class="form-group">
						<label for="">Button style</label>
						<input type="text" class="form-control" name="button_style" value="{{$userForm->button_style}}" id="button_style" required="">
					</div>
					
					<div class="form-group">
						<label for="">Reverse speed motor</label>
						<input type="text" class="form-control" name="reverse_speed_motor" value="{{$userForm->reverse_speed_motor}}" id="reverse_speed_motor" required="">
					</div>
					
					<div class="form-group">
						<label for="">Steering control point</label>
						<input type="text" class="form-control" name="steering_control_point" value="{{$userForm->steering_control_point}}" id="steering_control_point" required="">
					</div>
					
					<div class="form-group">
						<label for="">Firmware (updated from car)</label>
						<input type="text" class="form-control" name="firmware" value="{{$userForm->firmware}}" id="firmware" required="">
					</div>
					
					<div class="form-group">
						<label for="">Rear motor</label>
						<input type="text" class="form-control" name="rear_motor" value="{{$userForm->rear_motor}}" id="rear_motor" required="">
					</div>
					
					<div class="form-group">
						<label for="">Max speed per gears</label>
						<input type="text" class="form-control" name="max_speed_per_gears" value="{{$userForm->max_speed_per_gears}}" id="max_speed_per_gears" required="">
					</div>
					
					<div class="form-group">
						<label for="">Max rpm</label>
						<input type="text" class="form-control" name="max_rpm" value="{{$userForm->max_rpm}}" id="max_rpm" required="">
					</div>
					
					<div class="form-group">
						<label for="">Upper gear shift value</label>
						<input type="text" class="form-control" name="upper_gear_shift_value" value="{{$userForm->upper_gear_shift_value}}" id="upper_gear_shift_value" required="">
					</div>
					
					<div class="form-group">
						<label for="">Cell value steer pad</label>
						<input type="text" class="form-control" name="cell_value_steer_pad" value="{{$userForm->cell_value_steer_pad}}" id="cell_value_steer_pad" required="">
					</div>
					
					<div class="form-group">
						<label for="">Max steering angle</label>
						<input type="text" class="form-control" name="max_steering_angle" value="{{$userForm->max_steering_angle}}" id="max_steering_angle" required="">
					</div>
					
					<div class="form-group">
						<label for="">Button config for each menu</label>
						<input type="text" class="form-control" name="button_config_for_each_menu" value="{{$userForm->button_config_for_each_menu}}" id="button_config_for_each_menu" required="">
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
								$.toaster({ priority : 'success', title : 'Success', message : result.message });
								if(result.action === 'add_form')
									$("#Updateuser").trigger("reset");
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
