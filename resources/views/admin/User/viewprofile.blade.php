@extends('layouts.appadmin')

@section('content')
	<div class="page-content-wrap viewprofile">
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

				<div class="col-sm-12 col-xs-12 control-group">
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control" name="name" value="{{$userForm->name}}" id="name" required="">
					</div>
					
					<div class="form-group">
						<label>Old password</label>
						<input type="password" class="form-control" name="old_password" value="" id="old_password">
						<div id="old_passwordValidation"></div>
					</div>

					<div class="form-group">
						<label>New password</label>
						<input type="password" class="form-control" name="new_password" value="" id="new_password">
					</div>

					<div class="form-group">
						<label>Confirm password</label>
						<input type="password" class="form-control" name="confirm_password" value="" id="confirm_password">
						<div id="passwordcanformValidation"></div>
					</div>
					
					<div class="form-group">
						<label>Birth date</label>
						<input type="text" class="form-control datetimepicker" name="birth_date" value="" id="birth_date">
					</div>
					
					<div class="form-group">
						<label>City</label>
						<input type="text" class="form-control" name="city" value="{{$userForm->city}}" id="city">
					</div>
					<div class="form-group">
						<label>State</label>
						<input type="text" class="form-control" name="state" value="{{$userForm->state}}" id="state">
					</div>
					<div class="form-group">
						<label>Country</label>
						<input type="text" class="form-control" name="country" value="{{$userForm->country}}" id="country">
					</div>
					
				</div>
		
				<div id="ctrlscrolbar"></div>
				
				<div class="col-sm-12 col-xs-12">
		
					<div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control email" name="email" value="{{$userForm->email}}" id="email" required="" disabled>
					</div>
					
					<div class="form-group">
						<label>Phone no</label>
						<input type="text" class="form-control" name="phone_no" value="{{$userForm->phone_no}}" id="phone_no" required="">
					</div>

					<div class="form-group">
						<input type="file" accept="image/*" onchange="loadFile(event)" id="upload_image_button" name="userimage" style="display: none;">
						<img src="{{ url('public/assets/userimages/'.$userForm->image) }}" id="output" class="img-circle" alt="Cinque Terre" width="100" height="100">
					<p>Click on image for change this</p>
					</div>
					<div class="form-group">
						<label>Company name</label>
						<input type="text" class="form-control" name="company_name" value="{{$userForm->company_name}}" id="company_name">
					</div>
					<div class="form-group">
						<label>Language</label>
						<select class="form-control" name="language" id="language">
						  <option value="{{get_language('en')}}" selected disabled>Select language</option>
						  @foreach(get_language() as $key => $language_val)
						  <option value="{{ $key}}" <?php echo ($userForm->language === $key) ? 'selected':''; ?>>{{ $language_val}}</option>
						  @endForeach
						</select>
					</div>
					<div class="form-group">
						<label>Address</label>
						<input type="text" class="form-control" name="address" value="{{$userForm->address}}" id="address">
					</div>
					
					<div class="form-group">
						<label>Address 2</label>
						<input type="text" class="form-control" name="address2" value="{{$userForm->address2}}" id="address2">
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
				
				
		
		
				
				
		
		
		
	</script>
	
@endsection
