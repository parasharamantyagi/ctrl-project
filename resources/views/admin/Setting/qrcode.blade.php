@extends('layouts.appadmin')

@section('content')
<link rel="stylesheet" href="https://ebookbazaar.com/public/css/bootstrap-select.min.css">
<style>
		th.qr-code-code {
			width: 290px !important;
		}
		// th.qr-code-Model {
			// padding: 0px 20px;
		// }
		// th.qr-code-Brand {
			// padding: 0px 20px;
		// }
		// th.qr-code-Art {
			// padding: 0px 14px;
		// }
		// th.qr-code-Action {
			// padding: 0px 47px;
		// }
		.dataTables_wrapper .table td, .dataTables_wrapper .table th {
			text-align: center;
		}
		th {
			width: 25%;
		}
</style>
	<div class="page-content-wrap viewvehicleinfoall">


<div class="col-md-12">


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
								  <img class="d-block w-100" src="{{ url('/public/qrcode/qrcode.png') }}" alt="First slide">
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
				<h5 class="modal-title" id="Subscription"><div id="subscription_label">{{ $page_info['page_title'] }}</div></h5>
			</div>

            <div class="panel-body">
            <div id="example_wrapper" class="dataTables_wrapper no-footer">
					<table id="exampleViewVehicleInfoAll-qr" class="table table-hover table-striped users-table">
						<thead>
							<tr role="row">
								<th class="qr-code-code">QR code/Serial no</th>
								<th class="qr-code-Brand">Brand name</th>
								<th class="qr-code-Model">Car name</th>
								<th class="qr-code-Art">Art No</th>
								<th class="qr-code-Action">Action</th>
							</tr>
						</thead>
						<tbody>
						@foreach($all_Vehicle as $all_Vehicle)
							<tr role="row">
								<td>{{ implode(str_split($all_Vehicle->_id,4),'-') }}</td>
								<td>{{ $all_Vehicle->getvehicle->brand }}</td>
								<td>{{ $all_Vehicle->getvehicle->model }}</td>
								<td>{{ $all_Vehicle->getvehicle->art_no }}</td>
								<td><a href="javascript::void(0)" class="qr-code" data-id="{{ $all_Vehicle->_id }}" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-qrcode" title="View qr-code"></i></a></td>
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

</script>
  <script>
    
	jQuery(document).ready(function () {
		$('.viewvehicleinfoall #exampleViewVehicleInfoAll-qr').DataTable({
		  "pageLength": 50,
		  "scrollX": true,
		  "bInfo" : false,
		  "aaSorting": [[1, 'asc']],
		  "fnDrawCallback":function(){
			  if ($('#exampleViewVehicleInfoAll tr').length < 50) {
				$('.dataTables_paginate').hide();
			  }
			}
		  });
      });
	
  </script>


@endsection