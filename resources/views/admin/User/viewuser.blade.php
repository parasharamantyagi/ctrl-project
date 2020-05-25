@extends('layouts.appadmin')

@section('content')
<style>
		.dataTables_filter label input
		{
			margin: 3px;
		}
		a i.fa {
			padding: 5px 2px;
		}
</style>


	<div class="page-content-wrap viewuser-parent">
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
				
				
				<select class="form-control viewuser" name="user_roll" id="user_roll" <?php if(user_role() != 'admin') { echo 'style="display: none;"';} ?>>
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
					<table id="example" class="table table-hover table-striped users-table">
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
		@if(session()->has('flash-message'))
		<script>
			jQuery(document).ready(function () {
				$.toaster({ priority : 'success', title : 'Success', message : "{{ session()->get('flash-message') }}" });
			});
		</script>
	@endif
		
	
@endsection






