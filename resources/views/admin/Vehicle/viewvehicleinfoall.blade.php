@extends('layouts.appadmin')

@section('content')

<style>
table.dataTable thead th {
    padding: 3px 28px 7px 2px;
}
</style>

	<div class="page-content-wrap">
                    <!-- START ALERT BLOCKS -->


                        
<!-- END ALERT BLOCKS -->                    <!--<link href="https://ebookbazaar.com/public/css/bootstrap.min.css" rel="stylesheet">-->
<link rel="stylesheet" href="https://ebookbazaar.com/public/css/bootstrap-select.min.css">

<div class="col-md-12">
        <div class="panel panel-default">
			<div class="modal-header">
				<h5 class="modal-title" id="Subscription"><div id="subscription_label">{{ $page_info['page_title'] }}</div></h5>
				<select class="form-control selectpicker viewvechile_select" name="vehicle_id" id="vehicle_id">
						  <option value="0">Select roll</option>
						  @foreach(my_role() as $my_role)
							<option value="{{$my_role['_id']}}">{{ucfirst($my_role['roll'])}}</option>
						  @endforeach
				</select>
				<a href="{{ url('/admin/vehicle') }}"><button type="submit" class="btn btn-primary">Add product</button></a>
			</div>
		
            <div class="panel-body">
            <div id="example_wrapper" class="dataTables_wrapper no-footer">
					<table id="example" class="table table-hover table-striped">
						<thead>
							<tr role="row">
								<!-- th>Sr No.</th -->
								<th>Qr code</th>
								<th>Model</th>
								<th>Brand</th>
								<th>Release year</th>
								<th>Daylight auto</th>
								<th>Product status</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						  
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
							content: 'Are you sure to delete this Vehicle ..?',
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
                                },
                                cancel: function(){
                                },
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
			
			
			$('#example').DataTable({
				dom: 'lifrtp',
				"scrollX": true,
				// language: {
					// "infoFiltered": "",
					// processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
				// },
				"processing": true,
				"serverSide": true,
				"bInfo" : false,
				"pageLength": 50,
				"fnDrawCallback":function(){
						if ($('#example tr').length < 50) {
							$('.dataTables_paginate').hide();
						}
				},
				lengthMenu: [
					[50, 100, 250, 500, 999999],
					['50', '100', '250', '500', 'Show all']
				],
				"ajax": {
					"url": "{{ url('/admin/vehicle-table') }}",
					"dataType": "json",
					"type": "POST",
					"data": function(data) {
						data._token = "{{ csrf_token() }}"
					}
				},
				"columns": [
					{"data": "_id","sClass":"text_align", "render": function(data,type,full,meta){
							return data;
					}},
					{"data": "pad_background_color","sClass":"text_align", "render": function(data,type,full,meta){
							return full.getvehicle.model;
					}},
					{"data": "pad_background_color","sClass":"text_align", "render": function(data,type,full,meta){
							return full.getvehicle.brand;
					}},
					{"data": "daylight_auto_on","sClass":"text_align", "render": function(data,type,full,meta){
							return full.getvehicle.release_year;
					}},
					{"data": "daylight_auto_on","sClass":"text_align", "render": function(data,type,full,meta){
							return (data === 'on') ? '<p class="daylight_auto_on">On</p>' : '<p class="daylight_auto_off">Off</p>';
					}},
					{"data": "setting_use_status","sClass":"text_align", "render": function(data,type,full,meta){
							return (data === '1') ? '<button type="submit" class="btn btn-danger vechile_status">USED</button>' : '<button type="submit" class="btn btn-success vechile_status">AVAILABLE</button>';
					}},
					{"data": "setting_status","sClass":"text_align", "render": function(data,type,full,meta){
							if(data == "1")
								var vechile_setting_status = 'active';
							else
								var vechile_setting_status = '';
							return '<button type="button" class="btn btn-sm btn-secondary btn-toggle '+vechile_setting_status+'" data-id="'+full._id+'" data-token="{{ csrf_token() }}" data-toggle="button" aria-pressed="true" autocomplete="off"><div class="handle"></div></button>';
					}},
					{"data": "_id", "searchable": false, "orderable": false, "render": function(data,type,full,meta){
							return '<a href="vehicle/'+data+'"><i class="fa fa-pencil-square-o" title="Edit vehicle"></i></a> <a href="#" class="delete-user" data-id="'+data+'" data-token="{{ csrf_token() }}"><i class="fa fa-trash" title="Delete vehicle"></i></a><br /><a href="vehicle-view/'+data+'" class="edit-user" data-id="'+data+'"><i class="fa fa-eye" title="View"></i></a><a href="vehicle-setting/'+data+'" class="edit-user" data-id="'+full.getvehicle._id+'"><i class="fa fa-wrench" title="Vehicle setting"></i></a>';
					}},
				]
			});
			$(document).on('click', '.btn-secondary.btn-toggle', function(){
					$.ajax({
							url: "./vehicle-setting-status",
							type: 'POST',
							dataType: "JSON",
							data: {
									"_token": $(this).data('token'),
									"status": $(this).attr("aria-pressed"),
									"id": $(this).data('id'),
							}
						});
			});
		});			
	</script>		
	@if(session()->has('flash-message'))
		<script>
			jQuery(document).ready(function () {
				$.toaster({ priority : 'success', title : 'Success', message : "{{ session()->get('flash-message') }}" });
			});
		</script>
	@endif
@endsection






