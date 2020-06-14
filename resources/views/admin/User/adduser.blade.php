@extends('layouts.appadmin')

@section('content')
	
<link rel="stylesheet" type="text/css" href="https://www.marghoobsuleman.com/mywork/jcomponents/image-dropdown/samples/css/msdropdown/dd.css" />
<link rel="stylesheet" type="text/css" href="https://www.marghoobsuleman.com/mywork/jcomponents/image-dropdown/samples/css/msdropdown/flags.css" />
	<div class="page-content-wrap adduser-parent">
                    <!-- START ALERT BLOCKS -->


                        
<!-- END ALERT BLOCKS -->                    	
		<form method="POST" action="{{ url($formaction) }}" id="Updateuser" enctype="multipart/form-data">
			{{ csrf_field() }}
		  <div class="modal-header">
			<h5 id="page_title">{{ $page_info['page_title'] }}</h5>
		  </div>
			<input type="hidden" name="id" value="{{$userForm->id}}" id="id">
			<div class="modal-body">
			<div class="row">

				<div class="col-sm-12 col-xs-12">
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
						<label>Email</label>
						<input type="email" class="form-control email" name="email" value="{{$userForm->email}}" id="email" required="">
						<div id="publisherEmailValidation"></div>
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
					<div class="form-group">
						<label>First name (if user is under aged)</label>
						<input type="text" class="form-control" name="parent_first_name" value="{{$userForm->parent_first_name}}" id="parent_first_name">
					</div>
					<div class="form-group">
						<label>Last name (if user is under aged)</label>
						<input type="text" class="form-control" name="parent_last_name" value="{{$userForm->parent_last_name}}" id="parent_last_name">
					</div>
					<div class="form-group">
						<label>On screen name</label>
						<input type="text" class="form-control" name="driver_name" value="{{$userForm->driver_name}}" id="driver_name" required="">
					</div>
					<div class="form-group">
						<label>Short ID (unique)</label>
						<input type="text" class="form-control" name="short_id" value="{{$userForm->short_id}}" id="short_id" required="">
						<div id="unique_short_idValidation"></div>
					</div>
					<div class="form-group">
						<label>First name</label>
						<input type="text" class="form-control" name="first_name" value="{{$userForm->first_name}}" id="first_name" required="">
					</div>
					<div class="form-group">
						<label>Last name</label>
						<input type="text" class="form-control" name="last_name" value="{{$userForm->last_name}}" id="last_name" required="">
					</div>
					<div class="form-group">
						<label>Company name</label>
						<input type="text" class="form-control" name="company_name" value="{{$userForm->company_name}}" id="company_name" required="">
					</div>
					<div class="form-group">
						<label>Address</label>
						<input type="text" class="form-control" name="address" value="{{$userForm->address}}" id="address" required="">
					</div>
					<div class="form-group">
						<label>Address 2</label>
						<input type="text" class="form-control" name="address_2" value="{{$userForm->address_2}}" id="address_2" required="">
					</div>
					<div class="form-group">
						<label>City</label>
						<input type="text" class="form-control" name="city" value="{{$userForm->city}}" id="city" required="">
					</div>
					<div class="form-group">
						<label>Postal code</label>
						<input type="text" class="form-control" name="postal_code" value="{{$userForm->postal_code}}" id="postal_code" required="">
					</div>
					<div class="form-group">
						<label>State</label>
						<input type="text" class="form-control" name="state" value="{{$userForm->state}}" id="state" required="">
					</div>
					<div class="form-group">
						<label>Country</label><br>
						<select class="form-control selectpickerss" data-size="5" data-live-search="true" name="country" id="country" required="">
								<option value="" disabled>Country</option>
								@foreach(get_country() as $country => $country_val)
									<option value="{{strtolower($country)}}" <?php echo (array_key_exists('country',$userForm) && strtolower($userForm->country) == strtolower($country)) ? 'selected':''; ?> data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag {{strtolower($country)}}" data-title="{{$country_val}}">{{$country_val}}</option>
								@endForeach
						</select>
					</div>
					<div class="form-group">
						<label>Phone no</label>
						<input type="text" class="form-control email numeric-val" name="phone_no" value="{{$userForm->phone_no}}" id="phone_no">
						<div id="phone_noValidation"></div>
					</div>
					<div class="form-group">
						<label>Date of birth</label>
						<input type="text" class="form-control datetimepicker" name="date_of_birth" value="{{$userForm->date_of_birth}}" id="date_of_birth">
					</div>
					<div id="ctrlscrolbar"></div>
					<div class="form-group">
						<input type="file" accept="image/*" onchange="loadFile(event)" id="upload_image_button" name="userimage" style="display: none;">
						<img src="{{ url($userForm->image) }}" id="output" class="img-circle" alt="Cinque Terre" width="100" height="100">
					<p>Click on image for change this</p>
					</div>
					<?php if(user_role() === 'admin') { ?>
					<div class="form-group">
						<label>Select roll</label>
						<select class="form-control" name="role_id" id="role_id">
						  <option value="{{ my_role(3)}}">Select roll</option>
						  <option value="{{ my_role(1)}}" <?php if($userForm->role_id == my_role(1)) { echo 'selected'; } ?>>Admin</option>
						  <option value="{{ my_role(2)}}" <?php if($userForm->role_id == my_role(2)) { echo 'selected'; } ?>>Manufacturer</option>
						  <option value="{{ my_role(3)}}" <?php if($userForm->role_id == my_role(3)) { echo 'selected'; } ?>>User</option>
						</select>
					</div>
				<?php } ?>
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
<script src="https://www.marghoobsuleman.com/mywork/jcomponents/image-dropdown/samples/js/msdropdown/jquery.dd.min.js"></script>
<script>
				// $(document).ready(function(){
					// $(".selectpickerss").select2();
				// });
				
				$(document).ready(function() {
				$(".selectpickerss").msDropdown();
				})
</script>
@endsection
