@extends('layouts.appuser')
<style>
.select2-container .select2-selection--single {
    height: calc(1.5em + -0.25rem + 2px) !important;
}
</style>
@section('content')



	<div class="page-content-wrap">
                    <!-- START ALERT BLOCKS -->


                        
<!-- END ALERT BLOCKS -->                    <!--<link href="https://ebookbazaar.com/public/css/bootstrap.min.css" rel="stylesheet">-->
<link rel="stylesheet" href="https://ebookbazaar.com/public/css/bootstrap-select.min.css">
<style>


</style>
<div class="col-md-12 vehicle_setting">

		
		
		<!--      popup model start   -->
		
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
							<div id="carouselExampleControls" class="carousel slide" data-ride="carousel2">
							  <div class="carousel-inner">
								<div class="carousel-item active">
								  <img class="d-block w-100" src="{{ url('/public/qrcode/qrcodepng') }}" alt="First slide">
								</div>
							  </div>
							</div>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<!-- button type="button" class="btn btn-primary">Save changes</button -->
					  </div>
					</div>
				  </div>
				</div>
		<!--      End   -->
		
		
		
        <div class="panel panel-default">
			<div class="modal-header">
				<div class="modal-title" id="subscription_label">
							<select class="form-control selectpicker" name="all-vehicle" id="all-vehicle">
							<option value="all">Select vehicle</option>
									@foreach ($allVehicle as $vehicle)
											<option value="{{ $vehicle->_id }}" <?php if($vehicle->_id == Request::segment(3)){ echo 'selected'; }?>>{{ $vehicle->brand.' ('.$vehicle->model.')' }}</option>
									  @endforeach
							</select>
				</div>
				
				<input type="button" class="btn btn-secondary" onclick="form_return()" value="Back">
			</div>
		
            <div class="panel-body">
            <div id="example_wrapper" class="dataTables_wrapper no-footer">
					<table id="example" class="table table-hover table-striped">
						<thead>
							<tr role="row">
								<!-- th>Sr No.</th -->
								<th>Background Color</th>
								<th>Pad Line Color</th>
								<th>Pad Background Color</th>
								<th>Daylight auto on</th>
								<th>Reverse speed motor</th>
								<th>Motor off</th>
								<th>Front motor</th>
								<th>Rear motor</th>
								<th>Steering control point</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						@if($vehicles)
						  @foreach ($vehicles->vehicle_setting as $vehicle_setting)
							<tr role="row">
								<td>{{ $vehicle_setting->background_color }}</td>
								<td>{{ $vehicle_setting->pad_line_color }}</td>
								<td>{{ $vehicle_setting->pad_background_color }}</td>
								<td>{{ $vehicle_setting->daylight_auto_on }}</td>
								<td>{{ $vehicle_setting->reverse_speed_motor }}</td>
								<td>{{ $vehicle_setting->motor_off }}</td>
								<td>{{ $vehicle_setting->front_motor }}</td>
								<td>{{ $vehicle_setting->rear_motor }}</td>
								<td>{{ $vehicle_setting->steering_control_point }}</td>
								<td>
									<a href="javascript::void(0)" class="qr-code" data-id="{{ $vehicle_setting->_id }}" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-qrcode" title="View qr-code"></i></a>
									<a href="../settings/{{ $vehicle_setting->_id }}" class="edit-vehicle-setting"><i class="fa fa-pencil-square-o" title="Edit"></i></a>
									<!-- a href="javascript::void(0)" class="delete-user" data-token="{{ csrf_token() }}" data-id="{{ $vehicle_setting->_id }}"><i class="fa fa-trash" title="Delete"></i></a -->
								</td>
							</tr>
						  @endforeach
						@endIf
						</tbody>
					</table>
			</div>
			</div>
		</div>
</div>


@endsection

@section('script')
	<script>
	
		jQuery(document).ready(function () {
			
			
			$(document).on('click', '.delete-user', function(){
					var delete_id = $(this).data('id');
					var tabe_tr = $(this).parents('tr');
					var token = $(this).data("token");
                        $.confirm({
                            icon: 'fa fa-frown-o',
							content: 'Are you sure to delete this setting ..?',
                            theme: 'modern',
                            closeIcon: true,
                            animation: 'scale',
                            type: 'blue',
							 buttons: {
                                'confirm': {
                                    text: 'Delete',
                                    btnClass: 'btn btn-primary',
                                    action: function(){
										tabe_tr.remove();
										 $.ajax({
											url: "../settings/"+delete_id,
											type: 'delete',
											dataType: "JSON",
											data: {
												"_token": token,
											},
											success: function (response)
											{
												$.toaster({ priority : 'success', title : 'Success', message : response.message });
											}
										});
                                    }
                                },
                                cancel: function(){
                                },
                            }
                        });
			});
			
			
			$(document).on('click', 'a[class="qr-code"]', function(){
					$.ajax({
						url: "../get-vehicle-qrcode/"+$(this).data('id'),
						type: 'get',
						dataType: "JSON",
						success: function (response)
						{
							$('img[class="d-block w-100"]').attr('src',response);
						}
					});
			});
			
			$(document).on('change', 'select[name="all-vehicle"]', function(){
					window.location.href = $(this).val();
			});
			
			$('.carousel').carousel({
				interval: false
			}); 
			
			$(document).on('click', '.btn-secondary.btn-toggle', function(){
					$.ajax({
							url: "../vehicle-setting-status",
							type: 'POST',
							dataType: "JSON",
							data: {
									"_token": $(this).data('token'),
									"status": $(this).attr("aria-pressed"),
									"id": $(this).data('id'),
							},
							success: function (response)
							{
								
							}
						});
			});
			
			
		});		
		function form_return()
			{
				window.history.back();
			}
	</script>

		@if(Request::segment(3) == 'all')
			<script>
				$('#example').dataTable({
					"oLanguage": {
						"sEmptyTable": "No vehicle setting found (Please select a vehicle)"
					},
					"scrollX": true,
					"bPaginate": false
				});
			</script>
		@else
			<script>
			$(document).ready(function () {
				$('#example').DataTable({
					"scrollX": true,
					"language": {
						"paginate": {
						  "previous": "previous / ",
						  "next": " / next",
						}
					  },
					"fnDrawCallback":function(){
							if ($('#example tr').length < 10) {
								$('.dataTables_paginate').hide();
							}
					}
				});
			});
			</script>
		@endIf
		@if(session()->has('flash-message'))
		<script>
			jQuery(document).ready(function () {
				$.toaster({ priority : 'success', title : 'Success', message : "{{ session()->get('flash-message') }}" });
			});
		</script>
	@endif
	
@endsection






