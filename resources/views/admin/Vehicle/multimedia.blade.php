@extends('layouts.appadmin')

@section('content')
	<style>
		.led-config { margin-left: 66%;}
		label { margin-bottom: .5rem; }
			/* Create two equal columns that floats next to each other */
		.column { float: left; width: 50%; padding: 10px;}
			/* Clear floats after the columns */
		.row:after { content: ""; display: table; clear: both; }
		.form-control { width: 50% !important; }
		.pad3_image_image {width: 338px; height: 113px;}
		.icone_image_image {width: 55px; height:58px; margin-left: 25px;}
		.logo_image_image {width: 37.5px; height:55px;}
		.pad2_image_image {width: 225px; height:225px}
		
		 
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
						<a href="{{ url(user_role('settings'.$setting_id)) }}" class="btn btn-secondary addvehicle-settings">Settings</a>
						<a href="{{ url(user_role('create-new-car?vehicle_id='.$_GET['vehicle_id'])) }}" class="btn btn-secondary addvehicle-led-config">LED config</a>
						<a href="{{ url(user_role('car-button?vehicle_id='.$_GET['vehicle_id'])) }}" class="btn btn-secondary">Button config</a>
						<a href="{{ url(user_role('multimedia?vehicle_id='.$_GET['vehicle_id'])) }}" class="btn btn-secondary">Multimedia</a>
					<?php }else{ ?>
						<a href="javascript:void(0)" class="btn btn-secondary addvehicle-vehicle_info empty">Vehicle info</a>
						<a href="javascript:void(0)" class="btn btn-secondary addvehicle-settings empty">Settings</a>
						<a href="javascript:void(0)" class="btn btn-secondary addvehicle-led-config empty">LED config</a>
						<a href="javascript:void(0)" class="btn btn-secondary addvehicle-Button-config">Button config</a>
						<a href="javascript:void(0)" class="btn btn-secondary addvehicle-Button-config">Multimedia</a>
					<?php } ?>
				</div>
			</div>
			
		<div class="modal-body">
			<div class="row">
				<div class="column">
					<div class="col-md-12">
							<div class="form-group">
								<label>Pad2 image (450×450 px)</label>
								<input type="file" class="form-control" name="pad2_image" id="pad2_image">
							</div>
							<div class="form-group">
								<label>Logo image (???×??? px)</label>
								<input type="file" class="form-control" name="logo_image" id="logo_image">
							</div>
							<div class="form-group">
								<label>Icon image (???×??? px)</label>
								<input type="file" class="form-control" name="icone_image" id="icone_image">
							</div>
							<div class="form-group">
								<label>Pad3 image (776×226 px)</label>
								<input type="file" class="form-control" name="pad3_image" id="pad3_image">
							</div>
							<div class="form-group">
								<label>Start engine sound</label>
								<input type="file" class="form-control" name="start_engine_sound" id="start_engine_sound">
							</div>
							<div class="form-group">
								<label>Idle motor sound</label>
								<input type="file" class="form-control" name="idle_motor_sound" id="idle_motor_sound">
							</div>
							<div class="form-group">
								<label>Acceleration sound</label>
								<input type="file" class="form-control" name="acceleration_sound" id="acceleration_sound">
							</div>
							<div class="form-group">
								<label>Deceleration sound</label>
								<input type="file" class="form-control" name="deceleration_sound" id="deceleration_sound">
							</div>
							<div class="form-group">
								<label>Gear shift sound 1</label>
								<input type="file" class="form-control" name="gear_shift_sound_1" id="gear_shift_sound_1">
							</div>
							<div class="form-group">
								<label>Gear shift sound 2</label>
								<input type="file" class="form-control" name="gear_shift_sound_2" id="gear_shift_sound_2">
							</div>
							<div class="form-group">
								<label>Shut off sound</label>
								<input type="file" class="form-control" name="shut_off_sound" id="shut_off_sound">
							</div>
							<div class="form-group">
								<label>Blinkers sound</label>
								<input type="file" class="form-control" name="blinkers_sound" id="blinkers_sound">
							</div>
					</div>
				</div>
				
				<div class="column">
					<div class="col-md-12">
							<div class="form-group">
								<img class="pad2_image_image" id="pad2_image_image" src="{{url('public/'.$userForm['pad2_image'])}}" alt="your image" />
							</div>
							<div class="form-group">
								<img class="logo_image_image" id="logo_image_image" src="{{url('public/'.$userForm['logo_image'])}}" alt="your image" />
								<img class="icone_image_image" id="icone_image_image" src="{{url('public/'.$userForm['icone_image'])}}" alt="your image" />
							</div>
							<div class="form-group">
								<img class="pad3_image_image" id="pad3_image_image" src="{{url('public/'.$userForm['pad3_image'])}}" alt="your image" />
							</div>
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
