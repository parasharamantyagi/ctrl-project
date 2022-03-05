@extends('layouts.appadmin')

@section('content')
	<style>
		.led-config { margin-left: 66%;}
		label { margin-bottom: .5rem; }
			/* Create two equal columns that floats next to each other */
		.column { float: left; width: 50%; padding: 10px;}
			/* Clear floats after the columns */
		.row:after { content: ""; display: table; clear: both; }
		.form-control { width: 65% !important; }
		
		.div_logo_image_image_130 { border: 2px solid #a4acb3; }
		.logo_image_image {width: 100%; height: 100%;}
		.pad4_image_image {width: 100%; height: 100%;}
		.div_logo_image_image {padding: 10px; margin: 10px; max-width: 117px; height: 51.5px; background-color: black;}
		.div_pad4_image_image_130 {padding: 10px; margin: 10px; width: 546.4px; background-color: black;}
		
		.div_icone_image_image_130 { width: 130px; height: 148px; border: 2px solid #a4acb3;}
		.div_div_larger_logo_image_130 { width: 250px; height: 145px; border: 2px solid #a4acb3; margin-left: 160px;}
		.icone_image_image {width: 100%; height: 100%;}
		.larger_logo_image {width: 100%; height: 100%;}
		.div_icone_image_image {padding: 10px; max-width: 117px; height: 123.4px; margin: 10px; background-color: black;}
		
		
		.pad3_image_image {width: 100%; height: 100%;}
		.div_pad3_image_image { border: 2px solid #a4acb3; padding: 7px; width: 403px; height: 128px; }
		.pad2_image_image {width: 225px; height:225px}
		.div_pad2_image_image { border: 2px solid #a4acb3; padding: 10px; width: 252px; height: 247px; }
		
		.form-border {border: 0.1px solid; border-radius: 0.25rem; padding: 2px;}
		textarea.form-control {border: 0.1px solid;}
	</style>
	<div class="page-content-wrap">
                    <!-- START ALERT BLOCKS -->
<!-- END ALERT BLOCKS -->                    	
		<form method="POST" action="" id="Updateuser" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="modal-header">
				<h5>{{ $page_info['page_title'] }}</h5>
				<div class="header-link">
					<?php if(isset($vehicle_id)) { ?>
						<a href="{{ url(user_role('vehicle-view/'.$vehicle_id)) }}" class="btn btn-secondary addvehicle-vehicle_info">Vehicle info</a>
						<a href="{{ url(user_role('settings'.$setting_id)) }}" class="btn btn-secondary addvehicle-settings">Settings</a>
						<a href="{{ url(user_role('create-new-car?vehicle_id='.$vehicle_id)) }}" class="btn btn-secondary addvehicle-led-config">LED config</a>
						<a href="{{ url(user_role('car-button?vehicle_id='.$vehicle_id)) }}" class="btn btn-secondary">Button config</a>
						<a href="{{ url(user_role('multimedia?vehicle_id='.$vehicle_id)) }}" class="btn btn-secondary">Multimedia</a>
						<a href="{{ url(user_role('led-motor-config?vehicle_id='.$vehicle_id)) }}" class="btn btn-secondary">Motor config</a>
						<a href="{{ url(user_role('upload-map?vehicle_id='.$vehicle_id)) }}" class="btn btn-secondary">Map</a>
					<?php }else{ ?>
						<a href="javascript:void(0)" class="btn btn-secondary addvehicle-vehicle_info empty">Vehicle info</a>
						<a href="javascript:void(0)" class="btn btn-secondary addvehicle-settings empty">Settings</a>
						<a href="javascript:void(0)" class="btn btn-secondary addvehicle-led-config empty">LED config</a>
						<a href="javascript:void(0)" class="btn btn-secondary addvehicle-Button-config">Button config</a>
						<a href="javascript:void(0)" class="btn btn-secondary addvehicle-Button-config">Multimedia</a>
						<a href="javascript:void(0)" class="btn btn-secondary addvehicle-Button-config">Motor config</a>
						<a href="javascript:void(0)" class="btn btn-secondary addvehicle-Button-config">Map</a>
					<?php } ?>
				</div>
			</div>
			
		<div class="modal-body">
			<div class="row">
				<div class="col-md-4">
						<div class="form-group">
							<label>Upload File</label><br />
							<div class="form-border">
							<input type="button" class="btn btn-light" data-id="logo_image" value="Choose File" /> <span id="p_logo_image"></span>
							<input type="file" class="form-control" name="logo_image" id="logo_image" style="display: none">
							</div>
						</div>
				</div>
				<div class="col-md-4">
						<div class="form-group">
							<label>Map image</label><br />
							<div class="form-border">
							<input type="button" class="btn btn-light" data-id="map_image" value="Choose File" /> <span id="p_map_image"></span>
							<input type="file" class="form-control" name="map_image" id="map_image" style="display: none">
							</div>
						</div>
				</div>
				<div class="col-md-4">
						<div class="form-group">
							<label>#</label><br />
							<input type="submit" class="btn btn-primary" value="Save changes" />
						</div>
				</div>
			</div>
			
			<div class="panel-body">
            <div id="example_wrapper" class="dataTables_wrapper no-footer">
					<table id="exampleViewVehicleInfoAll-qr" class="table table-hover table-striped vehicle_map_data">
						<thead>
							<tr role="row">
								<th class="qr-code-Art">Id</th>
								<th class="qr-code-Art">File name</th>
								<th class="qr-code-Art">Image</th>
								<th class="qr-code-Art">Vehicle id</th>
								<th class="qr-code-Action">Action</th>
							</tr>
						</thead>
						<tbody>
						@if($vehicle_maps->toArray())
						@foreach($vehicle_maps as $vehicle_map)
							@if($vehicle_map)
								<tr role="row">
									<td>{{ $vehicle_map->_id }}</td>
									<td>{{ $vehicle_map->file_name }}</td>
									<td><img src="{{ url($vehicle_map->map_image) }}" class="user_img img-circle" alt="Cinque Terre" /></td>
									<td>{{ $vehicle_map->vehicle_id }}</td>
									<td><a href="javascript::void(0)" class="delete-user" data-id="{{ $vehicle_map->_id }}" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-trash" title="Delete map"></i></a></td>
								</tr>
							@endif
						@endforeach
						@else
						<tr role="row"><td colspan="4" style="text-align: center">No map data found</td></tr>
						@endif
						</tbody>
					</table>

			</div>
			</div>
			
		</div>
			<div class="modal-footer">
					<input type="button" class="btn btn-secondary" onclick="form_return()" value="Back">
			</div>
		</form>
		       
    </div>


@endsection

@section('script')

<script>	
		
		// pad2_image
		// imgInp
		$(document).ready(function(){
			
			// function readNAME(input,id) {
			  // if (input.files && input.files[0]) {
				  // $("span[id='p_"+id+"']").text(input.files[0].name);
			  // }
			// }
			
			// function readURL(input,id) {
			  // if (input.files && input.files[0]) {
				// var reader = new FileReader();
				// reader.onload = function(e) {
				  // $('#'+id).attr('src', e.target.result);
				// }
				// reader.readAsDataURL(input.files[0]); // convert to base64 string
			  // }
			// }
			// var image_id = ['pad2_image','logo_image','icone_image','pad3_image','pad4_image','larger_logo'];
			
			 // $('input[type="file"]').change(function() {
				// if(image_id.includes(this.name)){
					// readURL(this,this.name+'_image');
				// }
				// readNAME(this,this.id);
			 // });
			
			$("input[class='btn btn-light']").click(function() {
				$("input[id='"+$(this).data('id')+"']").click();
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
