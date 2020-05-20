@extends('layouts.appadmin')

@section('content')

<style>
.dataTables_filter label input
{
  margin: 3px;
}
th {
  width: 25%;
}
a i.fa {
    padding: 16px 0px 0px 0px;
}
// td.text_align.release_year_text_align {
			// text-align: center;
		// }
		table.dataTable thead th {
			padding: 3px 45px 3px 3px;
		}
</style>

	<div class="page-content-wrap viewvehicleinfoall">
                    <!-- START ALERT BLOCKS -->
					<!-- END ALERT BLOCKS -->                    
	<!--<link href="https://ebookbazaar.com/public/css/bootstrap.min.css" rel="stylesheet">-->
	<link rel="stylesheet" href="https://ebookbazaar.com/public/css/bootstrap-select.min.css">

<div class="col-md-12">
        <div class="panel panel-default">
			<div class="modal-header">
				<h5 class="modal-title" id="Subscription"><div id="subscription_label">{{ $page_info['page_title'] }}</div></h5>
				<a href="{{ url('/admin/vehicle') }}"><button type="submit" class="btn btn-primary">Add Vehicle</button></a>
			</div>
            <div class="panel-body">
            <div id="example_wrapper" class="dataTables_wrapper no-footer">
					<table id="exampleViewOwnedVehicleInfoAll" class="table table-hover table-striped">
						<thead>
							<tr role="row">
								<!-- th>Sr No.</th>
								<th>Qr code</th -->
								<th>Brand name</th>
								<th>Model</th>
								<th>Model specification</th>
								<th>Release year</th>
								<th>Art&nbsp;No</th>
								<!-- th>Product status</th -->
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
	@if(session()->has('flash-message'))
		<script>
			jQuery(document).ready(function () {
				$.toaster({ priority : 'success', title : 'Success', message : "{{ session()->get('flash-message') }}" });
			});
		</script>
	@endif
@endsection
