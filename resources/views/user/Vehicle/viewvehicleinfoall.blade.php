@extends('layouts.appuser')

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
			</div>
		
            <div class="panel-body">
            <div id="example_wrapper" class="dataTables_wrapper no-footer">
					<table id="example" class="table table-hover table-striped">
						<thead>
							<tr role="row">
								<!-- th>Sr No.</th -->
								<th>Qr code</th>
								<th>Model</th>
								<th>Release year</th>
								<th>Daylight auto on</th>
								<th>Front motor</th>
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
					"url": "{{ url('/user/vehicle') }}",
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
					{"data": "daylight_auto_on","sClass":"text_align", "render": function(data,type,full,meta){
							return full.getvehicle.release_year;
					}},
					{"data": "daylight_auto_on","sClass":"text_align", "render": function(data,type,full,meta){
							return data;
					}},
					{"data": "front_motor","sClass":"text_align", "render": function(data,type,full,meta){
							return data;
					}},
					{"data": "setting_use_status","sClass":"text_align", "render": function(data,type,full,meta){
							return (data === '1') ? '<button type="submit" class="btn btn-danger vechile_status">USED</button>' : '<button type="submit" class="btn btn-success vechile_status">AVAILABLE</button>';
					}},
					{"data": "setting_status","sClass":"text_align", "render": function(data,type,full,meta){
							// if(data == "1")
								// var vechile_setting_status = 'active';
							// else
								// var vechile_setting_status = '';
							// return '<button type="button" class="btn btn-sm btn-secondary btn-toggle '+vechile_setting_status+'" data-id="'+full._id+'" data-token="{{ csrf_token() }}" data-toggle="button" aria-pressed="true" autocomplete="off"><div class="handle"></div></button>';
							return '<button type="submit" class="btn btn-success vechile_status">ACTIVE</button>';
					}},
					{"data": "_id", "searchable": false, "orderable": false, "render": function(data,type,full,meta){
							return '<a href="settings/'+data+'" class="edit-user" data-id="'+full.getvehicle._id+'"><i class="fa fa-wrench" title="Vehicle setting"></i></a>';
					}},
				]
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






