@extends('layouts.appadmin')

@section('content')
	<div class="page-content-wrap">
        
		
		
		
		
		
		<!-- Button trigger modal -->
		<!-- Modal -->
		<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5>QR-CODE</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
					<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
					  <div class="carousel-inner">
						<div class="carousel-item active">
						  <img class="d-block w-100" src="{{ url('/public/qrcode/5dd2d7825da0ec04c20f9213png') }}" alt="First slide">
						</div>
						<div class="carousel-item">
						  <img class="d-block w-100" src="{{ url('/public/qrcode/5dd2d7825da0ec04c20f9213png') }}" alt="Second slide">
						</div>
						<div class="carousel-item">
						  <img class="d-block w-100" src="{{ url('/public/qrcode/5dd2d7825da0ec04c20f9213png') }}" alt="Third slide">
						</div>
					  </div>
					  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					  </a>
					  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					  </a>
					</div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<!-- button type="button" class="btn btn-primary">Save changes</button -->
			  </div>
			</div>
		  </div>
		</div>


		<form method="POST" action="{{ url($formaction) }}" id="Updateuser" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="modal-header">
				<h5 id="Subscription"><div id="subscription_label">{{ $page_info['page_title'] }}</div></h5>
				
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">View Qr-code</button>
			</div>
			
		  
			<div class="modal-body">
				<div class="row">
					<div class="form-group">
							<div class="col-sm-12 col-xs-12">
								<label for="">Select car</label>
								
								<select class="form-control" name="vehicle_id" id="vehicle_id" required="">
								  <option value="2019">Select vehicle</option>
								  @foreach($vichle_name as $vichle_name)
									  <option value="{{$vichle_name->_id}}">{{$vichle_name->brand .' ('.$vichle_name->model.')'}}</option>
								  @endForeach;
								</select>
							</div>
					</div>
					<div id="publisherEmailValidation"></div>
					<div class="form-group">
							<div class="col-sm-12 col-xs-12">
								<label for="">Description</label>
								<input type="text" class="form-control" name="description" value="" id="description">
							</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<input type="button" class="btn btn-secondary" onclick="form_return()" value="Back">
				<input type="submit" class="btn btn-primary" value="Save">
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
								$('#publisherEmailValidation').html('');
								var result = JSON.parse(response);
								$.toaster({ priority : 'success', title : 'Success', message : result.message });
						   }
						});
						event.preventDefault();
					});		

					$('.carousel').carousel({
						interval: false
					}); 

				});
				function form_return()
					{
						window.history.back();
					}
				
				
					</script>
	
@endsection
