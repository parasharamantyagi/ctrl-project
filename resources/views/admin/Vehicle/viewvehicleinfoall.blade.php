@extends('layouts.appadmin')

@section('content')
<style>
		.dataTables_filter label input
		{
			margin: 3px;
		}
		
		a i.fa {
			padding: 18px 4px 0px 0px;
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



<!-- END ALERT BLOCKS -->                    <!--<link href="https://ebookbazaar.com/public/css/bootstrap.min.css" rel="stylesheet">-->
<link rel="stylesheet" href="https://ebookbazaar.com/public/css/bootstrap-select.min.css">

<style>
	th {
		width: 25%;
	}
</style>
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
				<h5 class="modal-title" id="Subscription"><div id="subscription_label">{{ $page_info['page_title'] }}</div></h5>

				<input type="hidden" class="brand_name" value="<?php echo (isset($_GET['brand_name'])) ? $_GET['brand_name']:''; ?>">
       

				<a href="{{ url('/admin/vehicle') }}"><button type="submit" class="btn btn-primary">Add product</button></a>
			</div>
            <!-- ul class="panel-controls">
                <div class="col-sm-12 col-xs-12">
                    <form action="orderfilter" method="post">
                        <select name="mystatus" id="mystatus" class="selectpicker" data-show-subtext="true" data-live-search="true">
                            <option value="">Select Type</option>
                            <option value="unConfirmed" selected="selected">UnConfirmed</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="complete">Complete</option>
                        </select> <input type="hidden" name="_token" value="BBwBpO43tWx2memOGyR0DBRbFNzqdMjnqTV3poAG">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </ul -->

            <div class="panel-body">
            <div id="example_wrapper" class="dataTables_wrapper no-footer">
					<table id="exampleViewVehicleInfoAll" class="table table-hover table-striped users-table">
						<thead>
              <tr role="row">
								<!-- th>Sr No.</th>
								<th>Qr code</th -->
								<th>Brand name</th>
								<th>Model</th>
								<th>Model specification</th>
								<th>Release year</th>
								<th>Art&nbsp;No</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
					</table>

			</div>
			</div>
		</div>
</div>


@endsection

@section('script')
<script>

</script>
@if(session()->has('flash-message'))
  <script>
    jQuery(document).ready(function () {
      $.toaster({ priority : 'success', title : 'Success', message : "{{ session()->get('flash-message') }}" });
    });
  </script>
@endif


@endsection
