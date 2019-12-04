@extends('layouts.appadmin')

@section('content')

	<div class="page-content-wrap">
                    <!-- START ALERT BLOCKS -->


                        
<!-- END ALERT BLOCKS -->                    	
		<form method="POST" action="{{ url($formaction) }}" id="Updateuser" enctype="multipart/form-data">
			{{ csrf_field() }}
		  <div class="modal-header">
			<h5>{{ $page_info['page_title'] }}</h5>
		  </div>
			<input type="hidden" name="id" value="{{$userForm->id}}" id="id">
			<div class="modal-body">
			<div class="row">

				<div class="col-sm-6 col-xs-12">
					<div class="form-group">
						<label for="">Name</label>
						<input type="text" class="form-control" name="name" value="{{$userForm->name}}" id="name" required="">
					</div>
					
					<div class="form-group">
						<label for="">Role</label>
						<select class="form-control" name="role_id" id="role_id">
						  <option value="3">Select roll</option>
						  <option value="1" <?php if($userForm->role_id == 1) { echo 'selected'; } ?>>Admin</option>
						  <option value="2" <?php if($userForm->role_id == 2) { echo 'selected'; } ?>>Manufacturer</option>
						  <option value="3" <?php if($userForm->role_id == 3) { echo 'selected'; } ?>>Users</option>
						</select>
					</div>

					<div class="form-group">
						<label for="">Phone no</label>
						<input type="text" class="form-control email" name="phone_no" value="{{$userForm->phone_no}}" id="phone_no" required="">
					</div>
				</div>
		
					
				<div class="col-sm-6 col-xs-12">
	
					<div class="form-group">
						<label for="">Email</label>
						<input type="email" class="form-control email" name="email" value="{{$userForm->email}}" id="email" required="">
						<div id="publisherEmailValidation"></div>
					</div>

					<div class="form-group">
						<label style="width:100%;">Upload Image</label>
						<input type="file" accept="image/*" onchange="loadFile(event)" id="upload_image_button" name="userimage" style="display: none;">
						<img src="{{ url($userForm->image) }}" id="output" class="img-circle" alt="Cinque Terre" width="100" height="100">
					<p>Click on image for change this</p>
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
						$('#publisherEmailValidation').html('<div class="author_loading"><img src="{{ url('public/ctrl-icon/loder.gif') }}" height="150" width="150"></div>');
						 $.ajax({
						   type:this.method,
						   url: this.action,
						   contentType: false, 
						   processData:false,   
						   data: new FormData(this),
						   success:function(response)
						   {
								var result = JSON.parse(response);
								if(result.status === false)
								{
									$('#publisherEmailValidation').html('<font color="red">this email already exists!</font>');
								}else{
									$('#publisherEmailValidation').html('');
									// location.reload(true);
									// alert('Success...!');
									$.toaster({ priority : 'success', title : 'Success', message : result.message });
									if(result.action === "storeUser")
									{
										$("#Updateuser").trigger("reset");
										// $("#upload_image_button").val('');
									}
								}
						   }
						});
						event.preventDefault();
					});
				});
				
				function form_return()
				{
					// $('#upload_image_button').val('');
					// $("#upload_image_button").val('');
					// document.getElementById("upload_image_button").value = null;
					window.history.back();
				}
			  //danger  success info warning
	</script>
	
@endsection
