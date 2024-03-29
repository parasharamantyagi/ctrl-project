@extends('layouts.appadmin')

@section('content')
	<style>
		.led-config {
			margin-left: 66%;
		}
		label {
			margin-bottom: .5rem;
		}
		// .modal-header .close {
			// padding: 1rem 0rem;
			// margin: -1rem -5rem -1rem auto;
		// }
	</style>
	<div class="page-content-wrap">
                    <!-- START ALERT BLOCKS -->
	
	
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h4>Vehicles clone</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			
		  </div>
		  <div class="modal-body">
					<input type="text" class="model-form-control" name="brand" value="" placeholder="Enter art No" id="brand" required="">
					<div id="select_vehicle_data"></div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-primary ok-popup">Ok</button>
		  </div>
		</div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
                        
<!-- END ALERT BLOCKS -->                    	
		<form method="POST" action="{{ url($formaction) }}" id="Updateuser" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="modal-header">
				<h5>{{ $page_info['page_title'] }}</h5>
				<div class="header-link">
				<!-- input type="button" class="btn btn-secondary" onclick="form_return()" value="Back" -->
				
					<?php if(isset($_GET['vehicle_id'])) { ?>
						<a href="javascript:void(0)" class="btn btn-secondary clone-vehicle">Clone</a>
						<a href="{{ url(user_role('vehicle-view/'.$_GET['vehicle_id'])) }}" class="btn btn-secondary addvehicle-vehicle_info">Vehicle info</a>
						<a href="{{ url(user_role('settings?vehicle_id='.$_GET['vehicle_id'])) }}" class="btn btn-secondary addvehicle-settings">Settings</a>
						<a href="{{ url(user_role('create-new-car?vehicle_id='.$_GET['vehicle_id'])) }}" class="btn btn-secondary addvehicle-led-config">LED config</a>
						<a href="{{ url(user_role('car-button?vehicle_id='.$_GET['vehicle_id'])) }}" class="btn btn-secondary">Button config</a>
						<a href="{{ url(user_role('multimedia?vehicle_id='.$_GET['vehicle_id'])) }}" class="btn btn-secondary">Multimedia</a>
						<a href="{{ url(user_role('led-motor-config?vehicle_id='.$_GET['vehicle_id'])) }}" class="btn btn-secondary">Motor config</a>
						<a href="{{ url(user_role('upload-map?vehicle_id='.$_GET['vehicle_id'])) }}" class="btn btn-secondary">Map</a>
					<?php }else if($page_info['page_title'] == 'Edit Vehicle') { ?>
						<a href="javascript:void(0)" class="btn btn-secondary addvehicle-settings save">Save</a>
						<a href="{{ url(user_role('vehicle-view/'.Request::segment(3))) }}" class="btn btn-secondary addvehicle-settings">Vehicle info</a>
						<a href="{{ url(user_role('settings/'.$settign_id)) }}" class="btn btn-secondary addvehicle-settings">Settings</a>
						<a href="{{ url(user_role('create-new-car?vehicle_id='.Request::segment(3))) }}" class="btn btn-secondary addvehicle-led-config">LED config</a>
						<a href="{{ url(user_role('car-button?vehicle_id='.Request::segment(3))) }}" class="btn btn-secondary">Button config</a>
						<a href="{{ url(user_role('multimedia?vehicle_id='.Request::segment(3))) }}" class="btn btn-secondary">Multimedia</a>
						<a href="{{ url(user_role('led-motor-config?vehicle_id='.Request::segment(3))) }}" class="btn btn-secondary">Motor config</a>
						<a href="{{ url(user_role('upload-map?vehicle_id='.Request::segment(3))) }}" class="btn btn-secondary">Map</a>
					<?php }else if($page_info['page_title'] == 'Vehicle information'){ ?>
							<a href="{{ url(user_role('vehicle/'.Request::segment(3))) }}" class="btn btn-secondary addvehicle-settings">Edit</a>
							<a href="{{ url(user_role('vehicle-view/'.Request::segment(3))) }}" class="btn btn-secondary addvehicle-settings">Vehicle info</a>
							<a href="{{ url(user_role('settings/'.$settign_id)) }}" class="btn btn-secondary addvehicle-settings">Settings</a>
							<a href="{{ url(user_role('create-new-car?vehicle_id='.Request::segment(3))) }}" class="btn btn-secondary addvehicle-led-config">LED config</a>
							<a href="{{ url(user_role('car-button?vehicle_id='.Request::segment(3))) }}" class="btn btn-secondary">Button config</a>
							<a href="{{ url(user_role('multimedia?vehicle_id='.Request::segment(3))) }}" class="btn btn-secondary">Multimedia</a>
							<a href="{{ url(user_role('led-motor-config?vehicle_id='.Request::segment(3))) }}" class="btn btn-secondary">Motor config</a>
							<a href="{{ url(user_role('upload-map?vehicle_id='.Request::segment(3))) }}" class="btn btn-secondary">Map</a>
					<?php }else{ ?>
						<a href="javascript:void(0)" class="btn btn-secondary clone-vehicle">Clone</a>
						<a href="javascript:void(0)" class="btn btn-secondary addvehicle-vehicle_info empty">Vehicle info</a>
						<a href="javascript:void(0)" class="btn btn-secondary addvehicle-settings empty">Settings</a>
						<a href="javascript:void(0)" class="btn btn-secondary addvehicle-led-config empty">LED config</a>
						<a href="javascript:void(0)" class="btn btn-secondary addvehicle-Button-config">Button config</a>
						<a href="javascript:void(0)" class="btn btn-secondary addvehicle-Button-config">Multimedia</a>
						<a href="javascript:void(0)" class="btn btn-secondary addvehicle-Button-config">Motor config</a>
						<a href="javascript:void(0)" class="btn btn-secondary addvehicle-Button-config">Map</a>
					<?php } ?>
					
				</div>
			</div>
			
		  
			<input type="hidden" name="id" value="{{$userForm->id}}" id="id">
		<div class="modal-body">
			<div class="row">
			<div class="col-md-12">
					<div class="form-group">
						<label>Brand *</label><br>
						<!-- input type="text" class="form-control" name="brand" value="{{$userForm->brand}}" placeholder="Brand" id="brand" required="" -->
						<select class="form-control selectpickerss" data-size="5" data-live-search="true" name="brand" id="brand" required="">
							  <option value="" selected disabled>Brand</option>
							  @foreach($carBrand as $carBrand)
								  <option value="{{$carBrand->brand_name}}" <?= ($userForm->brand == $carBrand->brand_name) ? 'selected':''; ?>>{{$carBrand->brand_name}}</option>
							  @endForeach;
						</select>
						
					</div>
					<div class="form-group">
						<label>Model *</label>
						<input type="text" class="form-control" name="model" value="{{$userForm->model}}" id="model" required="">
					</div>
					<div class="form-group">
						<label>Model specification</label>
						<input type="text" class="form-control" name="model_spec" value="{{$userForm->model_spec}}" id="model_spec">
					</div>
					<div class="form-group">
						<label>Car quote</label>
						<input type="text" class="form-control" name="car_quote" value="{{$userForm->car_quote}}" id="car_quote">
					</div>
					<div class="form-group">
						<label>Release year *</label>
						<select class="form-control" name="release_year" id="release_year" required="">
						  <option value="">Release Year</option>
						  @foreach(ctrl_year() as $year)
							  <option value="{{$year}}" <?php echo ($userForm->release_year == $year) ? 'selected' : ''; ?>>{{$year}}</option>
						  @endForeach;
						</select>
					</div>
					<div class="form-group">
						<label>Art No *</label>
						<input type="text" class="form-control" name="art_no" value="{{$userForm->art_no}}" id="art_no" required="">
					</div>
					<div class="form-group">
						<label>License plate</label>
						<input type="text" class="form-control" name="license_plate" value="{{$userForm->license_plate}}" id="license_plate">
					</div>
					<div class="form-group">
						<label>Engine type</label>
						<select class="form-control" name="moter_type" id="moter_type">
							  <option value="" selected disabled>Select engine</option>
							  <option value="Fossil fuel" <?php echo ($userForm->moter_type == 'Fossil fuel') ? 'selected':''; ?>>Fossil fuel</option>
							  <option value="Electric" <?php echo ($userForm->moter_type == 'Electric') ? 'selected':''; ?>>Electric</option>
							  <option value="Hydrogen" <?php echo ($userForm->moter_type == 'Hydrogen') ? 'selected':''; ?>>Hydrogen</option>
							  <option value="Hybrid" <?php echo ($userForm->moter_type == 'Hybrid') ? 'selected':''; ?>>Hybrid</option>
						</select>
					</div>
					<div class="form-group">
						<label>Horsepower</label>
						<input type="text" class="form-control numeric-val" name="horse_power" value="{{$userForm->horse_power}}" id="horse_power">
					</div>
					<div class="form-group">
						<label>Torque</label>
						<input type="text" class="form-control" name="torque" value="{{$userForm->torque}}" id="torque">
					</div>
					<div class="form-group">
						<label>0-100 km/h, in seconds</label>
						<input type="text" class="form-control numeric-val" name="km_h_0_100" value="{{$userForm->km_h_0_100}}" id="km_h_0_100">
					</div>
					<div class="form-group">
						<label>0-160 km/h, in seconds</label>
						<input type="text" class="form-control numeric-val" name="km_h_0_160" value="{{$userForm->km_h_0_160}}" id="km_h_0_160">
					</div>
					<!-- div class="form-group">
						<label>100-0 km/h, in seconds</label>
						<input type="text" class="form-control numeric-val" name="km_h_100_0" value="{{$userForm->km_h_100_0}}" id="km_h_100_0">
					</div -->
					
					<div class="form-group">
						<label>Deceleration speed (km/h)</label>
						<input type="text" class="form-control numeric-val" name="deceleration_speed" value="{{$userForm->deceleration_speed}}" id="deceleration_speed">
					</div>
					<div class="form-group"> 
						<label>Distance (m)</label>
						<input type="text" class="form-control numeric-val" name="distance" value="{{$userForm->distance}}" id="distance">
					</div>
					
					<div class="form-group">
						<label>Weight, kg</label>
						<input type="text" class="form-control numeric-val" name="weight" value="{{$userForm->weight}}" id="weight">
					</div>
					<div class="form-group">
						<label>Max weight, in kg</label>
						<input type="text" class="form-control numeric-val" name="max_weight" value="{{$userForm->max_weight}}" id="max_weight">
						<div id="publisherEmailValidation"></div>
					</div>
					<div class="form-group">
						<label>Gearbox amount of gears</label>
						<input type="text" class="form-control numeric-val" maxlength="1" min="4" max="8" name="gearbox_amount_of_gears" value="{{(int)$userForm->gearbox_amount_of_gears}}" id="gearbox_amount_of_gears">
					</div>
					<div class="form-group">
						<label>Max speed per gear</label>
					</div>
					<div class="form-group row margin-max-speed max-speed">
					<?php if(count(explode(',',$userForm->max_speed_per_gears)) > 3) { ?>
					@foreach(explode(',',$userForm->max_speed_per_gears) as $key => $max_speed_per_gear)
							<input type="text" class="form-control numeric-val box-1" name="max_speed_per_gears[]" value="{{$max_speed_per_gear}}" id="max_speed_per_gears{{$key}}">
					@endForeach
					<?php }else{ ?>
							<input type="text" class="form-control numeric-val box-1" name="max_speed_per_gears[]" value="" id="max_speed_per_gears0">
							<input type="text" class="form-control numeric-val box-1" name="max_speed_per_gears[]" value="" id="max_speed_per_gears1">
							<input type="text" class="form-control numeric-val box-1" name="max_speed_per_gears[]" value="" id="max_speed_per_gears2">
							<input type="text" class="form-control numeric-val box-1" name="max_speed_per_gears[]" value="" id="max_speed_per_gears3">
					<?php } ?>
					</div>
					
					<div class="form-group">
						<label>Transmission ratios</label>
					</div>
					<div class="form-group row margin-max-speed transmission-ratios">
						<?php if(count(explode(',',$userForm->transmission_ratios)) > 3) { ?>
						@foreach(explode(',',$userForm->transmission_ratios) as $key => $transmission_ratios)
							<input type="text" class="form-control numeric-val box-1" name="transmission_ratios[]" value="{{$transmission_ratios}}" id="transmission_ratios{{$key}}">
						@endForeach
						<?php }else{ ?>
							<input type="text" class="form-control numeric-val box-1" name="transmission_ratios[]" value="" id="transmission_ratios0">
							<input type="text" class="form-control numeric-val box-1" name="transmission_ratios[]" value="" id="transmission_ratios1">
							<input type="text" class="form-control numeric-val box-1" name="transmission_ratios[]" value="" id="transmission_ratios2">
							<input type="text" class="form-control numeric-val box-1" name="transmission_ratios[]" value="" id="transmission_ratios3">
						<?php } ?>
					</div>
					<div class="form-group">
						<label>Reverse max speed</label>
						<input type="text" class="form-control numeric-val" name="reverse_gear_ratio" value="{{(int)$userForm->reverse_gear_ratio}}" id="reverse_gear_ratio">
					</div>
					<div class="form-group">
						<label>Top speed</label>
						<input type="text" class="form-control numeric-val" name="top_speed" value="{{(int)$userForm->top_speed}}" id="top_speed">
					</div>
					<div class="form-group">
						<label>Max rpm</label>
						<input type="text" class="form-control numeric-val" name="max_rpm" value="{{(int)$userForm->max_rpm}}" id="max_rpm">
					</div>
					<div class="form-group">
						<label>Idle rpm</label>
						<input type="text" class="form-control numeric-val" name="idle_rpm" value="{{(int)$userForm->idle_rpm}}" id="idle_rpm">
					</div>
					<div class="form-group">
						<label>Manufacturer</label>
						<select class="form-control" name="manufacturer" id="manufacturer">
							  <option value="" selected disabled>Select manufacturer</option>
							  <option value="AWM" <?php echo ($userForm->manufacturer == 'AWM') ? 'selected':''; ?>>AWM</option>
							  <option value="Bburago" <?php echo ($userForm->manufacturer == 'Bburago') ? 'selected':''; ?>>Bburago</option>
							  <option value="Brekina" <?php echo ($userForm->manufacturer == 'Brekina') ? 'selected':''; ?>>Brekina</option>
							  <option value="Busch" <?php echo ($userForm->manufacturer == 'Busch') ? 'selected':''; ?>>Busch</option>
							  <option value="Herpa" <?php echo ($userForm->manufacturer == 'Herpa') ? 'selected':''; ?>>Herpa</option>
							  <option value="Kibri" <?php echo ($userForm->manufacturer == 'Kibri') ? 'selected':''; ?>>Kibri</option>
							  <option value="Märklin" <?php echo ($userForm->manufacturer == 'Märklin') ? 'selected':''; ?>>Märklin</option>
							  <option value="Minichamps" <?php echo ($userForm->manufacturer == 'Minichamps') ? 'selected':''; ?>>Minichamps</option>
							  <option value="Ricko" <?php echo ($userForm->manufacturer == 'Ricko') ? 'selected':''; ?>>Ricko</option>
							  <option value="Rietze" <?php echo ($userForm->manufacturer == 'Rietze') ? 'selected':''; ?>>Rietze</option>
							  <option value="Roco" <?php echo ($userForm->manufacturer == 'Roco') ? 'selected':''; ?>>Roco</option>
							  <option value="Wiking" <?php echo ($userForm->manufacturer == 'Wiking') ? 'selected':''; ?>>Wiking</option>
						</select>
					</div>
					<div class="form-group">
						<label>Scale</label>
						<select class="form-control" name="scale" id="scale">
							<option value="" selected disabled>Select scale</option>
							<option value="1:12" <?php echo ($userForm->scale == '1:12') ? 'selected':''; ?>>1:12</option>
							<option value="1:24" <?php echo ($userForm->scale == '1:24') ? 'selected':''; ?>>1:24</option>
							<option value="1:43" <?php echo ($userForm->scale == '1:43') ? 'selected':''; ?>>1:43</option>
							<option value="1:50" <?php echo ($userForm->scale == '1:50') ? 'selected':''; ?>>1:50</option>
							<option value="1:64" <?php echo ($userForm->scale == '1:64') ? 'selected':''; ?>>1:64</option>
							<option value="1:72" <?php echo ($userForm->scale == '1:72') ? 'selected':''; ?>>1:72</option>
							<option value="1:76" <?php echo ($userForm->scale == '1:76') ? 'selected':''; ?>>1:76</option>
							<option value="1:87" <?php echo ($userForm->scale == '1:87') ? 'selected':''; ?>>1:87</option>
						</select>
					</div>
					<div class="form-group">
						<label>Vehicle type</label>
						<select class="form-control" name="vehicle_type" id="vehicle_type">
							<option value="" selected disabled>Select vehicle</option>
							<option value="car" <?php echo ($userForm->vehicle_type == 'car') ? 'selected':''; ?>>Car</option>
							<option value="light_truck" <?php echo ($userForm->vehicle_type == 'light_truck') ? 'selected':''; ?>>Light truck</option>
							<option value="heavy_truck" <?php echo ($userForm->vehicle_type == 'heavy_truck') ? 'selected':''; ?>>Heavy truck</option>
							<option value="trailer" <?php echo ($userForm->vehicle_type == 'trailer') ? 'selected':''; ?>>Trailer</option>
							<option value="bus" <?php echo ($userForm->vehicle_type == 'bus') ? 'selected':''; ?>>Bus</option>
							<option value="aircraft" <?php echo ($userForm->vehicle_type == 'aircraft') ? 'selected':''; ?>>Aircraft</option>
							<option value="tram" <?php echo ($userForm->vehicle_type == 'tram') ? 'selected':''; ?>>Tram</option>
							<option value="crane" <?php echo ($userForm->vehicle_type == 'crane') ? 'selected':''; ?>>Crane</option>
							<option value="electric_loco" <?php echo ($userForm->vehicle_type == 'electric_loco') ? 'selected':''; ?>>Electric loco</option>
							<option value="steam_loco" <?php echo ($userForm->vehicle_type == 'steam_loco') ? 'selected':''; ?>>Steam loco</option>
							<option value="diesel_loco" <?php echo ($userForm->vehicle_type == 'diesel_loco') ? 'selected':''; ?>>Diesel loco</option>
						</select>
					</div>
					<div class="form-group">
						<label>Special car specification</label>
						<select class="form-control" name="special_car_specialization" id="special_car_specialization">
							<option value="" selected disabled>Select vehicle</option>
							<option value="none" <?php echo ($userForm->special_car_specialization == 'none') ? 'selected':''; ?>>None</option>
							<option value="police" <?php echo ($userForm->special_car_specialization == 'police') ? 'selected':''; ?>>Police</option>
							<option value="ambulance" <?php echo ($userForm->special_car_specialization == 'ambulance') ? 'selected':''; ?>>Ambulance</option>
							<option value="fire_brigade" <?php echo ($userForm->special_car_specialization == 'fire_brigade') ? 'selected':''; ?>>Fire brigade</option>
							<option value="taxi" <?php echo ($userForm->special_car_specialization == 'taxi') ? 'selected':''; ?>>Taxi</option>
							<option value="tank_truck" <?php echo ($userForm->special_car_specialization == 'tank_truck') ? 'selected':''; ?>>Tank truck</option>
							<option value="container_carrier" <?php echo ($userForm->special_car_specialization == 'container_carrier') ? 'selected':''; ?>>Container carrier</option>
						</select>
					</div>
					<div class="form-group">
						<label>Car value</label>
						<input type="text" class="form-control numeric-val" name="car_value" value="{{$userForm->car_value}}" id="lenght">
					</div>
					<div class="form-group">
						<label>Length, mm</label>
						<input type="text" class="form-control numeric-val" name="lenght" value="{{$userForm->lenght}}" id="lenght">
					</div>
					<div class="form-group">
						<label>Length front of car to front axis, mm</label>
						<input type="text" class="form-control numeric-val" name="length_front_of_car" value="{{$userForm->length_front_of_car}}" id="length_front_of_car">
					</div>
					<div class="form-group">
						<label>Wheelbase, mm</label>
						<input type="text" class="form-control numeric-val" name="wheelbase" value="{{$userForm->wheelbase}}" id="wheelbase">
					</div>
					<div class="form-group">
						<label>Track width, mm</label>
						<input type="text" class="form-control numeric-val" name="track_width" value="{{$userForm->track_width}}" id="track_width">
					</div>
					<div class="form-group">
						<label>Width, mm</label>
						<input type="text" class="form-control numeric-val" name="width" value="{{$userForm->width}}" id="width">
					</div>
					<div class="form-group">
						<label>Wheel diameter, mm</label>
						<input type="text" class="form-control numeric-val" name="wheel_diameter" value="{{$userForm->wheel_diameter}}" id="wheel_diameter">
					</div>
					<div class="form-group">
						<label>Height, mm</label>
						<input type="text" class="form-control numeric-val" name="height" value="{{$userForm->height}}" id="height">
					</div>
			</div>


			</div>
		</div>
				<div class="modal-footer">
			@if($formaction != 'vehicleview')
				<input type="button" class="btn btn-secondary" onclick="form_return()" value="Back">
				<input type="submit" class="btn btn-primary" value="Save changes">
			@endIf
				</div>
		</form>
		
		
                    
                </div>


@endsection


@section('script')

	<script>
				$(document).ready(function(){
					$('#Updateuser').submit(function(event){
						$('#publisherEmailValidation').html('<div class="author_loading"><img src="{{ url('ctrl-icon/loder.gif') }}" height="150" width="150"></div>');
						var base_url = $('meta[name="_token"]').attr('base_url');
						 $.ajax({
						   type:this.method,
						   url: this.action,
						   contentType: false, 
						   processData:false,   
						   data: new FormData(this),
						   success:function(response)
						   {
							    var result = JSON.parse(response);
							    $('#publisherEmailValidation').html('');
								$.toaster({ priority : 'success', title : 'Success', message : result.message });
								if(result.action === 'updateVehicle')
								{
									// var base_url = "/{{ user_role('vehicle') }}"+"?setting_id="+result.insert_id;
									var base_url = "../vehicle-view/"+result.vehicle_id;
									setTimeout(function(){ window.location = base_url; }, 3000);
								}else{
									// "/{{ user_role('vehicle') }}"+
									var base_url = "?vehicle_id="+result.insert_id;
									setTimeout(function(){ window.location = base_url; }, 3000);
								}
								// $('input[type="text"]').val('');
								// $('select[class="form-control"] option:first').attr('selected', true);
								// $('a[class="btn btn-primary addvehicle-led-config"]').attr("href",$('a[class="btn btn-primary addvehicle-led-config"]').attr("href")+'?vehicle_id='+result.insert_id);
								// $('a[class="btn btn-primary addvehicle-vehicle_info"]').attr("href",$('a[class="btn btn-primary addvehicle-vehicle_info"]').attr("href")+'?vehicle_id='+result.insert_id);
								// $('a[class="btn btn-primary addvehicle-settings"]').attr("href",$('a[class="btn btn-primary addvehicle-settings"]').attr("href")+'?vehicle_id='+result.insert_id);
								// if(result.action === "storeVehicle")
										// window.location.href = "./redirect/settings?message="+result.message;
								// else
										// window.location.href = "../redirect/settings?message="+result.message;
										// $("#Updateuser").trigger("reset");
						   }
						});
						event.preventDefault();
					});
					
					$(".empty").click(function(){
						
						$.toaster({ priority : 'warning', title : 'Warning', message : 'Please add vehicle before' });
						
					});
					$(".selectpickerss").select2({
						  tags: true,
						  createTag: function (params) {
							return {
							  id: params.term,
							  text: params.term,
							  newOption: true
							}
						  },
						   templateResult: function (data) {
							var $result = $("<span></span>");

							$result.text(data.text);

							if (data.newOption) {
							  $result.append(" <em>(new)</em>");
							}

							return $result;
						  }
						});
						
					$("a[class='btn btn-secondary addvehicle-settings save']").click(function(){
						$("input[type='submit']").click();
					});
					
					$("a[class='btn btn-secondary clone-vehicle']").click(function(){
						$('#myModal').modal("show"); 
						// || $("input[name='art_no']").val() == ''
						if($('.selectpickerss').val() == '' || $("input[name='model']").val() == '' || $("input[name='release_year']").val() == '' || $("input[name='art_no']").val() == ''){
							$("input[class='model-form-control']").hide();
							$("#select_vehicle_data").html('<p class="text-danger">Please add mandatory field first</p>');
						}else{
							$("input[class='model-form-control']").show();
							$("#select_vehicle_data").html('');
						}
					});
					
					$("button[class='btn btn-primary ok-popup']").click(function(){
						var myVal = $("input[class='model-form-control']").val();
						if(myVal != null){
							$.ajax({
								url: "./get-vehicle-id/"+myVal,
								type: 'GET',
								dataType: "JSON",
								success: function (response)
								{
									// console.log(response);
									// <input type="hidden" name="id" value="{{$userForm->id}}" id="id">
									if(response.status == true) {
									$("button[class='btn btn-default']").click();	
									$("input[name='id']").val(response.data._id+'-clone');
									$("input[name='license_plate']").val(response.data.license_plate);
									$("select[name='moter_type']").val(response.data.moter_type);
									$("input[name='horse_power']").val(response.data.horse_power);
									$("input[name='torque']").val(response.data.torque);
									$("input[name='km_h_0_100']").val(response.data.km_h_0_100);
									$("input[name='km_h_0_160']").val(response.data.km_h_0_160);
									$("input[name='deceleration_speed']").val(response.data.deceleration_speed);
									$("input[name='distance']").val(response.data.distance);
									$("input[name='weight']").val(response.data.weight);
									$("input[name='max_weight']").val(response.data.max_weight);
									$("input[name='gearbox_amount_of_gears']").val(response.data.gearbox_amount_of_gears);
									
									const usingSplit = response.data.max_speed_per_gears.split(',');
									const transmission_ratios = response.data.transmission_ratios.split(',');
									$("input[name='max_speed_per_gears[]']").remove();
									let gearbox_amount_of_gear_s = '';
									for(var i = 0; i <= response.data.gearbox_amount_of_gears; i++){
										// $("input[id='max_speed_per_gears"+i+"']").val(usingSplit[i]); gearbox_amount_of_gears
										// console.log('lllllll = '+usingSplit[i]);
										if(response.data.gearbox_amount_of_gears > i && usingSplit[i] != null) {
										gearbox_amount_of_gear_s += '<input type="text" class="form-control numeric-val box-1" name="max_speed_per_gears[]" value="'+usingSplit[i]+'" id="max_speed_per_gears'+i+'">';
										// $("input[id='max_speed_per_gears3']").after(');
										}
									}
									$("div[class='form-group row margin-max-speed max-speed']").html(gearbox_amount_of_gear_s);
									
									let transmission_ratio_s = '';
									for(var j = 0; j < transmission_ratios.length; j++){
										if(response.data.gearbox_amount_of_gears > j) {
										transmission_ratio_s += '<input type="text" class="form-control numeric-val box-1" name="transmission_ratios[]" value="'+transmission_ratios[j]+'" id="transmission_ratios'+j+'">';
										// $("input[id='max_speed_per_gears3']").after(');
										}
										// $("input[id='transmission_ratios"+j+"']").val(transmission_ratios[j]);
									}
									$("div[class='form-group row margin-max-speed transmission-ratios']").html(transmission_ratio_s);
									
									$("input[name='reverse_gear_ratio']").val(response.data.reverse_gear_ratio);
									$("input[name='top_speed']").val(response.data.top_speed);
									$("input[name='max_rpm']").val(response.data.max_rpm);
									$("select[name='manufacturer']").val(response.data.manufacturer);
									$("select[name='scale']").val(response.data.scale);
									$("select[name='vehicle_type']").val(response.data.vehicle_type);
									$("select[name='special_car_specialization']").val(response.data.special_car_specialization);
									$("input[name='lenght']").val(response.data.lenght);
									$("input[name='length_front_of_car']").val(response.data.length_front_of_car);
									$("input[name='wheelbase']").val(response.data.wheelbase);
									$("input[name='track_width']").val(response.data.track_width);
									$("input[name='width']").val(response.data.width);
									$("input[name='wheel_diameter']").val(response.data.wheel_diameter);
									$("input[name='height']").val(response.data.height);
									}else{
										// $("#select_vehicle_data").show();
										// 
										// 
										$("#select_vehicle_data").html('<p class="text-danger">'+response.message+'</p>');
									}
								}
							});
						}
						// $("button[class='btn btn-default']").click();
					});
					
				});
				
				function form_return()
				{
					window.history.back();
				}
				
				
	</script>
	
	@if($formaction == 'vehicleview')
		<script>
			$(document).ready(function(){
					$(".form-control").prop("disabled", true);
					$(".form-control").css("color", "black");
			});
		</script>
	@endIf
	
@endsection
