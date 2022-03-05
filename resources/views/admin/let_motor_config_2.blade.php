<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="_token" content="{{ csrf_token() }}" base_url="{{ url('') }}">

  <title>CTRL</title>
  

  <!-- Bootstrap core CSS -->
  <link href="{{ url('/newbootstrap/vendor/bootstrap/css/bootstrap.css') }}" rel="stylesheet">  
  <link rel="stylesheet" type="text/css" href="{{ url('/assets/bootstrap/jquery.dataTables.css') }}">
  <link rel="stylesheet" type="text/css" id="a" href="{{ url('/users/custom.css') }}"/>
  
  
  <!-- Custom fonts for this template -->
  <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet">
  <link href="{{ url('/newbootstrap/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="{{ url('/newbootstrap/css/resume.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{ url('/assets/bootstrap/jquery-confirm.min.css') }}">
  <link rel="stylesheet" href="{{ url('/newbootstrap/datetimepicker/jquery-ui.css') }}">
  <link rel="stylesheet" href="{{ url('/assets/bootstrap/select2.min.css') }}">
	<style>
	.col-sm-led-config-button.empty {height: 140px;}
	.modal-dialog.entrance-modal-dialog {max-width: 1200px;}
	.modal-dialog.image-selected{max-width: 1020px;}
	.entrance_on_mode_parent{border: 22px solid;margin-left: 6px;color: #000000de;width: 212px;border-radius: 7px;height: 132px;}
	.entrance_on_mode{background-repeat: round;background-size: cover;height: 100%;width: 100%;font-size: 18px;border: #ffff;background-color: #ffff;}
	.entrance_off_mode_parent{border: 22px solid;margin-left: 6px;color: #000000de;width: 212px;border-radius: 7px;height: 132px;}
	.entrance_off_mode{background-repeat: round;background-size: cover;height: 100%;width: 100%;font-size: 18px;color: #ffffff;border: #ffff;background-color: #ffff;}
	img.image_picker_image {width: 220px;height: 140px;}
	.button-option-ceil{display: block;z-index: 1050;position: absolute;background: #eae9e9;padding: 5px;border-radius: 0.25rem;width: 235px;}
	.form-control {width: 100% !important;}
	.text-size-margin {padding: 0px 0px 35px;}
	li div.thumbnail {padding: 0px !important;}
	ul.thumbnails.image_picker_selector li .thumbnail.selected {background: #b8c1c5 !important;}
	select.select_button_type {border-radius: .25rem; width: 100px; height: 39px;}
	.entrance_on_mode_div {margin: 7px;}
	.entrance_off_mode_div {margin: 7px;}
	</style>
	<link href="{{ url('users/toggle-switch.css') }}" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="https://rvera.github.io/image-picker/examples.css">
	<link rel="stylesheet" type="text/css" href="https://rvera.github.io/image-picker/image-picker/image-picker.css">

</head>

<div class="modal fade" id="entrance_west_building_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog entrance-modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
		
		<!--      popup model start   -->
				<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
				  <div class="modal-dialog image-selected" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<!-- h5>QR-CODE</h5 -->
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
							<div id="carouselExampleControls" class="carousel slide" data-ride="carousel2">
							  <div class="carousel-inner">
								<div class="carousel-item active" id="image_item_active">
								  <select class="image-picker">
									<option value=''></option>
									<option data-img-src='http://52.21.91.157/assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_1.png' value='./../assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_1.png'>Cute Kitten 1</option>
									<option data-img-src='http://52.21.91.157/assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_2.png' value='./../assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_2.png'>Cute Kitten 2</option>
									<option data-img-src='http://52.21.91.157/assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_3.png' value='./../assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_3.png'>Cute Kitten 3</option>
									<option data-img-src='http://52.21.91.157/assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_4.png' value='./../assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_4.png'>Cute Kitten 3</option>
									
									<option data-img-src='http://52.21.91.157/assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_5.png' value='./../assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_5.png'>Cute Kitten 3</option>
									<option data-img-src='http://52.21.91.157/assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_6.png' value='./../assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_6.png'>Cute Kitten 3</option>
									<option data-img-src='http://52.21.91.157/assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_7.png' value='./../assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_7.png'>Cute Kitten 3</option>
									<option data-img-src='http://52.21.91.157/assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_8.png' value='./../assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_8.png'>Cute Kitten 3</option>
									
									<option data-img-src='http://52.21.91.157/assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_9.png' value='./../assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_9.png'>Cute Kitten 3</option>
									<option data-img-src='http://52.21.91.157/assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_10.png' value='./../assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_10.png'>Cute Kitten 3</option>
									<option data-img-src='http://52.21.91.157/assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_11.png' value='./../assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_11.png'>Cute Kitten 3</option>
									<option data-img-src='http://52.21.91.157/assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_12.png' value='./../assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_12.png'>Cute Kitten 3</option>
									<option data-id="imgpsh_fullsize_anim_13" data-img-src='http://52.21.91.157/assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_13.png' value='./../assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_13.png'>Cute Kitten 3</option>
								  </select>
								</div>
							  </div>
							</div>
							
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary save button-image" data-val="">Done</button>
						<button type="button" class="btn btn-secondary cancel button-image">Cancel</button>
						<!-- button type="button" class="btn btn-primary">Save changes</button -->
					  </div>
					</div>
				  </div>
				</div>
		<!--      End   -->
		<div class="modal-body">
		<div class="row">
		<div class="col-md-3" style="text-align: center;">
		<p>
			<button class="btn btn-secondary cacnel-slider" data-dismiss="modal">Cancel</button>
			<select name="select_button_type" class="select_button_type">
				<option value="led">LED</option>
				<option value="motor">MOTOR</option>
				<option value="sound">SOUND</option>
			</select>
		</p>
		<img style="width: 68px;" src="http://52.21.91.157/users/entrance-west-building/icon2.png">
		</div>
		<div class="col-md-6" style="text-align: center;">
		
		<h4 style="display: -webkit-inline-box;"><div style="width: 300px;" class="btnconfigurator"><div class="btnconfiguratorclass">Entrance west building</div></div><a href="javascript:void(0)" class="fa-copy-fa-clone"><i class="fa fa-clone" aria-hidden="true"></i></a></h4>
		<br />
		<input name="vehicle_id" type="hidden" value="{{$vehicle_id}}"/>
		<input name="sequence_name" type="hidden" value=""/>
		<input name="is_copy" type="hidden" value="0"/>
		<b class="b_sequence_name">(LED SEQUENCE 20)</b>
			<div class="switch-toggle switch-3 switch-candy">
			  <input id="on" name="state-d" type="radio" checked="" value="manual"/>
			  <label for="on" onclick="">&nbsp;</label>

			  <input id="na" name="state-d" type="radio" checked="checked" value="random" />
			  <label for="na" class="disabled" onclick="">&nbsp;</label>

			  <input id="off" name="state-d" type="radio" value="blockly" />
			  <label for="off" onclick="">&nbsp;</label>
			  <a></a>
			</div>
			<div class="">
				<b style="margin: 45px;">Manual</b>
				<b style="margin: 45px;">Random</b>
				<b style="margin: 45px;">Blockly</b>
			</div>
			<button type="button" class="btn btn-secondary copy-on-mode">Copy</button>
		</div>
		<div class="col-md-3" style="text-align: center;">
		<p style="margin-left: 100px;">
			<input type="submit" class="btn btn-secondary save-entrance" value="Save" style="margin-right: 5px;">
			<input type="submit" class="btn btn-secondary save-entrance delete" value="Delete">
		</p>
		<input type="hidden" class="form-control" name="button_title" value="" >
		<input type="hidden" class="form-control" name="sequence_text" value="" >
		<input type="hidden" class="form-control" name="on_sequence_text_name" value="" >
		<input type="hidden" class="form-control" name="off_sequence_text" value="" >
		<input type="hidden" class="form-control" name="off_sequence_text_name" value="" >
		<input type="hidden" class="form-control" name="led_motor_config" value="on" >
		<img style="width: 55px;" src="http://52.21.91.157/users/entrance-west-building/icon1.jpg">
		</div>
		</div>
		<div class="row">
		<div class="col-md-6" style="text-align: center;border-right: 2px solid;">
		<div id="ctrlscrolbar"></div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<p>ON MODE:</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div style="display: -webkit-inline-box;"><p style="display: -webkit-inline-box;">Text colour: Colour picker 
				<input type="hidden" class="form-control" name="on_mode_color_1" value="#d1d1d2" id="background_color" style="width: 45px; margin-left: 5px;">
				<input type="color" class="form-control" name="on_mode_color_2" value="#181921" id="background_color" style="width: 45px !important; margin-left: 5px;">
				</p>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
			<p style="display: -webkit-inline-box;">Align text: <select name="on_mode_align_text" class="form-control" id="background_color" style="width: 210px; margin-left: 5px;">
				<option value="left" >Left</option>
				<option value="right" >Right</option>
				<option value="center" >Centre</option>
			</select></p>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<p style="display: -webkit-inline-box;">Image: 
				<button class="btn btn-light on-mode" style="width: 210px; margin-left: 5px;">Choose file</button></p>
				<input type="hidden" value="" name="on_mode_image" id="background_color">
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div style="display: -webkit-inline-box;"><p>Preview: 
					<div class="entrance_on_mode_parent">
						<button class="entrance_on_mode">
							<div class="entrance_on_mode_div"></div>
						</button>
					</div>
				</div>
				</p>
			</div>
		</div>
		</div>
		
		<div class="col-md-6" style="text-align: center;">
		
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<p>OFF MODE:</p>
				</div>
			</div>
		</div>
		
		
		<div class="row">
			<div class="col-md-12">
				<div style="display: -webkit-inline-box;"><p style="display: -webkit-inline-box;">Text colour: Colour picker 
					<input type="hidden" class="form-control" name="off_mode_color_1" value="#868e96" id="background_color" style="width: 45px; margin-left: 5px;">
					<input type="color" class="form-control" name="off_mode_color_2" value="#f5d6d6" id="background_color" style="width: 45px !important; margin-left: 5px;">
					</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<p style="display: -webkit-inline-box;">Align text: 
				<select name="off_mode_align_text" class="form-control" id="background_color" style="width: 210px; margin-left: 5px;">
					<option value="left" >Left</option>
					<option value="right" >Right</option>
					<option value="center" >Centre</option>
				</select></p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<p style="display: -webkit-inline-box;">Image: 
				<button class="btn btn-light off-mode" style="width: 210px; margin-left: 5px;">Choose file</button></p>
				<input type="hidden" value="" name="off_mode_image" id="background_color">
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div style="display: -webkit-inline-box;"><p>Preview: 
					<div class="entrance_off_mode_parent">
						<button class="entrance_off_mode">
							<div class="entrance_off_mode_div"></div>
						</button>
					</div>
				</p>
				</div>
			</div>
		</div>
		</div>
		</div>
	</div>
			
      </div>
    </div>
  </div>
</div>


<body id="page-top" style="padding-left: 0px;">
		<div class="container-fluid p-0">
			<div class="page-content-wrap">
                    <!-- START ALERT BLOCKS -->


                        
<!-- END ALERT BLOCKS -->                    	
			<form method="POST" action="javascript:void(0)" id="Updateuser" enctype="multipart/form-data">
<input type="hidden" name="_token" value="tyuBIz44UH9Ipf8cuoUMlEQ1YTiEWoMmm4BFBnjv">
<div class="modal-header">
<!-- h5>Led motor config</h5 -->
	<div class="btn-firs-toggle">
		<button class="btn-secondary-toggle"><i class="fa fa-bars fa-2x" aria-hidden="true"></i></button>
		<div class="button-option-ceil" style="display: none;">
			<p><button class="btn btn-secondary back">Back</button></p>
			<p><button class="btn btn-secondary undo">Undo</button></p>
			<p><button class="btn btn-secondary download">Download</button></p>
			<p><button class="btn btn-secondary entrance-motor-config">Entrance motor config</button></p>
			<p><button class="btn btn-secondary LED_sequence_config">LED sequence config</button></p>
			<p><button class="btn btn-secondary LED_EXTERNAL_BOARD_ID">LED EXTERNAL BOARD ID</button></p>
		</div>
	</div>
<div class="header-link">
						<!-- input type="button" class="btn btn-secondary led-motor-config" value="Download">
						<a href="entrance-west-building" class="btn btn-secondary addvehicle-settings edit">Entrance west building</a -->			
				</div>
</div>
<input type="hidden" name="id" value="603354acfdd6df3dc16b2042" id="id">
<div class="modal-body led-motor-config">
	
	<div class="bg_3x" style='width: 2640px; height: 1680px; background-image: url("./../img/imgpsh_fullsize_anim_box.png"); background-repeat: no-repeat; background-size: cover;'>
	
		<div class="row" style="margin: 1px;">
		@for ($i = 0; $i < 144; $i++)
			@php $led_sequence = 'LED_SEQUENCE_'.($i+1); @endphp
			@php $sequence_led_motor = sequence_led_motor_config($ledMotor_buttons,$led_sequence); @endphp
			@php $image_class_margin = ''; @endphp
			@if($sequence_led_motor)
			@if(array_key_exists('on_mode_image',$sequence_led_motor) && $sequence_led_motor['on_mode_image'] != "assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_12.png") @php $image_class_margin = "text-size-margin"; @endphp @endif
			<div class="col-sm-led-config-button" data-key="LED_SEQUENCE_{{$i+1}}" ondrop="dropThis(event)" ondragover="allowDropThis(event)" id="drags_parent_{{$i+1}}">
				<button class="led-and-config-button sequence none" @if(array_key_exists('on_mode_image',$sequence_led_motor)) style="background-image: url(./../{{$sequence_led_motor['on_mode_image']}}) !important; background: transparent;background-repeat: no-repeat; background-size: 219px;" @endIf draggable="true" ondragstart="dragThis(event)" id="{{$sequence_led_motor['sequence_name']}}" data-key="{{$sequence_led_motor['sequence_name']}}" data-name="{{$sequence_led_motor['sequence_name']}}">
					<div style="color:{{$sequence_led_motor['on_mode_color_2']}};text-align: {{$sequence_led_motor['on_mode_align_text']}};margin: 6px;font-size: 20px;" class="{{$image_class_margin}}"><?php echo $sequence_led_motor['sequence_text']; ?></div>
				</button>
			</div>
			@else
			<div class="col-sm-led-config-button empty" data-key="LED_SEQUENCE_{{$i+1}}" ondrop="dropThis(event)" ondragover="allowDropThis(event)" id="drags_parent_{{$i+1}}">
			</div>
			@endif
		@endfor
		</div>
	</div>
	
</div>
<div class="modal-footer">

<!-- input type="button" class="btn btn-secondary" onclick="form_return()" value="Back" />
<input type="submit" class="btn btn-primary clear-changes" value="Clear changes" / -->
</div>
</form>
		
		
                    
    </div>
			
	</div>

  <!-- Bootstrap core JavaScript -->
  
  
  
  
  <script src="{{ url('/newbootstrap/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ url('/newbootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script type="text/javascript" src="{{ url('/assets/jquery/custom.js') }}"></script>
  <!-- Plugin JavaScript -->
  <script src="{{ url('/newbootstrap/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script type='text/javascript' src="{{ url('/assets/jquery/jquery.dataTables.min.js') }}"></script>
  <!-- Custom scripts for this template -->
  <script src="{{ url('/newbootstrap/js/resume.min.js') }}"></script>
  <script type="text/javascript" src="{{ url('/assets/jquery/jquery.toaster.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
  <script type="text/javascript" src="{{ url('/newbootstrap/datetimepicker/jquery-ui.js') }}"></script>
  <script type="text/javascript" src="{{ url('/assets/jquery/select2.min.js') }}"></script>
  <script type="text/javascript" src="./../users/admin-scripts.js"></script>
  <script src="https://rvera.github.io/image-picker/js/prettify.js" type="text/javascript"></script>
	<script src="https://rvera.github.io/image-picker/js/jquery.masonry.min.js" type="text/javascript"></script>
	<script src="https://rvera.github.io/image-picker/js/show_html.js" type="text/javascript"></script>
	<script src="https://rvera.github.io/image-picker/image-picker/image-picker.js" type="text/javascript"></script>
		<script>
		$(document).ready(function(){
			function download(file, text) {
				var element = document.createElement('a');
				element.setAttribute('href', 'data:text/plain;charset=utf-8, '
									 + encodeURIComponent(text));
				element.setAttribute('download', file);
				document.body.appendChild(element);
				element.click();
				document.body.removeChild(element);
			}
			
			$.singleDoubleClick = function(singleClk, doubleClk) {
				return (function() {
				  var alreadyclicked = false;
				  var alreadyclickedTimeout;

				  return function(e) {
					if (alreadyclicked) {
					  // double
					  alreadyclicked = false;
					  alreadyclickedTimeout && clearTimeout(alreadyclickedTimeout);
					  doubleClk && doubleClk(e);
					} else {
					  // single
					  alreadyclicked = true;
					  alreadyclickedTimeout = setTimeout(function() {
						alreadyclicked = false;
						singleClk && singleClk(e);
					  }, 300);
					}
				  }
				})();
			  }
			  
			function entranceAjaxFunction(sequence_name){
				let btnconfigurator_class = '<div class="btnconfiguratorclass">Entrance west building</div>';
				$('#ctrlscrolbar').html('<div class="author_loading"><img src="{{ url("ctrl-icon/loder.gif") }}" height="150" width="150"></div>');
				let sequence_name_1 = sequence_name.replace("_", " ");
				let sequence_name_2 = sequence_name_1.replace("_", " ");
				$('.b_sequence_name').html(sequence_name_2);
				$('div[class="btnconfigurator"]').html(btnconfigurator_class);
				$('input[name="sequence_name"]').val(sequence_name);
				$('input[name="button_title"]').val('Entrance west building');
				$('input[name="is_copy"]').val("0");
				$('input[name="sequence_text"]').val('');
				$('input[name="off_sequence_text"]').val('');
				$('input[name="on_sequence_text_name"]').val('');
				$('input[name="off_sequence_text_name"]').val('');
				$('input[name="led_motor_config"]').val('on');
				$('input[name="on_mode_color_1"]').val('#d1d1d2');
				$('input[name="on_mode_color_2"]').val('#181921');
				$('select[name="on_mode_align_text"]').val('left');
				$('input[name="on_mode_image"]').val('');
				
				$('input[name="off_mode_color_1"]').val('#868e96');
				$('input[name="off_mode_color_2"]').val('#f5d6d6');
				$('select[name="off_mode_align_text"]').val('left');
				$('select[name="select_button_type"]').val('led');
				$('input[name="off_mode_image"]').val('');
				
				$('.entrance_on_mode').css('background-image','');
				$('.entrance_off_mode').css('background-image','');
				$('select[name="on_mode_image"]').val('');
				
				$('.entrance_on_mode_div').html('');
				$('.entrance_off_mode_div').html('');
			
				$.ajax({
						url: "entrance-west-building-clone",
						type: 'POST',
						dataType: "JSON",
						data: {
								"type": 'get_entrance_west_building',
								"sequence_name": sequence_name,
								"vehicle_id": $('input[name="vehicle_id"]').val(),
								"_token": $('meta[name="_token"]').attr('content'),
						},
						success: function (response)
						{
							$('#ctrlscrolbar').html('');
							$('input[name="on_mode_color_2"]').val(response.on_mode_color_2);
							$('input[name="off_mode_color_2"]').val(response.off_mode_color_2);
							$('.entrance_on_mode_div').css('color',response.on_mode_color_2);
							$('.entrance_off_mode_div').css('color',response.off_mode_color_2);
							
							if(response.on_mode_color_2){
								$('input[name="on_mode_color_2"]').val(response.on_mode_color_2);
							}
							if(response.off_mode_color_2){
								$('input[name="off_mode_color_2"]').val(response.off_mode_color_2);
							}
							if(response._id){
								$('input[name="sequence_name"]').val(sequence_name);
								$('input[name="led_motor_config"]').val(response.led_motor_config);
								$('input[name="on_mode_image"]').val(response.on_mode_image);
								$('input[name="off_mode_image"]').val(response.off_mode_image);
								$('input[name="off_sequence_text"]').val(response.off_sequence_text);
								$('input[name="on_sequence_text_name"]').val(response.on_sequence_text_name);
								$('input[name="off_sequence_text_name"]').val(response.off_sequence_text_name);
								$('select[name="on_mode_align_text"]').val(response.on_mode_align_text);
								$('select[name="off_mode_align_text"]').val(response.off_mode_align_text);
								
								$('.entrance_on_mode_div').removeClass("text-size-margin");
								$('.entrance_on_mode_div').css('text-align',response.on_mode_align_text);
								$('.entrance_on_mode_div').html(response.on_sequence_text_name);
								
								
								
								$('.entrance_off_mode_div').removeClass("text-size-margin");
								
								$('.entrance_off_mode_div').css('text-align',response.off_mode_align_text);
								$('.entrance_off_mode_div').html(response.off_sequence_text);
								
								if(response.button_title){
									btnconfigurator_class = '<div class="btnconfiguratorclass">'+response.button_title+'</div>';
									$('input[name="button_title"]').val(response.button_title);
									$('div[class="btnconfigurator"]').html('<div class="btnconfiguratorclass">'+btnconfigurator_class+'</div>');
								}
								
								if(response.on_mode_image){
									$('div[class="btnconfigurator"]').html('<div class="btnconfiguratorclass">'+btnconfigurator_class+'</div>');
									$('.entrance_on_mode').css('background-image','url(./../'+response.on_mode_image+')');
									if(response.on_mode_image != "assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_12.png"){
										$('div[class="entrance_on_mode_div"]').addClass("text-size-margin");
									}
								}
								if(response.off_mode_image){
									$('div[class="btnconfigurator"]').html('<div class="btnconfiguratorclass">'+btnconfigurator_class+'</div>');
									$('.entrance_off_mode').css('background-image','url(./../'+response.off_mode_image+')');
									if(response.off_mode_image != "assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_12.png"){
										$('div[class="entrance_off_mode_div"]').addClass("text-size-margin");
									}
								}
								if(response.sequence_text){
									$('div[class="btnconfigurator"]').html('<div class="btnconfiguratorclass">'+btnconfigurator_class+'</div>');
									$('input[name="sequence_text"]').val(response.sequence_text);
								}
								if(response.off_sequence_text){
									$('div[class="btnconfigurator"]').html('<div class="btnconfiguratorclass">'+btnconfigurator_class+'</div>');
									$('input[name="off_sequence_text"]').val(response.off_sequence_text);
								}
								$('select[name="select_button_type"]').val(response.select_button_type);
							}
						}
				});
			}
			
			var DELAY = 700,
				clicks = 0,
				timer = null;
			let text_size_margin = "";
			$(".col-sm-led-config-button").on("click", function(e){
				clicks++;  //count clicks
				if(clicks === 1) {
					let data_key = $(this).data('key');
					timer = setTimeout(function() {
						// console.log('single click');
						$.ajax({
								url: "entrance-west-building-clone",
								type: 'POST',
								dataType: "JSON",
								data: {
										"type": 'change_button_name',
										"sequence_name": data_key,
										"vehicle_id": $('input[name="vehicle_id"]').val(),
										"_token": $('meta[name="_token"]').attr('content'),
								},
								success: function (response)
								{
									
									if(response.on_mode_image){
										$('button[id="'+response.sequence_name+'"]').css('background-image','url(./../'+response.on_mode_image+')');
										if(response.on_mode_image != 'assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_12.png'){
											text_size_margin = 'text-size-margin';
										}else{
											text_size_margin = '';
										}
									}else{
										$('button[id="'+response.sequence_name+'"]').css('background-image','');
									}
									if(response.sequence_text){
										$('button[id="'+response.sequence_name+'"]').html('<div style="color:'+response.on_mode_color_2+'; text-align:'+response.on_mode_align_text+';margin: 6px;font-size: 20px;" class="'+text_size_margin+'">'+response.sequence_text+'</div>');
									}else{
										$('button[id="'+response.sequence_name+'"]').html('<div style="color:#181921;"></div>');
									}
								}
						});
					
						// console.log(data_key);
						clicks = 0;  //after action performed, reset counter
					}, DELAY);
				} else {
					clearTimeout(timer);  //prevent single-click action
					console.log('double click');
					$('#entrance_west_building_model').modal();
					entranceAjaxFunction($(this).data('key'));
					clicks = 0;  //after action performed, reset counter
				}
			})
			.on("dblclick", function(e){
				e.preventDefault();  //cancel system double-click event
			});
			
			$('input[class="btn btn-secondary save-entrance delete"]').on("click", function(event){
					if(confirm('Are you sure to delete this button ..?')){
						let sequence_name = $('input[name="sequence_name"]').val();
						$.ajax({
							url: "entrance-west-building-clone",
							type: 'POST',
							dataType: "JSON",
							data: {
									"type": 'delete_led_sequence',
									"sequence_name": sequence_name,
									"vehicle_id": $('input[name="vehicle_id"]').val(),
									"_token": $('meta[name="_token"]').attr('content'),
							},
							success: function (response)
							{
								if(response.status){
									location.reload();
								}
							}
						});
										
						// location.reload();
					}
			});
			
			$('input[class="btn btn-secondary save-entrance"]').on("click", function(event){
					let button_title = $('input[name="button_title"]').val();
					if(button_title == 'Entrance west building'){
						alert('Please add button title');
						return false;
					}else{
						$.ajax({
							url: "entrance-west-building-clone",
							type: 'POST',
							data: {
									"type": 'save-entrance-west-building',
									"vehicle_id": $('input[name="vehicle_id"]').val(),
									"_token": $('meta[name="_token"]').attr('content'),
									"sequence_name": $('input[name="sequence_name"]').val(),
									"led_motor_config": $('input[name="led_motor_config"]').val(),
									"on_mode_color_2": $('input[name="on_mode_color_2"]').val(),
									"off_mode_color_2": $('input[name="off_mode_color_2"]').val(),
									"on_mode_image": $('input[name="on_mode_image"]').val(),
									"off_mode_image": $('input[name="off_mode_image"]').val(),
									"on_mode_align_text": $('select[name="on_mode_align_text"]').val(),
									"off_mode_align_text": $('select[name="off_mode_align_text"]').val(),
									"sequence_text": $('input[name="sequence_text"]').val(),
									"on_sequence_text_name": $('input[name="on_sequence_text_name"]').val(),
									"off_sequence_text_name": $('input[name="off_sequence_text_name"]').val(),
									"select_button_type": $('select[name="select_button_type"]').val(),
									"off_sequence_text": $('input[name="off_sequence_text"]').val(),
									"button_title": button_title
							},
							success: function (response)
							{
								if(response.status){
									location.reload();
								}
							}
						});
					}
			});
			
			// $('input[class="btn btn-primary clear-changes"]').on("click", function(event){
					// $.ajax({
						// url: "entrance-west-building-clone",
						// type: 'POST',
						// dataType: "JSON",
						// data: {
								// "type": 'clear_led_config',
								// "_token": $('meta[name="_token"]').attr('content'),
						// },
						// success: function (response)
						// {
							// if(response.status){
								// location.href = "";
							// }
						// }
					// });
			// });
			
			$('a[class="fa-copy-fa-clone"]').on("click", function(event){
				let sequence_name = $('input[name="sequence_name"]').val();
				let button_title = $('input[name="button_title"]').val();
				if(button_title == 'Entrance west building'){
						alert('Please add button title');
						return false;
					}
				$.ajax({
					url: "entrance-west-building-clone",
					type: 'POST',
					dataType: "JSON",
					data: {
							"type": 'button_clone',
							"_token": $('meta[name="_token"]').attr('content'),
							"sequence_name": sequence_name,
							"vehicle_id": $('input[name="vehicle_id"]').val(),
							"led_motor_config": $('input[name="led_motor_config"]').val(),
							"on_mode_color_2": $('input[name="on_mode_color_2"]').val(),
							"off_mode_color_2": $('input[name="off_mode_color_2"]').val(),
							"on_mode_image": $('input[name="on_mode_image"]').val(),
							"off_mode_image": $('input[name="off_mode_image"]').val(),
							"on_mode_align_text": $('select[name="on_mode_align_text"]').val(),
							"off_mode_align_text": $('select[name="off_mode_align_text"]').val(),
							"sequence_text": $('input[name="sequence_text"]').val(),
							"on_sequence_text_name": $('input[name="on_sequence_text_name"]').val(),
							"on_mode_color_1": $('input[name="on_mode_color_1"]').val(),
							"off_mode_color_1": $('input[name="off_mode_color_1"]').val(),
							"select_button_type": $('select[name="select_button_type"]').val(),
							"off_sequence_text": $('input[name="off_sequence_text"]').val(),
							"off_sequence_text_name": $('input[name="off_sequence_text_name"]').val(),
							"button_title": button_title
					},
					success: function (response)
					{
						if(response.status){
								location.reload();
							}
						// on_mode_color_1
						// if(response.status){
							// var myJSON = JSON.stringify(response.data);
							// download('data.json',myJSON);
						// }
					}
				});
				
				// console.log(sequence_name);
			});
			
			// $('div[class="col-sm-led-config-button empty"]').on("click", function(event){
				// $('#entrance_west_building_model').modal();
				// entranceAjaxFunction($(this).data('key'));
				// location.href = "entrance-west-building?name="+$(this).data('key');
			// });
			
			$('input[class="btn btn-secondary led-motor-config"]').on("click", function(event){
				$.ajax({
					url: "entrance-west-building-clone",
					type: 'POST',
					dataType: "JSON",
					data: {
							"type": 'json_file',
							"_token": $('meta[name="_token"]').attr('content'),
					},
					success: function (response)
					{
						if(response.status){
							var myJSON = JSON.stringify(response.data);
							download('data.json',myJSON);
						}
					}
				});
			});
			
			$('input[class="btn btn-secondary undo"]').on("click", function(event){
				$.ajax({
					url: "led-motor-config-undo",
					type: 'GET',
					dataType: "JSON",
					success: function (response)
					{
						if(response.status){
							location.reload();
							// var myJSON = JSON.stringify(response.data);
							// download('data.json',myJSON);
						}
					}
				});
			});	
			
			$('button[class="btn btn-secondary cancel button-image"]').on("click",function(e){
				$('#exampleModalLong').modal("hide");
				// exampleModalLong
				// console.log('weeeeeeeeeeeeeeeeeee');
				// e.preventDefault();
				// $('#exampleModalLong').modal();
				// $('button[class="btn btn-secondary save"]').data('val','on');
			});
			
			
			$('button[class="btn btn-light on-mode"]').on("click",function(e){
				e.preventDefault();
				$('#exampleModalLong').modal();
				$('button[class="btn btn-secondary save button-image"]').data('val','on');
			});
			
			
			$('button[class="btn btn-light off-mode"]').on("click",function(e){
					e.preventDefault();
					$('#exampleModalLong').modal();
					$('button[class="btn btn-secondary save button-image"]').data('val','off');
			});
			
			$('button[class="btn-secondary-toggle"]').on("click",function(e){
				 $('div[class="button-option-ceil"]').slideToggle("slow");
			});
			
			$('select[name="on_mode_align_text"]').on("change",function(e){
				$('.entrance_on_mode_div').css('text-align',$(this).val());
			});	
			
			$('select[name="off_mode_align_text"]').on("change",function(e){
				$('.entrance_off_mode_div').css('text-align',$(this).val());
			});	
			
			// $('div[class="btn-firs-toggle"]').on("mouseout",function(e){
				 // $('div[class="button-option-ceil"]').slideUp("slow");
			// });
			
			$('button[class="btn btn-secondary back"]').on("click",function(e){
				// location.href = "/admin/dashboard";
				window.history.back();
			});
			
			$('button[class="btn btn-secondary LED_sequence_config"]').on("click",function(e){
				
				$.ajax({
							url: "entrance-west-building-clone",
							type: 'POST',
							data: {
									"type": 'led-sequence-config',
									"vehicle_id": $('input[name="vehicle_id"]').val(),
									"_token": $('meta[name="_token"]').attr('content')
							},
							success: function (response)
							{
								if(response){
									location.href = "/admin/led-sequence-config?vehicle_id="+$('input[name="vehicle_id"]').val();
								}else{
									$.toaster({ priority : 'danger', title : 'Error', message : "Please add LED sequence"});
								}
							}
						});
			});
			
			$('button[class="btn btn-secondary entrance-motor-config"]').on("click",function(e){
				$.ajax({
					url: "entrance-west-building-clone",
					type: 'POST',
					data: {
							"type": 'entrance-motor-config',
							"vehicle_id": $('input[name="vehicle_id"]').val(),
							"_token": $('meta[name="_token"]').attr('content')
					},
					success: function (response)
					{
						if(response){
							location.href = "/admin/led-motor-excel-sheet?vehicle_id="+$('input[name="vehicle_id"]').val();
						}else{
							$.toaster({ priority : 'danger', title : 'Error', message : "Please add LED sequence"});
						}
					}
				});
				
			});
			
			
			$('button[class="btn btn-secondary LED_EXTERNAL_BOARD_ID"]').on("click",function(e){
				$.ajax({
					url: "entrance-west-building-clone",
					type: 'POST',
					data: {
							"type": 'led-sequence-config',
							"vehicle_id": $('input[name="vehicle_id"]').val(),
							"_token": $('meta[name="_token"]').attr('content')
					},
					success: function (response)
					{
						if(response){
							location.href = "/admin/led-external-board-id?vehicle_id="+$('input[name="vehicle_id"]').val();
						}else{
							$.toaster({ priority : 'danger', title : 'Error', message : "Please add LED sequence"});
						}
					}
				});
			});
			
			
			
			
			
			$('button[class="btn btn-secondary download"]').on("click",function(e){
				$('div[class="button-option-ceil"]').slideUp("slow");
				$.ajax({
					url: "entrance-west-building-clone",
					type: 'POST',
					dataType: "JSON",
					data: {
							"type": 'json_file',
							"_token": $('meta[name="_token"]').attr('content'),
					},
					success: function (response)
					{
						if(response.status){
							var myJSON = JSON.stringify(response.data);
							download('data.json',myJSON);
						}
					}
				});
			});
			
			
			
			
			
			$('input[name="on_mode_color_2"]').on("blur",function(e){
				$('.entrance_on_mode_div').css('color',$(this).val());
			});
			
			$('input[name="off_mode_color_2"]').on("blur",function(e){
				$('.entrance_off_mode_div').css('color',$(this).val());
			});
				
			$(".image-picker").imagepicker({
			clicked: function() {
							let base_url = $('meta[name="_token"]').attr('base_url');
							let image_val = $(this).val().slice(5);
							$('button[class="btn btn-secondary save button-image"]').on("click",function(e){
								$('#exampleModalLong').modal("hide");
								if($('button[class="btn btn-secondary save button-image"]').data('val') == 'on'){
									$('.entrance_on_mode').css('background-image','url(./../'+image_val+')');
									$('input[name="on_mode_image"]').val(image_val);
									if(image_val != "assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_12.png"){
										$('div[class="entrance_on_mode_div"]').addClass("text-size-margin");
									}else{
										$('.entrance_on_mode_div').removeClass("text-size-margin");
									}
								}else{
									$('.entrance_off_mode').css('background-image','url(./../'+image_val+')');
									$('input[name="off_mode_image"]').val(image_val);
									if(image_val != "assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_12.png"){
										$('div[class="entrance_off_mode_div"]').addClass("text-size-margin");
									}else{
										$('.entrance_off_mode_div').removeClass("text-size-margin");
									}
								}
							});
						}
					});
				
				$(document).on("click",'.btnconfiguratorclass',function(e) {
					let sequence_text = $('input[name="button_title"]').val();
					// $('.btnconfiguratorclass').text();
					console.log(sequence_text);
					$('.btnconfigurator').html('<input type="text" class="form-control btnconfiguratortext" name="btnconfigurator" value="'+sequence_text+'">');
				});
				
				$(document).on("focusout",'.btnconfiguratortext',function(e) {
					let sequence_name = $('input[name="sequence_name"]').val();
					let button_title = $(this).val();
					$('input[name="button_title"]').val(button_title);
					$('.btnconfigurator').html('<div class="btnconfiguratorclass">'+button_title+'</div>');
					// $.ajax({
						// url: "entrance-west-building-clone",
						// type: 'POST',
						// dataType: "JSON",
						// data: {
								// "type": 'change_button_title',
								// "_token": $('meta[name="_token"]').attr('content'),
								// "vehicle_id": $('input[name="vehicle_id"]').val(),
								// "button_title": button_title,
								// "sequence_name": sequence_name,
						// },
						// success: function (response)
						// {
							// if(response.status){
								// var myJSON = JSON.stringify(response.data);
								// download('data.json',myJSON);
							// }
						// }
					// });
				
				});
				
				$(document).on("focusout",'.sequenceeeeee',function(e) {
					$('input[name="on_sequence_text_name"]').val($(this).val());
					$('.entrance_on_mode_div').html($(this).val());
					$('.entrance_on_mode_div').css('text-align',$('select[name="on_mode_align_text"]').val());
				});
				
				$(document).on("click",'button[class="entrance_on_mode"]',$.singleDoubleClick(function(e) {
					// location.href = "entrance-west-building?name="+e.target.attributes[4].nodeValue;
				}, function(e){
					let sequence_text = $('input[name="sequence_text"]').val();
					sequence_text = sequence_text.replace("<br>", "\n");
					$('.entrance_on_mode_div').html('<textarea class="form-control sequenceeeeee">'+sequence_text+'</textarea>');
						$(document).on("focusout",'.sequenceeeeee',function(e) {
							let sequence_text_s1 = $(this).val().replace(/(?:\r\n|\r|\n)/g, '<br>');
							// console.log(sequence_text_s1);
							$('input[name="sequence_text"]').val($(this).val());
							$('input[name="on_sequence_text_name"]').val(sequence_text_s1);
							$('.entrance_on_mode_div').html(sequence_text_s1);
							$('.entrance_on_mode_div').css('text-align',$('select[name="on_mode_align_text"]').val());
						});
					// });
				}));
				
				$(document).on("click",'button[class="entrance_off_mode"]',$.singleDoubleClick(function(e) {
						// location.href = "entrance-west-building?name="+e.target.attributes[4].nodeValue;
				}, function(e){
					// let parent_div_id = $('#'+e.currentTarget.attributes.id.nodeValue).parent().attr('id');
					// let vaaluess = $('#'+e.currentTarget.attributes.id.nodeValue).text();
					// $('#'+e.currentTarget.attributes.id.nodeValue).remove();
					let off_sequence_text = $('input[name="off_sequence_text"]').val();
					off_sequence_text = off_sequence_text.replace("<br>", "\n");
					// '<input type="text" class="form-control sequenceeeeees" name="off_sequence_text" value="'+off_sequence_text+'">'
					$('.entrance_off_mode_div').html('<textarea class="form-control sequenceeeeees" name="off_sequence_text">'+off_sequence_text+'</textarea>');
					
					$(document).on("focusout",'.sequenceeeeees',function(e) {
						let sequence_text_s1 = $(this).val().replace(/(?:\r\n|\r|\n)/g, '<br>');
						$('input[name="off_sequence_text"]').val($(this).val());
						$('input[name="off_sequence_text_name"]').val(sequence_text_s1);
						$('.entrance_off_mode_div').html(sequence_text_s1);
						$('.entrance_off_mode_div').css('text-align',$('select[name="off_mode_align_text"]').val());
					});
				
				}));
				
				// $(document).on("focusout",'.sequenceeeeee',function(e) {
					// $('input[name="sequence_text"]').val($(this).val());
					// $('.entrance_on_mode_div').html($(this).val());
				// });
				// 
				// let sequence_text_sequenceeeeee = "";
				

				$(document).on("focusout",'.sequenceeeeees',function(e) {
					$('input[name="off_sequence_text"]').val($(this).val());
					$('.entrance_off_mode_div').html($(this).val());
					$('.entrance_off_mode_div').css('text-align',$('select[name="off_mode_align_text"]').val());
				});
				
				$(document).on("click",'button[class="btn btn-secondary undo"]',function(e) {
					location.href = "";
				});
				
				$(document).on("click",'button[class="btn btn-secondary copy-on-mode"]',function(e) {
					let on_mode_color_2 = $('input[name="on_mode_color_2"]').val();
					let on_mode_align_text = $('select[name="on_mode_align_text"]').val();
					let on_mode_image = $('input[name="on_mode_image"]').val();
					let sequence_text = $('input[name="sequence_text"]').val();
					
					$('input[name="off_mode_color_2"]').val(on_mode_color_2);
					$('select[name="off_mode_align_text"]').val(on_mode_align_text);
					$('input[name="off_sequence_text"]').val(sequence_text);
					$('.entrance_off_mode_div').css('text-align',on_mode_align_text);
					$('.entrance_off_mode_div').html(sequence_text);
					$('.entrance_off_mode_div').css('color',on_mode_color_2);
					
					if(on_mode_image){
						$('.entrance_off_mode').css('background-image','url(./../'+on_mode_image+')');
						$('input[name="off_mode_image"]').val(on_mode_image);
						if(on_mode_image != "assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim_12.png"){
							$('div[class="entrance_off_mode_div"]').addClass("text-size-margin");
						}
					}
				});
			});
	

		</script>
</body>

</html>