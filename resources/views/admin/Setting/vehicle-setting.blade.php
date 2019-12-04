@extends('layouts.appadmin')

@section('content')



	<div class="page-content-wrap">
                    <!-- START ALERT BLOCKS -->


                        
<!-- END ALERT BLOCKS -->                    <!--<link href="https://ebookbazaar.com/public/css/bootstrap.min.css" rel="stylesheet">-->
<link rel="stylesheet" href="https://ebookbazaar.com/public/css/bootstrap-select.min.css">
<style>
    /* .admin_allbooks {width:100%; float:left;} */
    .admin_allbooks .my_form_seatch_bar{
        float:left;

    }
    .admin_allbooks .addbook_btn {float:right;}
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }
    .switch span
    {
        height:20px;
    }
    .slider:before
    {
        background-color:transparent!important;
    }
    .switch input {display:none;}
    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }
	
	
	@media only screen and (min-width: 600px) {
	   .vehicle_setting .btn-secondary {
		   margin-left: 70%;
		}
	}
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
								  <img class="d-block w-100" src="{{ url('/public/qrcode/5dd2d7825da0ec04c20f9213png') }}" alt="First slide">
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
				<h5 class="modal-title" id="Subscription"><div id="subscription_label">{{ $vehicles->brand.' ('.$vehicles->model.')' }}</div></h5>
				
				<input type="button" class="btn btn-secondary" onclick="form_return()" value="Back">
				<a href="{{ url('/admin/qr-code') }}"><button type="button" class="btn btn-primary">Add QR code</button></a>
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
								<th>Reverse steer motor</th>
								<th>Motor off</th>
								<th>Steering control point</th>
								<th>Asset folder</th>
								<th>Action</th>
							</tr>
						</thead>
						<!tbody>
						  @foreach ($vehicles->vehicle_setting as $vehicle_setting)
							<tr role="row">
								<td>{{ $vehicle_setting->background_color }}</td>
								<td>{{ $vehicle_setting->pad_line_color }}</td>
								<td>{{ $vehicle_setting->pad_background_color }}</td>
								<td>{{ $vehicle_setting->daylight_auto_on }}</td>
								<td>{{ $vehicle_setting->reverse_speed_motor }}</td>
								<td>{{ $vehicle_setting->reverse_steer_motor }}</td>
								<td>{{ $vehicle_setting->motor_off }}</td>
								<td>{{ $vehicle_setting->steering_control_point }}</td>
								<td>{{ $vehicle_setting->asset_folder }}</td>
								<td>
									<button type="button" class="btn btn-primary" data-id="{{ $vehicle_setting->_id }}" data-toggle="modal" data-target="#exampleModalLong">QrCode</button>
								</td>
							</tr>
						  @endforeach
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
			$('.delete-user').click(function(){
				if(confirm('Are you sure to delete this Vehicle ..?'))
				{
					$(this).parents('tr').remove();
					var delete_id = $(this).data('id');
					var token = $(this).data("token");
					 $.ajax({
						url: "vehicle/"+delete_id,
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
			});
			
			
			$(document).on('click', 'button[class="btn btn-primary"]', function(){
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
			
			// render: function(data, type, full, meta){
				 // return "<img src={{ URL::to('/') }}/images/" + data + " width='70' class='img-thumbnail' />";
				// },
			
			// $('#example').DataTable({
			  // processing: true,
			  // serverSide: true,
			  // ajax:{
			   // url: "{{ url('/admin/user-table') }}",
			   // "type": "POST",
			   // "data": {"_token": "{{ csrf_token() }}"}
			  // },
			  // "columns": [
					// {"data": "_id"},
					// {"data": "name"},
					// {"data": "email"},
					// {"data": "phone_no"},
					// {"data": "image", "searchable": false, "orderable": false},
					// {"data": "action", "searchable": false, "orderable": false}
				// ]
			 // });
			// jQuery('#example').DataTable({
				// dom: 'lifrtp',
				// language: {
					// "infoFiltered": "",
					// processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
				// },
				// "processing": true,
				// "serverSide": true,
				// "pageLength": 50,
				// lengthMenu: [
					// [50, 100, 250, 500, 999999],
					// ['50', '100', '250', '500', 'Show all']
				// ],
				// "ajax": {
					// "url": "{{ url('/admin/user-table') }}",
					// "dataType": "json",
					// "type": "POST",
					// "data": {"_token": "{{ csrf_token() }}"}
				// },
				// "columns": [
					// {"targets": "0", "data": null, "sortable": false, "searchable": false},
					// {"data": "_id"},
					// {"data": "name"},
					// {"data": "email"},
					// {"data": "phone_no"},
					// {"data": "image", "searchable": false, "orderable": false},
					// {"data": "action", "searchable": false, "orderable": false}
				// ]
			// });
			$('.carousel').carousel({
				interval: false
			}); 
		
			$('#example').DataTable({
					"scrollX": true,
					"language": {
					"paginate": {
					  "previous": "previous / ",
					  "next": " / next",
					}
				  }
			});
		});		
		function form_return()
			{
				window.history.back();
			}
	</script>		
	
@endsection






