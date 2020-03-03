@extends('layouts.appadmin')

@section('content')

	<div class="page-content-wrap adduser-parent">
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

				<div class="col-sm-12 col-xs-12">
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control" name="name" value="{{$userForm->name}}" id="name" required="">
					</div>
					
					<div class="form-group">
						<label>Password</label>
						<input type="password" class="form-control" name="password" value="" id="password" <?php echo ($formaction == '/admin/users') ? 'required':''; ?>>
						<div id="passwordValidation"></div>
					</div>
					
					<div class="form-group">
						<label>Confirm password</label>
						<input type="password" class="form-control" name="confirm_password" value="" id="confirm_password" <?php echo ($formaction == '/admin/users') ? 'required':''; ?>>
						<div id="passwordcanformValidation"></div>
					</div>
					<?php if(user_role() === 'admin') { ?>
					<div class="form-group">
						<label>Select roll</label>
						<select class="form-control" name="role_id" id="role_id">
						  <option value="{{ my_role(3)}}">Select roll</option>
						  <option value="{{ my_role(1)}}" <?php if($userForm->role_id == my_role(1)) { echo 'selected'; } ?>>Admin</option>
						  <option value="{{ my_role(2)}}" <?php if($userForm->role_id == my_role(2)) { echo 'selected'; } ?>>Manufacturer</option>
						  <option value="{{ my_role(3)}}" <?php if($userForm->role_id == my_role(3)) { echo 'selected'; } ?>>Users</option>
						</select>
					</div>
					<?php } ?>

					<div class="form-group">
						<label>Phone no</label>
						<input type="text" class="form-control email" name="phone_no" value="{{$userForm->phone_no}}" id="phone_no" required="">
						<div id="phone_noValidation"></div>
					</div>
				</div>
		
				<div id="ctrlscrolbar"></div>
				
				<div class="col-sm-12 col-xs-12">
	
					<div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control email" name="email" value="{{$userForm->email}}" id="email" required="">
						<div id="publisherEmailValidation"></div>
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

@endsection
