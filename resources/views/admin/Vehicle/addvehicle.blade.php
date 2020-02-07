@extends('layouts.appadmin')

@section('content')

	<div class="page-content-wrap">
                    <!-- START ALERT BLOCKS -->

	
	
                        
<!-- END ALERT BLOCKS -->                    	
		<form method="POST" action="{{ url($formaction) }}" id="Updateuser" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="modal-header">
				<h5>{{ $page_info['page_title'] }}</h5>
				
				@if($formaction != 'vehicleview')
					<a href="{{ url(user_role('settings')) }}" class="btn btn-primary">Add settings</a>
				@endIf
				
			</div>
			
		  
			<input type="hidden" name="id" value="{{$userForm->id}}" id="id">
		<div class="modal-body">
			<div class="row">
			<div class="col-md-6">
					<div class="form-group">
						<input type="text" class="form-control" name="brand" value="{{$userForm->brand}}" placeholder="Brand" id="brand" required="">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="car_name" value="{{$userForm->car_name}}" placeholder="Car name" id="car_name" required="">
					</div>
					<div class="form-group">
						<input type="text" class="form-control email" name="moter_type" value="{{$userForm->moter_type}}" placeholder="Moter Type" id="moter_type" required="">
					</div>
					<div class="form-group">
						<input type="text" class="form-control email" name="torque" value="{{$userForm->torque}}" placeholder="Torque" id="torque" required="">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="km_h_0_160" value="{{$userForm->km_h_0_160}}" placeholder="0-160 km/h" id="km_h_0_160" required="">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="weight" value="{{$userForm->weight}}" placeholder="Weight" id="weight" required="">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="manufacturer" value="{{$userForm->manufacturer}}" placeholder="Manufacturer" id="manufacturer" required="">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="vehicle_type" value="{{$userForm->vehicle_type}}" placeholder="Vehicle type" id="vehicle_type" required="">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="lenght" value="{{$userForm->lenght}}" placeholder="Length" id="lenght" required="">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="wheelbase" value="{{$userForm->wheelbase}}" placeholder="Wheelbase" id="wheelbase" required="">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="width" value="{{$userForm->width}}" placeholder="Width" id="width" required="">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="height" value="{{$userForm->height}}" placeholder="Height" id="height" required="">
					</div>
			</div>

			<div class="col-md-6">
					<div class="form-group">
						<select class="form-control selectpickerss" data-size="5" data-live-search="true" name="model" id="model" required="">
							  <option value="">Model</option>
							  @foreach($carModel as $carModel)
								  <option value="{{$carModel->model_name}}">{{$carModel->model_name}}</option>
							  @endForeach;
						</select>
							
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="model_spec" value="{{$userForm->model_spec}}" placeholder="Model spec" id="model_spec" required="">
					</div>
					<div class="form-group">
						<select class="form-control" name="release_year" id="release_year">
						  <option value="2019">Select Year</option>
						  @foreach(ctrl_year() as $year)
							  <option value="{{$year}}" <?php echo ($userForm->release_year == $year) ? 'selected' : ''; ?>>{{$year}}</option>
						  @endForeach;
						</select>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="horse_power" value="{{$userForm->horse_power}}" placeholder="Horse Power" id="horse_power" required="">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="km_h_0_100" value="{{$userForm->km_h_0_100}}" placeholder="0-100 km/h" id="km_h_0_100" required="">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="km_h_100_0" value="{{$userForm->km_h_100_0}}" placeholder="100-0 km/h" id="km_h_100_0" required="">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="max_weight" value="{{$userForm->max_weight}}" placeholder="Max weight" id="max_weight" required="">
						<div id="publisherEmailValidation"></div>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="scale" value="{{$userForm->scale}}" placeholder="Scale" id="scale" required="">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="special_car_specialization" placeholder="Special car specialization" value="{{$userForm->special_car_specialization}}" id="special_car_specialization" required="">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="length_front_of_car" placeholder="Length front of car to front css" value="{{$userForm->length_front_of_car}}" id="length_front_of_car" required="">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="track_width" placeholder="Track width" value="{{$userForm->track_width}}" id="track_width" required="">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="wheel_diameter" placeholder="Wheel diameter" value="{{$userForm->wheel_diameter}}" id="wheel_diameter" required="">
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
						 $.ajax({
						   type:this.method,
						   url: this.action,
						   contentType: false, 
						   processData:false,   
						   data: new FormData(this),
						   success:function(response)
						   {
							   // $('#publisherEmailValidation').html('');
								var result = JSON.parse(response);
								// $.toaster({ priority : 'success', title : 'Success', message : result.message });
								
								if(result.action === "storeVehicle")
										window.location.href = "./redirect/settings?message="+result.message;
								else
										window.location.href = "../redirect/settings?message="+result.message;
										// $("#Updateuser").trigger("reset");
						   }
						});
						event.preventDefault();
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
