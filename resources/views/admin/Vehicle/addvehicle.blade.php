@extends('layouts.appadmin')

@section('content')
	<style>
		.led-config {
			margin-left: 66%;
		}
		label {
			margin-bottom: .5rem;
		}
	</style>
	<div class="page-content-wrap">
                    <!-- START ALERT BLOCKS -->

	
	
                        
<!-- END ALERT BLOCKS -->                    	
		<form method="POST" action="{{ url($formaction) }}" id="Updateuser" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="modal-header">
				<h5>{{ $page_info['page_title'] }}</h5>
				<div class="header-link">
				<input type="button" class="btn btn-secondary" onclick="form_return()" value="Back">
				@if($formaction != 'vehicleview')
					<?php if(isset($_GET['vehicle_id'])) { ?>
						<a href="{{ url(user_role('create-new-car?vehicle_id='.$_GET['vehicle_id'])) }}" class="btn btn-primary addvehicle-led-config">LED config</a>
						<a href="{{ url(user_role('vehicle-view/'.$_GET['vehicle_id'])) }}" class="btn btn-primary addvehicle-vehicle_info">Vehicle info</a>
						<a href="{{ url(user_role('settings?vehicle_id='.$_GET['vehicle_id'])) }}" class="btn btn-primary addvehicle-settings">Settings</a>
					<?php }else{ ?>
						<a href="javascript:void(0)" class="btn btn-primary addvehicle-led-config empty">LED config</a>
						<a href="javascript:void(0)" class="btn btn-primary addvehicle-vehicle_info empty">Vehicle info</a>
						<a href="javascript:void(0)" class="btn btn-primary addvehicle-settings empty">Settings</a>
					<?php } ?>
				@endIf
				</div>
			</div>
			
		  
			<input type="hidden" name="id" value="{{$userForm->id}}" id="id">
		<div class="modal-body">
			<div class="row">
			<div class="col-md-12">
					<div class="form-group">
						<label>Brand</label><br>
						<!-- input type="text" class="form-control" name="brand" value="{{$userForm->brand}}" placeholder="Brand" id="brand" required="" -->
						<select class="form-control selectpickerss" data-size="5" data-live-search="true" name="brand" id="brand" required="">
							  <option value="" selected disabled>Brand</option>
							  @foreach($carBrand as $carBrand)
								  <option value="{{$carBrand->brand_name}}" <?= ($userForm->brand == $carBrand->brand_name) ? 'selected':''; ?>>{{$carBrand->brand_name}}</option>
							  @endForeach;
						</select>
						
					</div>
					<div class="form-group">
						<label>Model</label>
						<input type="text" class="form-control" name="model" value="{{$userForm->model}}" id="model" required="">
					</div>
					<div class="form-group">
						<label>Model specification</label>
						<input type="text" class="form-control" name="model_spec" value="{{$userForm->model_spec}}" id="model_spec" required="">
					</div>
					<div class="form-group">
						<label>Release year</label>
						<select class="form-control" name="release_year" id="release_year" required="">
						  <option value="">Release Year</option>
						  @foreach(ctrl_year() as $year)
							  <option value="{{$year}}" <?php echo ($userForm->release_year == $year) ? 'selected' : ''; ?>>{{$year}}</option>
						  @endForeach;
						</select>
					</div>
					<div class="form-group">
						<label>Engine type</label>
						<input type="text" class="form-control email" name="moter_type" value="{{$userForm->moter_type}}" id="moter_type">
					</div>
					<div class="form-group">
						<label>Horsepower</label>
						<input type="text" class="form-control numeric-val" name="horse_power" value="{{$userForm->horse_power}}" id="horse_power">
					</div>
					<div class="form-group">
						<label>Torque</label>
						<input type="text" class="form-control email numeric-val" name="torque" value="{{$userForm->torque}}" id="torque">
					</div>
					<div class="form-group">
						<label>0-100 km/h, in seconds</label>
						<input type="text" class="form-control numeric-val" name="km_h_0_100" value="{{$userForm->km_h_0_100}}" id="km_h_0_100">
					</div>
					<div class="form-group">
						<label>0-160 km/h, in seconds</label>
						<input type="text" class="form-control numeric-val" name="km_h_0_160" value="{{$userForm->km_h_0_160}}" id="km_h_0_160">
					</div>
					<div class="form-group">
						<label>100-0 km/h, in seconds</label>
						<input type="text" class="form-control numeric-val" name="km_h_100_0" value="{{$userForm->km_h_100_0}}" id="km_h_100_0">
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
						<label>Manufacturer</label>
						<select class="form-control" name="manufacturer" id="manufacturer">
							  <option value="" selected disabled>Select manufacturer</option>
							  <option value="AWM">AWM</option>
							  <option value="Bburago">Bburago</option>
							  <option value="Brekina">Brekina</option>
							  <option value="Busch">Busch</option>
							  <option value="Herpa">Herpa</option>
							  <option value="Kibri">Kibri</option>
							  <option value="Märklin">Märklin</option>
							  <option value="Minichamps">Minichamps</option>
							  <option value="Ricko">Ricko</option>
							  <option value="Rietze">Rietze</option>
							  <option value="Roco">Roco</option>
							  <option value="Wiking">Wiking</option>
						</select>
					</div>
					<div class="form-group">
						<label>Scale</label>
						<select class="form-control" name="scale" id="scale">
							<option value="" selected disabled>Select scale</option>
							<option value="1:12">1:12</option>
							<option value="1:24">1:24</option>
							<option value="1:43">1:43</option>
							<option value="1:50">1:50</option>
							<option value="1:64">1:64</option>
							<option value="1:72">1:72</option>
							<option value="1:76">1:76</option>
							<option value="1:87">1:87</option>
						</select>
					</div>
					<div class="form-group">
						<label>Vehicle type</label>
						<select class="form-control" name="vehicle_type" id="vehicle_type">
							<option value="" selected disabled>Select vehicle</option>
							<option value="car">Car</option>
							<option value="truck">Truck</option>
						</select>
					</div>
					<div class="form-group">
						<label>Special car specification</label>
						<input type="text" class="form-control" name="special_car_specialization" value="{{$userForm->special_car_specialization}}" id="special_car_specialization">
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
						$('#publisherEmailValidation').html('<div class="author_loading"><img src="{{ url('public/ctrl-icon/loder.gif') }}" height="150" width="150"></div>');
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
								base_url += "/{{ user_role('vehicle') }}"+"?vehicle_id="+result.insert_id;
								setTimeout(function(){ window.location = base_url; }, 3000);
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
