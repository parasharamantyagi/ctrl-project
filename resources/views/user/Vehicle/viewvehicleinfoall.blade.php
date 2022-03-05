@extends('layouts.appuser')

@section('content')

<style>


</style>

	<div class="page-content-wrap">
                    <!-- START ALERT BLOCKS -->


                        
<!-- END ALERT BLOCKS -->                    <!--<link href="https://ebookbazaar.com/public/css/bootstrap.min.css" rel="stylesheet">-->
<link rel="stylesheet" href="https://ebookbazaar.com/public/css/bootstrap-select.min.css">

<div class="col-md-12">
        <div class="panel panel-default">
			<div class="modal-header">
				<h5 class="modal-title" id="Subscription"><div id="subscription_label">{{ $page_info['page_title'] }}</div></h5>
			</div>
		
            <div class="panel-body">
            <div id="example_wrapper" class="dataTables_wrapper no-footer">
					<table id="example" class="table table-hover table-striped">
						<thead>
							<tr role="row">
								<th>Brand name</th>
								<th>Model</th>
								<th>Model specification</th>
								<th>Release year</th>
								<th>Art No</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						@foreach($vehicles as $vehicle)
							<tr>
								<th>{{$vehicle->vehicle_info->brand}}</th>
								<th>{{$vehicle->vehicle_info->model}}</th>
								<th>{{$vehicle->vehicle_info->model_spec}}</th>
								<th>{{$vehicle->vehicle_info->release_year}}</th>
								<th>{{$vehicle->vehicle_info->art_no}}</th>
								<th>
									<button type="button" class="btn btn-sm btn-secondary btn-toggle active" data-toggle="button" aria-pressed="true" autocomplete="off" disabled><div class="handle"></div></button>
								</th>
								<th><a href="{{'settings/'.$vehicle->_id}}" class="edit-user"><i class="fa fa-eye" title="View"></i></a></th>
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
			
			$('#example').DataTable({
				"bInfo" : false,
				"pageLength": 50,
				"fnDrawCallback":function(){
						if ($('#example tr').length < 50) {
							$('.dataTables_paginate').hide();
						}
				}
			});
				
			// $('#example').DataTable({
				// dom: 'lifrtp',
				// "scrollX": true,
				// "processing": true,
				// "serverSide": true,
				// "bInfo" : false,
				// "pageLength": 50,
				// "fnDrawCallback":function(){
						// if ($('#example tr').length < 50) {
							// $('.dataTables_paginate').hide();
						// }
				// },
				// lengthMenu: [
					// [50, 100, 250, 500, 999999],
					// ['50', '100', '250', '500', 'Show all']
				// ],
				// "ajax": {
					// "url": "{{ url('/user/vehicle') }}",
					// "dataType": "json",
					// "type": "POST",
					// "data": function(data) {
						// data._token = "{{ csrf_token() }}"
					// }
				// },
				// "columns": [
					// {"data": "vehicle_info","sClass":"text_align", "render": function(data,type,full,meta){
							// return data.brand;
					// }},
					// {"data": "vehicle_info","sClass":"text_align", "render": function(data,type,full,meta){
							// return data.model;
					// }},
					// {"data": "vehicle_info","sClass":"text_align", "render": function(data,type,full,meta){
							// return data.model_spec;
					// }},
					// {"data": "vehicle_info","sClass":"text_align", "render": function(data,type,full,meta){
							// return data.release_year;
					// }},
					// {"data": "vehicle_info","sClass":"text_align", "render": function(data,type,full,meta){
						// return data.art_no;
					// }},
					// {"data": "setting_status","sClass":"text_align", "render": function(data,type,full,meta){
							// return '<p class="setting_use_status btn-success">ACTIVE</p>';
					// }},
					// {"data": "_id", "searchable": false, "orderable": false, "render": function(data,type,full,meta){
							// return '<a href="settings/'+data+'" class="edit-user" data-id="'+full.vehicle_info._id+'"><i class="fa fa-wrench" title="Vehicle setting"></i></a>';
					// }},
				// ]
			// });
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






