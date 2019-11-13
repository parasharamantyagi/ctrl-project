@extends('layouts.appadmin')

@section('content')

	<style>
	.author_loading {
		position: fixed;
		top: 0px;
		right: 0px;
		bottom: 0px;
		left: 0px;
		align-items: center;
		-webkit-align-items: center;
		-moz-align-items: center;
		text-align: center;
		background: rgba(0,0,0,0.2);
		display: flex;
		-moz-display: flex;
		-webkit-display: flex;
		z-index: 999;
		justify-content: center;
		-webkit-justify-content: center;
		-moz-justify-content: center;
	}
	</style>

	<div class="page-content-wrap">
                    <!-- START ALERT BLOCKS -->

	
	
                        
<!-- END ALERT BLOCKS -->                    	
		<form method="POST" action="{{ url($formaction) }}" id="Updateuser" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="modal-header">
				<h5 class="modal-title" id="Subscription">Add Vehicle</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">×</span>
				</button>
			</div>
			
		  
			<input type="hidden" name="id" value="{{$userForm->id}}" id="id">
			<div class="modal-body">
				<div class="form-group">
					<div class="col-sm-6 col-xs-12">
						<label for="">Brand</label>
						<input type="text" class="form-control" name="brand" value="{{$userForm->brand}}" id="brand" required="">
					</div>
					<div class="col-sm-6 col-xs-12">
						<label for="">Model</label>
						<input type="text" class="form-control" name="model" value="{{$userForm->model}}" id="model" required="">
					</div>
				</div>
			 	<div class="form-group">
					<div class="col-sm-6 col-xs-12 author_img upload_img">
						<label for="">Model spec</label>
						<input type="text" class="form-control" name="model_spec" value="{{$userForm->model_spec}}" id="model_spec" required="">
					</div>
					
					<div class="col-sm-6 col-xs-12">
						<label for="">Release year</label>
						<select class="form-control" name="release_year" id="release_year">
						  <option value="2019">Select Year</option>
						  @foreach(ctrl_year() as $year)
							  <option value="{{$year}}">{{$year}}</option>
						  @endForeach;
						</select>
					</div>
				</div>
			    <div class="form-group">
					<div class="col-sm-4 col-xs-12">
						<label for="">Moter Type</label>
						<input type="text" class="form-control email" name="moter_type" value="{{$userForm->moter_type}}" id="moter_type" required="">
					</div>
					<div class="col-sm-4 col-xs-12">
						<label for="">Horse Power</label>
						<input type="text" class="form-control" name="horse_power" value="{{$userForm->horse_power}}" id="horse_power" required="">
					</div>
					<div class="col-sm-4 col-xs-12">
						<label for="">Torque</label>
						<input type="text" class="form-control email" name="torque" value="{{$userForm->torque}}" id="torque" required="">
					</div>
			    </div>
				<div class="form-group">
					<div class="col-sm-4 col-xs-12">
						<label for="">0-100 km/h</label>
						<input type="text" class="form-control" name="km_h_0_100" value="{{$userForm->km_h_0_100}}" id="km_h_0_100" required="">
					</div>
					<div class="col-sm-4 col-xs-12">
						<label for="">0-160 km/h</label>
						<input type="text" class="form-control" name="km_h_0_160" value="{{$userForm->km_h_0_160}}" id="km_h_0_160" required="">
					</div>
					<div class="col-sm-4 col-xs-12">
						<label for="">100-0 km/h</label>
						<input type="text" class="form-control" name="km_h_100_0" value="{{$userForm->km_h_100_0}}" id="km_h_100_0" required="">
					</div>
			    </div>
				<div class="form-group">
					<div class="col-sm-4 col-xs-12">
						<label for="">Weight</label>
						<input type="text" class="form-control" name="weight" value="{{$userForm->weight}}" id="weight" required="">
					</div>
					<div class="col-sm-4 col-xs-12">
						<label for="">Max weight</label>
						<input type="text" class="form-control" name="max_weight" value="{{$userForm->max_weight}}" id="max_weight" required="">
					</div>
					<div class="col-sm-4 col-xs-12">
						<label for="">Manufacturer</label>
						<input type="text" class="form-control" name="manufacturer" value="{{$userForm->manufacturer}}" id="manufacturer" required="">
					</div>
			    </div>
				<div class="form-group">
					<div class="col-sm-4 col-xs-12">
						<label for="">Scale</label>
						<input type="text" class="form-control" name="scale" value="{{$userForm->scale}}" id="scale" required="">
					</div>
					<div class="col-sm-4 col-xs-12">
						<label for="">Vehicle type</label>
						<input type="text" class="form-control" name="vehicle_type" value="{{$userForm->vehicle_type}}" id="vehicle_type" required="">
					</div>
					<div class="col-sm-4 col-xs-12">
						<label for="">Special car specialization</label>
						<input type="text" class="form-control" name="special_car_specialization" value="{{$userForm->special_car_specialization}}" id="special_car_specialization" required="">
					</div>
			    </div>
				<div class="form-group">
					<div class="col-sm-4 col-xs-12">
						<label for="">Length</label>
						<input type="text" class="form-control" name="lenght" value="{{$userForm->lenght}}" id="lenght" required="">
					</div>
					<div class="col-sm-4 col-xs-12">
						<label for="">Length front of car to front css</label>
						<input type="text" class="form-control" name="length_front_of_car" value="{{$userForm->length_front_of_car}}" id="length_front_of_car" required="">
					</div>
					<div class="col-sm-4 col-xs-12">
						<label for="">Wheelbase</label>
						<input type="text" class="form-control" name="wheelbase" value="{{$userForm->wheelbase}}" id="wheelbase" required="">
					</div>
			    </div>
				<div class="form-group">
					<div class="col-sm-6 col-xs-12">
						<label for="">Track width</label>
						<input type="text" class="form-control" name="track_width" value="{{$userForm->track_width}}" id="track_width" required="">
					</div>
					<div class="col-sm-6 col-xs-12">
						<label for="">Width</label>
						<input type="text" class="form-control" name="width" value="{{$userForm->width}}" id="width" required="">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6 col-xs-12">
						<label for="">Wheel diameter</label>
						<input type="text" class="form-control" name="wheel_diameter" value="{{$userForm->wheel_diameter}}" id="wheel_diameter" required="">
					</div>
					<div class="col-sm-6 col-xs-12">
						<label for="">Height</label>
						<input type="text" class="form-control" name="height" value="{{$userForm->height}}" id="height" required="">
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
				// $(document).ready(function(){
					// $('#Updateuser').submit(function(event){
						// $('#publisherEmailValidation').html('<div class="author_loading"><img src="{{ url('public/ctrl-icon/loder.gif') }}" height="150" width="150"></div>');
						 // $.ajax({
						   // type:this.method,
						   // url: this.action,
						   // contentType: false, 
						   // processData:false,   
						   // data: new FormData(this),
						   // success:function(response)
						   // {
								// var result = JSON.parse(response);
								// if(result.status === false)
								// {
									// $('#publisherEmailValidation').html('<font color="red">this email already exists!</font>');
								// }else{
									// $('#publisherEmailValidation').html('');
									// $.toaster({ priority : 'success', title : 'Success', message : result.message });
									// if(this.action === "{{ url('/admin/users') }}")
									// {
										// $("#Updateuser").trigger("reset");
									// }
								// }
						   // }
						// });
						// event.preventDefault();
					// });
				// });
	</script>
	
@endsection
