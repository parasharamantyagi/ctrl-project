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
		
		
                    <!-- START ALERT BLOCKS -->


                        
<!-- END ALERT BLOCKS -->                    	<form method="POST" id="Updateuser" action="https://ebookbazaar.com/admin/profile/profileUpdate">
			<input type="hidden" name="_token" value="jexJ1SzZsqWO5KIF85I59Gm5yKkHEwh2a0YyyaQ0">
		  <div class="modal-header">
			<h5 class="modal-title" id="Subscription">Update Profile</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">×</span>
			</button>
		  </div>
			<div class="modal-body">
			  <div class="form-group">
				
				<div class="col-sm-6 col-xs-12">
					<input type="hidden" class="form-control" name="id" value="839" id="id" required="">
					<label for="">First Name</label>
					<input type="text" class="form-control" name="first_name" value="aman" id="first_name" required="">
				</div>
				
				<div class="col-sm-6 col-xs-12">
					<label for="">Last Name</label>
					<input type="text" class="form-control email" name="last_name" value="tyagi" id="last_name" required="">
				</div>
			  </div>
			 			   <div class="form-group">
					<div class="col-sm-4 col-xs-12 author_img upload_img">
					<label style="width:100%;">Upload Image</label>
					<input type="file" accept="image/*" onchange="loadFile(event)" id="upload_image_button" name="image" style="display: none;">
					<img src="https://ebookbazaar.com/images/edit_profile_img.png" id="output" class="img-circle" alt="Cinque Terre" width="100" height="100">
					<p>Click on image for change this</p>
				</div>
			  </div>
			  
			  <div class="form-group">
					<div class="col-sm-6 col-xs-12">
						<label for="">Email</label>
						<input type="email" class="form-control email" name="email" value="amant@whizkraft.net" id="email" required="">
						<div id="publisherEmailValidation"></div>
					</div>
					
					<div class="col-sm-6 col-xs-12">
						<label for="">Phone</label>
						<input type="text" class="form-control" name="phone" value="212121" id="phone" required="">
						<div id="publisherphoneValidation"></div>
					</div>
					
			  </div>
			 
			</div>
			
			<div class="modal-footer">
			<input type="button" class="btn btn-secondary" onclick="form_return()" value="Back">
			<input type="submit" class="btn btn-primary" value="Save changes">
			</div>
	  </form>
		
		
                    
				
@endsection
