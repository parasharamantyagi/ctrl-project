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
</style>
<div class="col-md-12">
        <div class="panel panel-default">
			<div class="modal-header">
				<h5 class="modal-title" id="Subscription"><div id="subscription_label">{{ $page_info['page_title'] }}</div></h5>
				<a href="{{ url('/admin/vehicle') }}"><button type="submit" class="btn btn-primary">Add Vehicle</button></a>
			</div>
		
            <div class="panel-body">
            <div id="example_wrapper" class="dataTables_wrapper no-footer">
					<table id="example" class="table table-hover table-striped">
						<thead>
							<tr role="row">
								<!-- th>Sr No.</th -->
								<th>Brand</th>
								<th>Model</th>
								<th>Model spec</th>
								<th>Release year</th>
								<th>Weight</th>
								<th>Manufacturer</th>
								<th>Vehicle type</th>
								<th>Width</th>
								<th>Wheel diameter</th>
								<th>Action</th>
							</tr>
						</thead>
						<!tbody>
						  @foreach ($vehicles as $vehicle)
							<tr role="row">
								<td>{{ $vehicle->brand }}</td>
								<td>{{ $vehicle->model }}</td>
								<td>{{ $vehicle->model_spec }}</td>
								<td>{{ $vehicle->release_year }}</td>
								<td>{{ $vehicle->weight }}</td>
								<td>{{ $vehicle->manufacturer }}</td>
								<td>{{ $vehicle->vehicle_type }}</td>
								<td>{{ $vehicle->width }}</td>
								<td>{{ $vehicle->wheel_diameter }}</td>
								<td>
									<a href="vehicle/{{$vehicle->_id}}" class="edit-user" data-id="{{ $vehicle->_id }}">Edit</a>
									/ <a href="javascript::void(0)" class="delete-user" data-token="{{ csrf_token() }}" data-id="{{ $vehicle->_id }}">Delete</a>
									/ <a href="vehicle-view/{{$vehicle->_id}}" class="edit-user" data-id="{{ $vehicle->_id }}">View</a>
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
			
			$('#example').DataTable({
					"scrollX": true
			});
		});			
	</script>		
	
@endsection






