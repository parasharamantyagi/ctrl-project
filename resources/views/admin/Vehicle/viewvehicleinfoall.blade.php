@extends('layouts.appadmin')

@section('content')
<style>
		.dataTables_filter label input
		{
			margin: 3px;
		}
</style>


	<div class="page-content-wrap">
                    <!-- START ALERT BLOCKS -->



<!-- END ALERT BLOCKS -->                    <!--<link href="https://ebookbazaar.com/public/css/bootstrap.min.css" rel="stylesheet">-->
<link rel="stylesheet" href="https://ebookbazaar.com/public/css/bootstrap-select.min.css">

<style>
	th {
		width: 25%;
	}
</style>
<div class="col-md-12">
        <div class="panel panel-default">
			<div class="modal-header">
				<h5 class="modal-title" id="Subscription"><div id="subscription_label">{{ $page_info['page_title'] }}</div></h5>


        <!--select class="form-control selectpicker viewvechile_select" name="vehicle_id" id="vehicle_id">
						  <option value="0">Select vehicle</option>
						  @foreach($all_Vehicle as $all_Vehicle)
								<option value="{{$all_Vehicle->_id}}">{{ ucfirst($all_Vehicle->brand.' ('.$all_Vehicle->model.')') }}</option>
						  @endforeach
				</select -->

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
					<table id="example" class="table table-hover table-striped users-table">
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

    var dataTable = $('#example').DataTable({
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
        "url": "{{ url('/admin/vehicle-table') }}",
        "dataType": "json",
        "type": "POST",
        "data": function(data) {
          data._token = "{{ csrf_token() }}",
          data.vehicle_id = $('select[name="vehicle_id"]').val()
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
            return (data === 'on') ? '<p class="daylight_auto_on btn-success">On</p>' : '<p class="daylight_auto_on btn-danger">Off</p>';
        }},
        {"data": "setting_use_status","sClass":"text_align", "render": function(data,type,full,meta){
            return (data === '1') ? '<p class="setting_use_status btn-danger">USED</p>' : '<p class="setting_use_status btn-success">AVAILABLE</p>';
        }},
        {"data": "setting_status","sClass":"text_align", "render": function(data,type,full,meta){
            if(data == "1")
              var vechile_setting_status = 'active';
            else
              var vechile_setting_status = '';
            return '<button type="button" class="btn btn-sm btn-secondary btn-toggle '+vechile_setting_status+'" data-id="'+full._id+'" data-token="{{ csrf_token() }}" data-toggle="button" aria-pressed="true" autocomplete="off"><div class="handle"></div></button>';
        }},
        {"data": "_id", "searchable": false, "orderable": false, "render": function(data,type,full,meta){
            return '<a href="settings/'+data+'"><i class="fa fa-pencil-square-o" title="Edit setting"></i></a> <a href="#" class="delete-user" data-id="'+data+'" data-token="{{ csrf_token() }}"><i class="fa fa-trash" title="Delete vehicle"></i></a><br /><a href="vehicle-view/'+data+'" class="edit-user" data-id="'+data+'"><i class="fa fa-eye" title="View"></i></a><a href="vehicle/'+full.vehicle_id+'" class="edit-user" data-id="'+full.getvehicle._id+'"><i class="fa fa-wrench" title="Edit vehicle"></i></a>';
        }},
      ]
    });

    $(document).on('change', 'select[name="vehicle_id"]', function(){
        dataTable.draw();
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
