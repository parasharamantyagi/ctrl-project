@extends('layouts.appadmin')

@section('content')
	<style>
		.led-config { margin-left: 66%;}
		label { margin-bottom: .5rem; }
			/* Create two equal columns that floats next to each other */
		.column { float: left; width: 50%; padding: 10px;}
			/* Clear floats after the columns */
		.row:after { content: ""; display: table; clear: both; }
		table tr td img { border-radius: 20%; width: 40px; height: 40px; padding: 4px; }
		.form-control { width: 50% !important; }
		.table2 { margin-left: 20px }
		.table3 { margin-left: 40px }
		.table4 { margin-left: 60px }
		.table5 { margin-left: 80px }
		table tbody{ border: 1px solid black; }
	</style>
	<div class="page-content-wrap">
                    <!-- START ALERT BLOCKS -->
	             
<!-- END ALERT BLOCKS -->                    	
		<form method="POST" action="" id="Updateuser" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="modal-header">
				<h5>{{ $page_info['page_title'] }}</h5>
				<div class="header-link">
					<?php if(isset($_GET['vehicle_id'])) { ?>
						<a href="{{ url(user_role('vehicle-view/'.$_GET['vehicle_id'])) }}" class="btn btn-secondary addvehicle-vehicle_info">Vehicle info</a>
						<a href='{{ url(user_role("settings{$setting_id}")) }}' class="btn btn-secondary addvehicle-settings">Settings</a>
						<a href="{{ url(user_role('create-new-car?vehicle_id='.$_GET['vehicle_id'])) }}" class="btn btn-secondary addvehicle-led-config">LED config</a>
						<a href="{{ url(user_role('car-button?vehicle_id='.$_GET['vehicle_id'])) }}" class="btn btn-secondary">Button config</a>
						<a href="{{ url(user_role('multimedia?vehicle_id='.$_GET['vehicle_id'])) }}" class="btn btn-secondary">Multimedia</a>
						<a href="{{ url(user_role('led-motor-config?vehicle_id='.$_GET['vehicle_id'])) }}" class="btn btn-secondary">Motor config</a>
					<?php }else{ ?>
						<a href="javascript:void(0)" class="btn btn-secondary addvehicle-vehicle_info empty">Vehicle info</a>
						<a href="javascript:void(0)" class="btn btn-secondary addvehicle-settings empty">Settings</a>
						<a href="javascript:void(0)" class="btn btn-secondary addvehicle-led-config empty">LED config</a>
						<a href="javascript:void(0)" class="btn btn-secondary addvehicle-Button-config">Button config</a>
						<a href="javascript:void(0)" class="btn btn-secondary addvehicle-Button-config">Multimedia</a>
						<a href="javascript:void(0)" class="btn btn-secondary addvehicle-Button-config">Motor config</a>
					<?php } ?>
				</div>
			</div>
			
		<div class="modal-body">
			<p><h5>Car {{ $page_info['page_title'] }}</h5></p>
			<div class="row">
				<div class="col-md-2">
					<table class="table1">
						<thead><tr><td colspan="3"><center><b>Default</b></center></td></tr></thead>
						<tbody>
							<tr>
								<td><img src="{{url('assets/ctrlImages/car-button/left_search_led@2x.png')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/lights@2x.png')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/right_search_led@2x.png')}}"></td>
							</tr>
							<tr>
								<td><img src="{{url('assets/ctrlImages/car-button/left_arrow@2x.png')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/full_beam@2x.png')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/right_arrow@2x.png')}}"></td>
							</tr>
							<tr>
								<td><img src="{{url('assets/ctrlImages/car-button/gray_revearse@2x.png')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/menu@2x.png')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/horn@2x.png')}}"></td>
							</tr>
						</tbody>
						<tfoot><tr><td colspan="3"><center><input type="checkbox" name="car_button[]" value="default" <?php echo (in_array('default',$car_button)) ? 'checked':''; ?>></center></td></tr></tfoot>
					</table>
					
				</div>
				<div class="col-md-2">
					<table class="table2">
						<thead><tr><td colspan="3"><center><b>Bluelight</b></center></td></tr></thead>
						<tbody>
							<tr>
								<td><img src="{{url('assets/ctrlImages/car-button/police_led@2x.png')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/lights@2x.png')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/Sound_led@2x.png')}}"></td>
							</tr>
							<tr>
								<td><img src="{{url('assets/ctrlImages/car-button/left_arrow@2x.png')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/full_beam@2x.png')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/right_arrow@2x.png')}}"></td>
							</tr>
							<tr>
								<td><img src="{{url('assets/ctrlImages/car-button/gray_revearse@2x.png')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/menu@2x.png')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/horn@2x.png')}}"></td>
							</tr>
						</tbody>
						<tfoot><tr><td colspan="3"><center><input type="checkbox" name="car_button[]" value="bluelight" <?php echo (in_array('bluelight',$car_button)) ? 'checked':''; ?>></center></td></tr></tfoot>
					</table>
					
				</div>
				<div class="col-md-2">
					<table class="table3">
						<thead><tr><td colspan="3"><center><b>Race</b></center></td></tr></thead>
						<tbody>
							<tr>
								<td><img src="{{url('assets/ctrlImages/car-button/Race_car@2x.png')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/lights@2x.png')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/Race_car@2x.png')}}"></td>
							</tr>
							<tr>
								<td><img src="{{url('assets/ctrlImages/car-button/Race_left_car@2x.png')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/race_penalty_car@2x.png')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/Race_left_car@2x.png')}}"></td>
							</tr>
							<tr>
								<td><img src="{{url('assets/ctrlImages/car-button/gray_revearse@2x.png')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/menu@2x.png')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/horn@2x.png')}}"></td>
							</tr>
						</tbody>
						<tfoot><tr><td colspan="3"><center><input type="checkbox" name="car_button[]" value="race" <?php echo (in_array('race',$car_button)) ? 'checked':''; ?>></center></td></tr></tfoot>
					</table>
					
				</div>
				<div class="col-md-2">
					<table class="table4">
						<thead><tr><td colspan="3"><center><b>Trailer connect</b></center></td></tr></thead>
						<tbody>
							<tr>
								<td><img src="{{url('assets/ctrlImages/car-button/left_search_led@2x.png')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/trailer_connect_up@2x.png')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/right_search_led@2x.png')}}"></td>
							</tr>
							<tr>
								<td><img src="{{url('assets/ctrlImages/car-button/trailer_connect_left@2x.png')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/trailer_connect_centre@2x.png')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/trailer_connect_right@2x.png')}}"></td>
							</tr>
							<tr>
								<td><img src="{{url('assets/ctrlImages/car-button/gray_revearse@2x.png')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/menu@2x.png')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/red_police@2x.png')}}"></td>
							</tr>
						</tbody>
						<tfoot><tr><td colspan="3"><center><input type="checkbox"  name="car_button[]" value="trailer connect" <?php echo (in_array('trailer connect',$car_button)) ? 'checked':''; ?>></center></td></tr></tfoot>
					</table>
					
				</div>
				<div class="col-md-2">
					<table class="table5">
					<thead><tr><td colspan="3"><center><b>Motor contoller</b></center></td></tr></thead>
					<tbody>
						<tr>
							<td><img src="{{url('assets/ctrlImages/car-button/motor_right_turn@2x.png')}}"></td>
							<td><img src="{{url('assets/ctrlImages/car-button/motor_down_beam@2x.png')}}"></td>
							<td><img src="{{url('assets/ctrlImages/car-button/motor_right_turn@2x.png')}}"></td>
						</tr>
						<tr>
							<td><img src="{{url('assets/ctrlImages/car-button/motor_left_turn@2x.png')}}"></td>
							<td><img src="{{url('assets/ctrlImages/car-button/motor_down_beam@2x.png')}}"></td>
							<td><img src="{{url('assets/ctrlImages/car-button/motor_left_turn@2x.png')}}"></td>
						</tr>
						<tr>
							<td><img src="{{url('assets/ctrlImages/car-button/gray_revearse@2x.png')}}"></td>
							<td><img src="{{url('assets/ctrlImages/car-button/menu@2x.png')}}"></td>
							<td><img src="{{url('assets/ctrlImages/car-button/red_police@2x.png')}}"></td>
						</tr>
					</tbody>	
					<tfoot><tr><td colspan="3"><center><input type="checkbox"  name="car_button[]" value="motor contoller" <?php echo (in_array('motor contoller',$car_button)) ? 'checked':''; ?>></center></td></tr></tfoot>
					</table>
					
				</div>
			</div>
			
			<p><h5>Train {{ $page_info['page_title'] }}</h5></p>
			<div class="row">
				<div class="col-md-2">
					<table class="table1">
						<thead><tr><td colspan="3"><center><b>Default</b></center></td></tr></thead>
						<tbody>
							<tr>
								<td><img src="{{url('assets/ctrlImages/car-button/railSound@2px.jpeg')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/lights@2x.png')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/zoom_speed@2x.png')}}"></td>
							</tr>
							<tr>
								<td><img src="{{url('assets/ctrlImages/car-button/Sound@2x.png')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/full_beam@2x.png')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/edit_speed@2x.png')}}"></td>
							</tr>
							<tr>
								<td><img src="{{url('assets/ctrlImages/car-button/horn@2x.png')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/menu@2x.png')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/straight_reverse@2x.png')}}"></td>
								
							</tr>
						</tbody>
						<tfoot><tr><td colspan="3"><center><input type="checkbox" name="train_button[]" value="default" <?php echo (in_array('default',$train_button)) ? 'checked':''; ?>></center></td></tr></tfoot>
					</table>
					
				</div>
				
				<div class="col-md-2">
					<table class="table2">
						<thead><tr><td colspan="3"><center><b>Shunting</b></center></td></tr></thead>
						<tbody>
							<tr>
								<td><img src="{{url('assets/ctrlImages/car-button/empty1@x.png')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/empty1@x.png')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/empty1@x.png')}}"></td>
							</tr>
							<tr>
								<td><img src="{{url('assets/ctrlImages/car-button/empty1@x.png')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/empty1@x.png')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/empty1@x.png')}}"></td>
							</tr>
							<tr>
								<td><img src="{{url('assets/ctrlImages/car-button/horn@2x.png')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/menu@2x.png')}}"></td>
								<td><img src="{{url('assets/ctrlImages/car-button/straight_reverse@2x.png')}}"></td>
							</tr>
						</tbody>
						<tfoot><tr><td colspan="3"><center><input type="checkbox" name="train_button[]" value="shunting" <?php echo (in_array('shunting',$train_button)) ? 'checked':''; ?>></center></td></tr></tfoot>
					</table>
					
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
		
		// pad2_image
		// imgInp
		$(document).ready(function(){
			function readURL(input,id) {
			  if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e) {
				  $('#'+id).attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]); // convert to base64 string
			  }
			}
			// pad2_image logo_image  icone_image pad3_image
			$("#pad2_image").change(function() {
			  readURL(this,'pad2_image_image');
			});
			$("#logo_image").change(function() {
			  readURL(this,'logo_image_image');
			});
			$("#icone_image").change(function() {
			  readURL(this,'icone_image_image');
			});
			$("#pad3_image").change(function() {
			  readURL(this,'pad3_image_image');
			});
	});
</script>	

@if(session()->has('flash-message'))
  <script>
    jQuery(document).ready(function () {
      $.toaster({ priority : 'success', title : 'Success', message : "{{ session()->get('flash-message') }}" });
    });
  </script>
@endif
@endsection
