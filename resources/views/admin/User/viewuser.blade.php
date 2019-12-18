@extends('layouts.appadmin')

@section('content')



	<div class="page-content-wrap">
                    <!-- START ALERT BLOCKS -->


                        
<!-- END ALERT BLOCKS -->                    <!--<link href="https://ebookbazaar.com/public/css/bootstrap.min.css" rel="stylesheet">-->
<link rel="stylesheet" href="https://ebookbazaar.com/public/css/bootstrap-select.min.css">

<style>
	th {
		width: 25% !important;
	}
</style>
<div class="col-md-12">
        <div class="panel panel-default">
			<div class="modal-header">
				<h5 class="modal-title" id="Subscription"><div id="subscription_label">{{ $page_info['page_title'] }}</div></h5>
				
				
				<select class="form-control viewuser" name="user_roll" id="user_roll">
						  <option value="0">Select roll</option>
						  @foreach(my_role() as $my_role)
							<option value="{{$my_role['_id']}}">{{ucfirst($my_role['roll'])}}</option>
						  @endforeach
				</select>
						
				<a href="{{ url('/admin/users/create') }}"><button type="submit" class="btn btn-primary">Add user</button></a>
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
					<table id="example" class="table table-hover table-striped">
						<thead>
							<tr role="row">
								<!-- th>Sr No.</th -->
								<th>Name</th>
								<th>Email</th>
								<th>Phone no</th>
								<th>Image</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<!--tbody>
						  @foreach ($users as $user)
							<tr role="row">
								<td>{{ $user->name }}</td>
								<td>{{ $user->email }}</td>
								<td>{{ $user->phone_no }}</td>
								<td><img src="{{ url('/public/assets/userimages/'.$user->image) }}" class="user_img img-circle" alt="Cinque Terre"></td>
								<td>
									<a href="users/{{$user->_id}}" class="edit-user" data-id="{{ $user->_id }}">edit</a>
									/ <a href="javascript::void(0)" class="delete-user" data-token="{{ csrf_token() }}" data-id="{{ $user->_id }}">delete</a>
								</td>
							</tr>
						  @endforeach
						</tbody -->
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
							content: 'Are you sure to delete this user ..?',
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
											url: "users/"+delete_id,
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
			
			var dataTable = jQuery('#example').DataTable({
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
				lengthMenu: [
					[50, 100, 250, 500, 999999],
					['50', '100', '250', '500', 'Show all']
				],
				"ajax": {
					"url": "{{ url('/admin/user-table') }}",
					"dataType": "json",
					"type": "POST",
					"data": function(data) {
						data._token = "{{ csrf_token() }}",
						data.user_roll = $('select[name="user_roll"]').val()	
					}
				},
				"columns": [
					{"data": "name"},
					{"data": "email"},
					{"data": "phone_no", "render": function(phone_no,type,full,meta){
							return (phone_no) ? phone_no : '';
					}},
					{"data": "image", "searchable": false, "orderable": false, "render": function(data_image,type,full,meta){
							return '<img src="../public/assets/userimages/'+data_image+'" class="user_img img-circle" alt="Cinque Terre">';
					}},
					{"data": "status", "searchable": false, "orderable": false, "render": function(data,type,full,meta){
						let user_status = (full.status == "1") ? 'active' : '';
							return '<button type="button" class="btn btn-sm btn-secondary btn-toggle '+user_status+'" data-toggle="button" aria-pressed="true" data-id="'+full._id+'" data-token="{{ csrf_token() }}" autocomplete="off"><div class="handle"></div></button>';
					}},
					{"data": "_id", "searchable": false, "orderable": false, "render": function(data,type,full,meta){
							return '<a href="users/'+data+'"><i class="fa fa-pencil-square-o" title="Edit user"></i></a> <a href="#" class="delete-user" data-id="'+data+'" data-token="{{ csrf_token() }}"><i class="fa fa-trash" title="Delete user"></i></a>';
					}},
				]
			});
			
			$(document).on('click', '.btn-secondary.btn-toggle', function(){
					$.ajax({
							url: "user-status",
							type: 'POST',
							dataType: "JSON",
							data: {
									"_token": $(this).data('token'),
									"status": $(this).attr("aria-pressed"),
									"id": $(this).data('id'),
							},
							success: function (response)
							{
								// $.toaster({ priority : 'success', title : 'Success', message : response.message });
							}
						});
			});
			
			$(document).on('change', 'select[name="user_roll"]', function(){
					dataTable.draw();
			});
			
			
		});			
	</script>		
	
		
	
@endsection






