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

				<div class="col-sm-6 col-xs-12 control-group">
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
					
					<div class="form-group">
						<input type="text" class="form-control date-picker" placeholder="Birth date" name="birth_date" value="" id="birth_date">
					</div>
					
					<div class="form-group">
						<input type="text" class="form-control" placeholder="City" name="city" value="{{$userForm->city}}" id="city">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="State" name="state" value="{{$userForm->state}}" id="state">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Country" name="country" value="{{$userForm->country}}" id="country">
					</div>
					
				</div>
		
				<div id="ctrlscrolbar"></div>
				
				<div class="col-sm-6 col-xs-12">
		
					<div class="form-group">
						<input type="email" class="form-control email" placeholder="Email" name="email" value="{{$userForm->email}}" id="email" required="" disabled>
					</div>
					
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Phone no" name="phone_no" value="{{$userForm->phone_no}}" id="phone_no" required="">
					</div>

					<div class="form-group">
						<input type="file" accept="image/*" onchange="loadFile(event)" id="upload_image_button" name="userimage" style="display: none;">
						<img src="{{ url('public/assets/userimages/'.$userForm->image) }}" id="output" class="img-circle" alt="Cinque Terre" width="100" height="100">
					<p>Click on image for change this</p>
					</div>
					<br><br><br><br><br><br><br><br><br>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Company name" name="company_name" value="{{$userForm->company_name}}" id="company_name">
					</div>
					
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Address" name="address" value="{{$userForm->address}}" id="address">
					</div>
					
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Address 2" name="address2" value="{{$userForm->address2}}" id="address2">
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
				// $(document).ready(function(){
					
				// });
				
				
		$.validator.setDefaults({
			submitHandler: function() {
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
									return true;
								}
						   }
						});
						event.preventDefault();
					});
			}
		});
		
				
				
		$( document ).ready( function () {
			$("#Updateuser").validate({
				rules: {
					new_password: {required: false,minlength: 6},
					confirm_password: {required: false,minlength: 6,equalTo: "#new_password"}
				},
				messages: {
					new_password: {minlength:"Your password must be at least 6 characters long"},
					confirm_password: {minlength:"Your canform password must be at least 6 characters long",equalTo: "Your confirm password does't match"}
				},
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					error.addClass( "help-block" );

					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "label" ) );
					} else {
						error.insertAfter( element );
					}
				},
				highlight: function( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
				},
				unhighlight: function(element, errorClass, validClass) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
				}
			});
		});
		
			function form_return()
				{
					window.history.back();
				}
	</script>
	
@endsection
