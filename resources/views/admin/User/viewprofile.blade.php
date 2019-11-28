@extends('layouts.appadmin')

@section('content')

	<div class="page-content-wrap">
                    <!-- START ALERT BLOCKS -->


                        
<!-- END ALERT BLOCKS -->                    	
		<form method="POST" action="{{ url($formaction) }}" id="Updateuser" enctype="multipart/form-data">
			{{ csrf_field() }}
		  <div class="modal-header">
			<h5 class="modal-title" id="Subscription">{{$page_info['page_title']}}</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">×</span>
			</button>
		  </div>
			<div class="modal-body">
				<div class="form-group">
					<div class="col-sm-6 col-xs-12">
						<label for="">Name</label>
						<input type="text" class="form-control" name="name" value="{{$userForm->name}}" id="name" required="">
					</div>
					<div class="col-sm-6 col-xs-12">
						<label for="">Email</label>
						<input type="email" class="form-control email" name="email" value="{{$userForm->email}}" id="email" required="">
						<div id="publisherEmailValidation"></div>
					</div>
				</div>
			 	<div class="form-group">
					<div class="col-sm-6 col-xs-12 author_img upload_img">
						<label style="width:100%;">Upload Image</label>
						<input type="file" accept="image/*" onchange="loadFile(event)" id="upload_image_button" name="userimage" style="display: none;">
						<img src="{{ url('public/assets/userimages/'.$userForm->image) }}" id="output" class="img-circle" alt="Cinque Terre" width="100" height="100">
					<p>Click on image for change this</p>
					</div>
					
					<div class="col-sm-6 col-xs-12">
						<label for="">Phone no</label>
							<input type="text" class="form-control email" name="phone_no" value="{{$userForm->phone_no}}" id="phone_no" required="">
						<div id="publisherEmailValidation"></div>
					</div>
				</div>
			  
			    <div class="form-group">
					<div class="col-sm-6 col-xs-12">
						<label for="">Password</label>
							<input type="password" class="form-control" name="password" value="" id="password">
					</div>
					<div class="col-sm-6 col-xs-12">
						<label for="">Confirm Password</label>
							<input type="password" class="form-control" name="confirm_password" value="" id="confirm_password">
							<div id="confirm_password_Validation"></div>
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
						$('#confirm_password_Validation').html('');
						$('#publisherEmailValidation').html('<div class="author_loading"><img src="{{ url('public/ctrl-icon/loder.gif') }}" height="150" width="150"></div>');
						 $.ajax({
						   type:this.method,
						   url: this.action,
						   contentType: false, 
						   processData:false,   
						   data: new FormData(this),
						   dataType : 'json',
						   success:function(response)
						   {
							   $('#publisherEmailValidation').html('');
								if(response.status === false)
								{
									$('#confirm_password_Validation').html('<font color="red">'+response.message+'</font>');
								}else{
									$.toaster({ priority : 'success', title : 'Success', message : response.message });
								}
						   }
						});
						event.preventDefault();
					});
				});
			  //danger  success info warning
	</script>
	
@endsection
