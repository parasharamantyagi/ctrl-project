@extends('layouts.appuser')

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
						<input type="text" class="form-control" placeholder="Name" name="name" value="{{$userForm->name}}" id="name" required="">
					</div>
					
					<div class="form-group">
						<input type="password" class="form-control" placeholder="Old password" name="old_password" value="" id="old_password">
						<div id="old_passwordValidation"></div>
					</div>

					<div class="form-group">
						<input type="password" class="form-control" placeholder="New password" name="new_password" value="" id="new_password">
					</div>

					<div class="form-group">
						<input type="password" class="form-control" placeholder="Confirm password" name="confirm_password" value="" id="confirm_password">
						<div id="passwordcanformValidation"></div>
					</div>
					
				</div>
		
				<div id="ctrlscrolbar"></div>
				
				<div class="col-sm-6 col-xs-12">
	
					<div class="form-group">
						<input type="email" class="form-control email" placeholder="Email" value="{{$userForm->email}}" id="email" disabled>
					</div>
					<div class="form-group">
						<input type="text" class="form-control email" placeholder="Phone no" name="phone_no" value="{{$userForm->phone_no}}" id="phone_no" required="">
					</div>

					<div class="form-group">
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
						 if($('input[name="old_password"]').val() && $('input[name="new_password"]').val() && $('input[name="confirm_password"]').val())
						 {
							if($('input[name="new_password"]').val() !== $('input[name="confirm_password"]').val())
							{
								$('#passwordcanformValidation').html('<font color="red">Your confirm password does not match.</font>');
								return false;
							}
						 }
						 $('#ctrlscrolbar').html('<div class="author_loading"><img src="{{ url('public/ctrl-icon/loder.gif') }}" height="150" width="150"></div>');
						 $.ajax({
						   type:this.method,
						   url: this.action,
						   contentType: false, 
						   processData:false,   
						   data: new FormData(this),
						   success:function(response)
						   {
								$('#ctrlscrolbar').html('');
								$('#passwordcanformValidation').html('');
								$('#old_passwordValidation').html('');
								var result = JSON.parse(response);
								if(result.status === false)
								{
									$('input[name="_token"]').val(result.token);
									$('#'+result.type).html('<font color="red">'+result.message+'</font>');
									if(result.type == 'old_passwordValidation')
									{
										$('input[type="password"]').val('');
									}
								}else{
									$.toaster({ priority : 'success', title : 'Success', message : result.message });
									$('input[type="email"]').val(result.email_id);
									$('input[type="password"]').val('');
									// window.location.href = "../redirect/users?message="+result.message;
									return true;
									// 
									// if(result.action === "storeUser")
									// {
										// $("#Updateuser").trigger("reset");
									// }
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