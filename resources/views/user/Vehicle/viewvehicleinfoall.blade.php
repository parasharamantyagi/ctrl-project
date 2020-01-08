@extends('layouts.appuser')

@section('content')



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
								<th>Brand</th>
								<th>Model</th>
								<th>Model spec</th>
								<th>Release year</th>
								<th>Weight</th>
								<th>Manufacturer</th>
								<th>Vehicle type</th>
								<th>Width</th>
								<th>Height</th>
								<th>Wheel diameter</th>
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
					{"data": "brand"},
					{"data": "model"},
					{"data": "model_spec"},
					{"data": "release_year"},
					{"data": "weight"},
					{"data": "manufacturer"},
					{"data": "vehicle_type"},
					{"data": "width"},
					{"data": "height"},
					{"data": "wheel_diameter"},
					{"data": "_id", "searchable": false, "orderable": false, "render": function(data,type,full,meta){
							return '<a href="setting/'+data+'" class="edit-user" data-id="'+data+'"><i class="fa fa-wrench" title="Vehicle setting"></i></a>';
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






