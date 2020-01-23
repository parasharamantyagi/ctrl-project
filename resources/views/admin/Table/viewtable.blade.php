@extends('layouts.appadmin')

@section('content')
	<link rel="stylesheet" href="{{ url('/public/assets/select/fSelect.css') }}">
	<style>
	.fs-label {
		display: block;
		width: 100%;
		height: calc(1.5em + 0.75rem + 2px);
		padding: 0.375rem 0.75rem;
		font-size: 1rem;
		font-weight: 400;
		line-height: 1.5;
		color: #495057;
		background-color: #fff;
		background-clip: padding-box;
		border: 1px solid #ced4da;
		border-radius: 0.25rem;
		transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
	}
	.fs-label-wrap {
		border-radius: 0.25rem;
	}
	</style>
	<div class="page-content-wrap">
                    <!-- START ALERT BLOCKS -->


                        
<!-- END ALERT BLOCKS -->                    	
		<form method="POST" action="" id="Updateuser">
			{{ csrf_field() }}
		  <div class="modal-header">
			<h5>{{ $page_info['page_title'] }}</h5>
		  </div>
			<div class="modal-body">
			<div class="row">
				<div class="col-sm-6 col-xs-12">
					<div class="form-group">
						<label>Select vehicle</label>
						<select class="form-control test" name="vehicle_id[]" multiple="multiple">
							@foreach($vichle_name as $vichle_name)
								<option value="{{$vichle_name->_id}}" <?php echo (in_array($vichle_name->_id,explode(',',$editTable->vehicle_id))) ? 'selected':''; ?>>{{$vichle_name->brand .' ('.$vichle_name->model.')'}}</option>
							@endForeach;
						</select>
					</div>
				</div>
				
				<div class="col-sm-6 col-xs-12">
					<div class="form-group">
						<label>Select User</label>
						<select class="form-control test" name="users[]" multiple="multiple">
							@foreach($users as $user)
								<option value="{{$user->_id}}" <?php echo (in_array($user->_id,explode(',',$editTable->users))) ? 'selected':''; ?>>{{$user->name}}</option>
							@endForeach;
						</select>
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
	<script src="{{ url('/public/assets/select/fSelect.js') }}"></script>
	<script>
				$(document).ready(function(){
					$('#Updateuser').submit(function(event){
						$('#ctrlscrolbar').html('<div class="author_loading"><img src="{{ url('public/ctrl-icon/loder.gif') }}" height="150" width="150"></div>');
						 $.ajax({
						   type:this.method,
						   url: this.action,
						   contentType: false, 
						   processData:false,   
						   data: new FormData(this),
						   success:function(response)
						   {
								var result = JSON.parse(response);
								$.toaster({ priority : 'success', title : 'Success', message : result.message });
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
				
				(function($) {
					$(function() {
						window.fs_test = $('.test').fSelect();
					});
				})(jQuery);
			  //danger  success info warning
	</script>
	
@endsection