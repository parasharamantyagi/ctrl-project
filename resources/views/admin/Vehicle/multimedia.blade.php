@extends('layouts.appadmin')

@section('content')
	<style>
		.led-config { margin-left: 66%;}
		label { margin-bottom: .5rem; }
			/* Create two equal columns that floats next to each other */
		.column { float: left; width: 50%; padding: 10px;}
			/* Clear floats after the columns */
		.row:after { content: ""; display: table; clear: both; }
		.form-control { width: 65% !important; }
		
		.div_logo_image_image_130 { border: 2px solid #a4acb3; }
		.logo_image_image {width: 100%; height: 100%;}
		.div_logo_image_image {padding: 10px; margin: 10px; max-width: 117px; height: 51.5px; background-color: black;}
		
		.div_icone_image_image_130 { width: 130px; height: 148px; border: 2px solid #a4acb3;}
		.icone_image_image {width: 100%; height: 100%;}
		.div_icone_image_image {padding: 10px; max-width: 117px; height: 123.4px; margin: 10px; background-color: black;}
		
		
		.pad3_image_image {width: 338px; height: 113px;}
		.div_pad3_image_image { border: 2px solid #a4acb3; padding: 7px; width: 357px; height: 131px; }
		.pad2_image_image {width: 225px; height:225px}
		.div_pad2_image_image { border: 2px solid #a4acb3; padding: 10px; width: 252px; height: 247px; }
		
		.form-border {border: 0.1px solid; border-radius: 0.25rem; padding: 2px;}
		textarea.form-control {border: 0.1px solid;}
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
								<label>Logo image (max 130x75 px, left aligned)</label><br>
								<div class="form-border">
								<input type="button" class="btn btn-light" data-id="logo_image" value="Choose File" /> <span id="p_logo_image">{{$userForm['p_logo_image']}}</span>
								<input type="file" class="form-control" name="logo_image" id="logo_image" style="display: none">
								</div>
							</div>
							<div class="form-group">
								<label>Icon image (130x148 px)</label><br>
								<div class="form-border">
								<input type="button" class="btn btn-light" data-id="icone_image" value="Choose File" /> <span id="p_icone_image">{{$userForm['p_icone_image']}}</span>
								<input type="file" class="form-control" name="icone_image" id="icone_image" style="display: none">
								</div>
							</div>
							<div class="form-group">
								<label>Pad2 image (450×450 px)</label><br>
								<div class="form-border">
								<input type="button" class="btn btn-light" data-id="pad2_image" value="Choose File" /> <span id="p_pad2_image">{{$userForm['p_pad2_image']}}</span>
								<input type="file" class="form-control" name="pad2_image" id="pad2_image" style="display: none">
								</div>
							</div>
							<div class="form-group">
								<label>Pad3 image (776×226 px)</label><br>
								<div class="form-border">
								<input type="button" class="btn btn-light" data-id="pad3_image" value="Choose File" /> <span id="p_pad3_image">{{$userForm['p_pad3_image']}}</span>
								<input type="file" class="form-control" name="pad3_image" id="pad3_image" style="display: none">
								</div>
							</div>
							<div class="form-group">
								<label>Full screen movie links(separated with "?")</label>
								<textarea class="form-control" name="full_screen_movie_links" id="full_screen_movie_links">{{$userForm['full_screen_movie_links']}}</textarea>
							</div>
							<div class="form-group">
								<label>Start engine sound</label><br>
								<div class="form-border">
								<input type="button" class="btn btn-light" data-id="start_engine_sound" value="Choose File" /> <span id="p_start_engine_sound">{{$userForm['p_start_engine_sound']}}</span>
								<input type="file" class="form-control" name="start_engine_sound" id="start_engine_sound" style="display: none">
								</div>
							</div>
							<div class="form-group">
								<label>Idle motor sound</label><br>
								<div class="form-border">
								<input type="button" class="btn btn-light" data-id="idle_motor_sound" value="Choose File" /> <span id="p_idle_motor_sound">{{$userForm['p_idle_motor_sound']}}</span>
								<input type="file" class="form-control" name="idle_motor_sound" id="idle_motor_sound" style="display: none">
								</div>
							</div>
							<div class="form-group">
								<label>Acceleration sound</label><br>
								<div class="form-border">
								<input type="button" class="btn btn-light" data-id="acceleration_sound" value="Choose File" /> <span id="p_acceleration_sound">{{$userForm['p_acceleration_sound']}}</span>
								<input type="file" class="form-control" name="acceleration_sound" id="acceleration_sound" style="display: none">
								</div>
							</div>
							<div class="form-group">
								<label>Deceleration sound</label><br>
								<div class="form-border">
								<input type="button" class="btn btn-light" data-id="deceleration_sound" value="Choose File" /> <span id="p_deceleration_sound">{{$userForm['p_deceleration_sound']}}</span>
								<input type="file" class="form-control" name="deceleration_sound" id="deceleration_sound" style="display: none">
								</div>
							</div>
							<div class="form-group">
								<label>Gear shift sound 1</label><br>
								<div class="form-border">
								<input type="button" class="btn btn-light" data-id="gear_shift_sound_1" value="Choose File" /> <span id="p_gear_shift_sound_1">{{$userForm['p_gear_shift_sound_1']}}</span>
								<input type="file" class="form-control" name="gear_shift_sound_1" id="gear_shift_sound_1" style="display: none">
								</div>
							</div>
							<div class="form-group">
								<label>Gear shift sound 2</label><br>
								<div class="form-border">
								<input type="button" class="btn btn-light" data-id="gear_shift_sound_2" value="Choose File" /> <span id="p_gear_shift_sound_2">{{$userForm['p_gear_shift_sound_2']}}</span>
								<input type="file" class="form-control" name="gear_shift_sound_2" id="gear_shift_sound_2" style="display: none">
								</div>
							</div>
							<div class="form-group">
								<label>Shut off sound</label><br>
								<div class="form-border">
								<input type="button" class="btn btn-light" data-id="shut_off_sound" value="Choose File" /> <span id="p_shut_off_sound">{{$userForm['p_shut_off_sound']}}</span>
								<input type="file" class="form-control" name="shut_off_sound" id="shut_off_sound" style="display: none">
								</div>
							</div>
							<div class="form-group">
								<label>Blinkers sound</label><br>
								<div class="form-border">
								<input type="button" class="btn btn-light" data-id="blinkers_sound" value="Choose File" /> <span id="p_blinkers_sound">{{$userForm['p_blinkers_sound']}}</span>
								<input type="file" class="form-control" name="blinkers_sound" id="blinkers_sound" style="display: none">
								</div>
							</div>
							<div class="form-group">
								<label>Horn sound</label><br>
								<div class="form-border">
								<input type="button" class="btn btn-light" data-id="horn_sound" value="Choose File" /> <span id="p_horn_sound">{{$userForm['p_horn_sound']}}</span>
								<input type="file" class="form-control" name="horn_sound" id="horn_sound" style="display: none">
								</div>
							</div>
					</div>
				</div>
				
				<div class="column">
					<div class="col-md-12">
							<div class="form-group">
								<div class="row">
									<div class="column col-md-4">
										<div class="div_logo_image_image_130">
											<center>
											<div class="div_logo_image_image" style="max-width: {{$userForm['logo_image_size'][0]}}px; height: {{$userForm['logo_image_size'][1]}}px;">
												<img class="logo_image_image" id="logo_image_image" src="{{url($userForm['logo_image'])}}" alt="your image" />
											</div>
											</center>
										</div>
									</div>
									<div class="column col-md-2">
										<div class="div_icone_image_image_130">
											<center>
											<div class="div_icone_image_image">
												<img class="icone_image_image" id="icone_image_image" src="{{url($userForm['icone_image'])}}" alt="your image" />
											</div>
											</center>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="div_pad3_image_image">
									<img class="pad3_image_image" id="pad3_image_image" src="{{url($userForm['pad3_image'])}}" alt="your image" />
								</div>
							</div>
							<div class="form-group">
								<div class="div_pad2_image_image">
									<img class="pad2_image_image" id="pad2_image_image" src="{{url($userForm['pad2_image'])}}" alt="your image" />
								</div>
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
			
			function readNAME(input,id) {
			  if (input.files && input.files[0]) {
				  $("span[id='p_"+id+"']").text(input.files[0].name);
			  }
			}
			
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
			// 
			  // readNAME(this,'logo_image');
			
			var image_id = ['pad2_image','logo_image','icone_image','pad3_image'];
			
											// <input type="file" class="form-control" name="icone_image" 
			 $('input[type="file"]').change(function() {
				if(image_id.includes(this.name)){
					readURL(this,this.name+'_image');
				}
				readNAME(this,this.id);
			 });
			// $("#pad2_image").change(function() {
			  // readURL(this,'pad2_image_image');
			// });
			// $("#logo_image").change(function() {
			  
			  // readURL(this,'logo_image_image');
			// });
			// $("#icone_image").change(function() {
			  // readURL(this,'icone_image_image');
			// });
			// $("#pad3_image").change(function() {
			  // readURL(this,'pad3_image_image');
			// });
			
			$("input[class='btn btn-light']").click(function() {
				$("input[id='"+$(this).data('id')+"']").click();
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
