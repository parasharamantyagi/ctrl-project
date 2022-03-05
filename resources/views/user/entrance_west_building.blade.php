@extends('layouts.appuser')
@section('content')
<style>
.entrance_on_mode_parent{
	border: 22px solid; 
	margin-left: 6px;
	color: #000000de;
	width: 212px;
	border-radius: 7px; 
	height: 132px;
}
.entrance_on_mode{
	background-repeat: round;
	background-size: cover;
	height: 100%;
	width: 100%;
	font-size: 18px;
}
.entrance_off_mode_parent{
	border: 22px solid; 
	margin-left: 6px;
	color: #000000de;
	width: 212px;
	border-radius: 7px; 
	height: 132px;
}
.entrance_off_mode{
	background-repeat: round;
	background-size: cover;
	height: 100%;
	width: 100%;
	font-size: 18px;
	color: #ffffff;
}
img.image_picker_image {
    width: 90px;
    height: 99px;
}
.modal-content {
	width: 146%;
}
</style>

@if($entranceWest->on_mode_image)
	<style>
		.entrance_on_mode {
			background-image: url(./../{{$entranceWest->on_mode_image}});
			text-align: {{$entranceWest->on_mode_align_text}};
			color: {{$entranceWest->on_mode_color_2}};
		}
	</style>
@endIf

@if($entranceWest->off_mode_image)
	<style>
		.entrance_off_mode {
			background-image: url(./../{{$entranceWest->off_mode_image}});
			text-align: {{$entranceWest->off_mode_align_text}};
			color: {{$entranceWest->off_mode_color_2}};
		}
	</style>
@endIf

<link href="{{ url('users/toggle-switch.css') }}" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://rvera.github.io/image-picker/examples.css">
<link rel="stylesheet" type="text/css" href="https://rvera.github.io/image-picker/image-picker/image-picker.css">

	<div class="page-content-wrap">
	
		
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
								  </select>
								</div>
							  </div>
							</div>
							
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary save" data-dismiss="modal" data-val="">Done</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<!-- button type="button" class="btn btn-primary">Save changes</button -->
					  </div>
					</div>
				  </div>
				</div>
		<!--      End   -->
		
		
		<form method="POST" id="Updateuser" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="modal-body">
		<div class="row">
		<div class="col-md-3" style="text-align: center;">
		<p><a class="btn btn-secondary" href="{{url('user/led-motor-config')}}">Cancel</a></p>
		<img style="width: 68px;" src="{{asset('users/entrance-west-building/icon2.png')}}">
		</div>
		<div class="col-md-6" style="text-align: center;">
		
		<h4 style="display: -webkit-inline-box;"><div style="width: 300px;">Entrance west building</div><a href="javascript:void(0)" class="fa-copy-fa-clone"><i class="fa fa-clone" aria-hidden="true"></i></a></h4>
		<br />
		<input name="sequence_name" type="hidden" value="{{$page_name}}"/>
		<input name="is_copy" type="hidden" value="0"/>
		<b>({{str_replace("_"," ",$page_name)}})</b>
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
			
		</div>
		<div class="col-md-3" style="text-align: center;">
		<p>
			<input type="submit" class="btn btn-secondary save-entrance" value="Save" style="margin-right: 5px;">
			<input type="submit" class="btn btn-secondary save-entrance delete" value="Delete">
		</p>
		<input type="hidden" class="form-control" name="sequence_text" value="{{$entranceWest->sequence_text}}" >
		<input type="hidden" class="form-control" name="off_sequence_text" value="{{$entranceWest->off_sequence_text}}" >
		<input type="hidden" class="form-control" name="led_motor_config" value="{{$entranceWest->led_motor_config}}" >
		<img style="width: 55px;" src="http://52.21.91.157/users/entrance-west-building/icon1.jpg">
		</div>
		</div>
		<div class="row">
		<div class="col-md-6" style="text-align: center;border-right: 2px solid;">

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
				<input type="hidden" class="form-control" name="on_mode_color_1" value="{{$entranceWest->on_mode_color_1}}" id="background_color" style="width: 45px; margin-left: 5px;">
				<input type="color" class="form-control" name="on_mode_color_2" value="{{$entranceWest->on_mode_color_2}}" id="background_color" style="width: 45px; margin-left: 5px;">
				</p>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
			<p style="display: -webkit-inline-box;">Align text: <select name="on_mode_align_text" class="form-control" id="background_color" style="width: 210px; margin-left: 5px;">
				<option value="left" @if($entranceWest->on_mode_align_text === 'left') ? selected : '' @endif>Left</option>
				<option value="right" @if($entranceWest->on_mode_align_text === 'right') ? selected : '' @endif>Right</option>
				<option value="center" @if($entranceWest->on_mode_align_text === 'center') ? selected : '' @endif>Centre</option>
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
							{{$entranceWest->sequence_text}}
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
					<input type="hidden" class="form-control" name="off_mode_color_1" value="{{$entranceWest->off_mode_color_1}}" id="background_color" style="width: 45px; margin-left: 5px;">
					<input type="color" class="form-control" name="off_mode_color_2" value="{{$entranceWest->off_mode_color_2}}" id="background_color" style="width: 45px; margin-left: 5px;">
					</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<p style="display: -webkit-inline-box;">Align text: 
				<select name="off_mode_align_text" class="form-control" id="background_color" style="width: 210px; margin-left: 5px;">
					<option value="left" @if($entranceWest->off_mode_align_text === 'left') ? selected : '' @endif>Left</option>
					<option value="right" @if($entranceWest->off_mode_align_text === 'right') ? selected : '' @endif>Right</option>
					<option value="center" @if($entranceWest->off_mode_align_text === 'center') ? selected : '' @endif>Centre</option>
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
							{{$entranceWest->off_sequence_text}}
						</button>
					</div>
				</p>
				</div>
			</div>
		</div>
		</div>
		</div>
		</form>
	</div>
@endsection

@section('script')
	<script src="https://rvera.github.io/image-picker/js/prettify.js" type="text/javascript"></script>
    <script src="https://rvera.github.io/image-picker/js/jquery.masonry.min.js" type="text/javascript"></script>
    <script src="https://rvera.github.io/image-picker/js/show_html.js" type="text/javascript"></script>
    <script src="https://rvera.github.io/image-picker/image-picker/image-picker.js" type="text/javascript"></script>
		<script>
		$(document).ready(function(){
			$('.fa-copy-fa-clone').on("click", function(event){
			if($('input[name="on_mode_align_text"]').val() != '' && $('input[name="off_mode_align_text"]').val() != ''){
			if(confirm('Are you sure to copy this setting ..?')){
				$('input[name="is_copy"]').val("1");
				$('input[class="btn btn-secondary save-entrance"]').click();
		
					// $.ajax({
						// url: "entrance-west-building-clone",
						// type: 'POST',
						// data: {
							// "on_mode_align_text": $('input[name="on_mode_align_text"]').val(),
							// "off_mode_align_text": $('input[name="off_mode_align_text"]').val(),
							// "_token": $('meta[name="_token"]').attr('content'),
						// },
						// success: function (response)
						// {
								// window.location.href = 'led-motor-config';
						// }
					// });
				
				}
			}
			});
			
			function readURL(input,image_class) {
			  if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e) {
					// console.log(e.target.result);
					//color: #000000de;background-image: url(./../{{$entranceWest->on_mode_image}});width: 168px !important;border-radius: 7px; height: 110px;
					$(image_class).css("background-image", "url("+e.target.result+")").css("background-color","");
					
					// .css("background-color","22px solid").css("margin-left","6px").css("width","168px !importan").css("border-radius","7px").css("height","110px");
				  // $(image_class).html('<img id="blah" style="width: 125px; height: 78px;" src='+e.target.result+' alt="your image" />');
				}
				reader.readAsDataURL(input.files[0]); // convert to base64 string
			  }
			}
			
			// $('button[class="btn btn-light"]').on("click",function(e){
				// e.preventDefault();
			// });
			$('.entrance_off_mode').on("click",function(e){
				e.preventDefault();
			});
			
			$('.entrance_on_mode').on("click",function(e){
				e.preventDefault();
			});
			
			$('input[name="on_mode_image"]').change(function() {
					readURL(this,'.entrance_on_mode');
			 });
			 
			$('input[name="off_mode_image"]').change(function() {
					readURL(this,'.entrance_off_mode');
			 });
			 
			 
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
			
			$(document).on("focusout",'.sequenceeeeee',function(e) {
				$('input[name="sequence_text"]').val($(this).val());
					// $.ajax({
						// url: "entrance-west-building-clone",
						// type: 'POST',
						// dataType: "JSON",
						// data: {
								// "type": 'change_button_name',
								// "sequence_name": $(this).data('name'),
								// "sequence_text": $(this).val(),
								// "_token": $('meta[name="_token"]').attr('content'),
						// },
						// success: function (response)
						// {
						// }
					// });
				$('.entrance_on_mode').html($(this).val());
			});
			
			$(document).on("focusout",'.sequenceeeeees',function(e) {
				$('input[name="off_sequence_text"]').val($(this).val());
					// $.ajax({
						// url: "entrance-west-building-clone",
						// type: 'POST',
						// dataType: "JSON",
						// data: {
								// "type": 'change_button_name',
								// "sequence_name": $(this).data('name'),
								// "sequence_text": $(this).val(),
								// "_token": $('meta[name="_token"]').attr('content'),
						// },
						// success: function (response)
						// {
						// }
					// });
				$('.entrance_off_mode').html($(this).val());
			});
			
			$(document).on("click",'button[class="entrance_on_mode"]',$.singleDoubleClick(function(e) {
					// location.href = "entrance-west-building?name="+e.target.attributes[4].nodeValue;
			}, function(e){
				// let parent_div_id = $('#'+e.currentTarget.attributes.id.nodeValue).parent().attr('id');
				// let vaaluess = $('#'+e.currentTarget.attributes.id.nodeValue).text();
				// $('#'+e.currentTarget.attributes.id.nodeValue).remove();
				let sequence_text = $('input[name="sequence_text"]').val();
				$('.entrance_on_mode').html('<input type="text" class="form-control sequenceeeeee" name="sequence_text" value="'+sequence_text+'" data-name="{{$entranceWest->sequence_name}}">');
			}));
			
			$(document).on("click",'button[class="entrance_off_mode"]',$.singleDoubleClick(function(e) {
					// location.href = "entrance-west-building?name="+e.target.attributes[4].nodeValue;
			}, function(e){
				// let parent_div_id = $('#'+e.currentTarget.attributes.id.nodeValue).parent().attr('id');
				// let vaaluess = $('#'+e.currentTarget.attributes.id.nodeValue).text();
				// $('#'+e.currentTarget.attributes.id.nodeValue).remove();
				let off_sequence_text = $('input[name="off_sequence_text"]').val();
				$('.entrance_off_mode').html('<input type="text" class="form-control sequenceeeeees" name="off_sequence_text" value="'+off_sequence_text+'" data-name="{{$entranceWest->sequence_name}}">');
			}));
			
			
			  
		});
		
		// off_mode_image
		
		$(".image-picker").imagepicker({
			clicked: function() {
				let base_url = $('meta[name="_token"]').attr('base_url');
				let image_val = $(this).val().slice(5);
				// let final_image = base_url+image_val;
				$('button[class="btn btn-secondary save"]').on("click",function(e){
					if($('button[class="btn btn-secondary save"]').data('val') == 'on'){
						
						// style="background-image: url(./../assets/ctrlImages/on_mode_image2412381619019407.png);"
						
						
						// $(image_class).css("background-image", "url("+e.target.result+")").css("background-color","");
						// $('.entrance_on_mode').css("background-image", "url("+image_val+")");
						
						
						// image_val
						
						// $('div[class="entrance_on_mode_parent"]').html('<button style="background-image: url('+image_val+');" class="entrance_on_mode">'+$('.entrance_on_mode').text()+'</button>');
						
						// console.log($('.entrance_on_mode').text());
						// console.log(image_val);
						// console.log(+);
						// 
						
						// var imageUrl = "http://52.21.91.157/assets/ctrlImages/entrance-west-building/imgpsh_fullsize_anim(1).png";
						
						// $(".entrance_on_mode").css("background-image", "url(" + imageUrl + ")");
						
						$('.entrance_on_mode').css('background-image','url(./../'+image_val+')');
						
						
						// background-image: url(./../assets/ctrlImages/on_mode_image2412381619019407.png);
						
						$('input[name="on_mode_image"]').val(image_val);
					}else{
						$('.entrance_off_mode').css('background-image','url(./../'+image_val+')');
						$('input[name="off_mode_image"]').val(image_val);
					}
				});
			}
		});
		
		$('input[class="btn btn-secondary save-entrance delete"]').on("click",function(e){
			e.preventDefault();
				let sequence_name = $('input[name="sequence_name"]').val();
                      $.confirm({
                          icon: 'fa fa-frown-o',
						  content: 'Are you sure you want to delete this button ?',
                          theme: 'modern',
                          closeIcon: true,
                          animation: 'scale',
                          type: 'blue',
						  buttons: {
									'confirm': {
									text: 'Delete',
									btnClass: 'btn btn-primary',
									action: function(){
										$.ajax({
											url: "entrance-west-building-clone",
											type: 'POST',
											dataType: "JSON",
											data: {
													"type": 'delete_led_sequence',
													"sequence_name": sequence_name,
													"_token": $('meta[name="_token"]').attr('content'),
											},
											success: function (response)
											{
												// if(response){
													location.reload();
												// }
											}
										});
									  }
								  },
								  cancel: function(){
								  },
                          }
                      });
		});
		
		$('button[class="btn btn-light on-mode"]').on("click",function(e){
			e.preventDefault();
			$('#exampleModalLong').modal();
			$('button[class="btn btn-secondary save"]').data('val','on');
		});
		
		
		$('button[class="btn btn-light off-mode"]').on("click",function(e){
			e.preventDefault();
			$('#exampleModalLong').modal();
			$('button[class="btn btn-secondary save"]').data('val','off');
		});
		
		
		$('input[name="on_mode_color_2"]').on("blur",function(e){
			$('.entrance_on_mode').css('color',$(this).val());
		});
		
		$('input[name="off_mode_color_2"]').on("blur",function(e){
			$('.entrance_off_mode').css('color',$(this).val());
		});
		
		// <button type="button" class="btn btn-secondary save" data-dismiss="modal" data-val="">Save</button>
		// btn btn-secondary save  data-val=""
		$('select[name="on_mode_align_text"]').on("change",function(e){
			$('.entrance_on_mode').css('text-align',$(this).val());
		});	
		
		$('select[name="off_mode_align_text"]').on("change",function(e){
			$('.entrance_off_mode').css('text-align',$(this).val());
		});	
		
		
		</script>
		
@endsection
