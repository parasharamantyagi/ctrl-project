@extends('layouts.appuser')

@section('content')

	<div class="page-content-wrap">
                    <!-- START ALERT BLOCKS -->


                        
<!-- END ALERT BLOCKS -->                    	
			<form method="POST" action="javascript:void(0)" id="Updateuser" enctype="multipart/form-data">
<input type="hidden" name="_token" value="tyuBIz44UH9Ipf8cuoUMlEQ1YTiEWoMmm4BFBnjv">
<div class="modal-header">
<h5>Led motor config</h5>

<div class="header-link">
						<input type="button" class="btn btn-secondary led-motor-config" value="Download">
						<!-- a href="entrance-west-building" class="btn btn-secondary addvehicle-settings edit">Entrance west building</a -->			
				</div>
</div>
<input type="hidden" name="id" value="603354acfdd6df3dc16b2042" id="id">
<div class="modal-body led-motor-config" style="overflow-x: scroll;">
	
	<div class="bg_3x" style='width: 1006px; border-radius: 12px; background-image: url("./../img/imgpsh_fullsize_anim3.png")'>
		
		
			<canvas id="canvas" width=1000 height=300 style='background-image: url("./../img/imgpsh_fullsize_anim4.png")'></canvas>
		
		
		
		<div class="row" style="flex-wrap: inherit; overflow-x: scroll; width: 1015px; margin: 1px;">
		@foreach($ledMotor_buttons as $ledMotor_button_key => $ledMotor_button)
			<div class="col-sm-led-config-button" ondrop="dropThis(event)" ondragover="allowDropThis(event)" id="drags_parent_{{$ledMotor_button_key}}">
			<button class="led-and-config-button sequence" @if($ledMotor_button->on_mode_image) style="background-image: url(./../{{$ledMotor_button->on_mode_image}}) !important;" @endIf draggable="true" ondragstart="dragThis(event)" id="drags_{{$ledMotor_button_key}}" data-name="{{$ledMotor_button->sequence_name}}"><div style="color:{{$ledMotor_button->on_mode_color_2}}">{{$ledMotor_button->sequence_text}}</div></button>
			</div>
		@endforeach 
		</div>
	</div>
	
</div>
<div class="modal-footer">

<input type="button" class="btn btn-secondary undo" value="Undo" <?php echo (!json_decode($ledMotorConfigs)) ? 'style="display: none;"' : ''; ?> />
<input type="button" class="btn btn-secondary" onclick="form_return()" value="Back" />
<input type="submit" class="btn btn-primary clear-changes" value="Clear changes" />
</div>
</form>
		
		
                    
    </div>
@endsection

@section('script')
		<script type="text/javascript" src="./../users/scripts.js"></script>
		<script>
		
		var resultDatas = '{{ $ledMotorConfigs }}';
		var resultData = JSON.parse(resultDatas.replace(/&quot;/g,'"'));
	
	
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
			
			// $(document).on("focusout",'.sequenceeeeee',function(e) {
					// $.ajax({
						// url: "entrance-west-building-clone",
						// type: 'POST',
						// dataType: "JSON",
						// data: {
								// "type": 'change_button_name',
								// "parent_id": $(this).parent().attr('id'),
								// "id": $(this).attr('id'),
								// "value": $(this).val(),
								// "name": $(this).data('name'),
								// "_token": $('meta[name="_token"]').attr('content'),
						// },
						// success: function (response)
						// {
							// if(response.status){
								// var myJSON = JSON.stringify(response.data);
								// download('data.json',myJSON);
							// }
						// }
					// });
					
				// $('#'+$(this).parent().attr('id')).html('<button class="led-and-config-button sequence" draggable="true" ondragstart="dragThis(event)" id="'+$(this).attr('id')+'" data-name="'+$(this).data('name')+'">'+$(this).val()+'</button>');
			// });
			
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
			  
			$(document).on("click",'button[class="led-and-config-button sequence"]',function() {
				location.href = "entrance-west-building?name="+$(this).data('name');
			});
				
			
			// $(document).on("click",'button[class="led-and-config-button sequence"]',$.singleDoubleClick(function(e) {
					// location.href = "entrance-west-building?name="+e.target.attributes[4].nodeValue;
			// }, function(e){
				// let parent_div_id = $('#'+e.currentTarget.attributes.id.nodeValue).parent().attr('id');
				// let vaaluess = $('#'+e.currentTarget.attributes.id.nodeValue).text();
				// $('#'+e.currentTarget.attributes.id.nodeValue).remove();
				// $('#'+parent_div_id).html('<input type="text" class="form-control sequenceeeeee" name="on_mode_align_text" value="'+vaaluess+'" data-name="'+e.currentTarget.attributes[4].nodeValue+'" id="'+e.currentTarget.attributes.id.nodeValue+'">');
			// }));
			
			$('input[class="btn btn-primary clear-changes"]').on("click", function(event){
					$.ajax({
					url: "entrance-west-building-clone",
					type: 'POST',
					dataType: "JSON",
					data: {
							"type": 'clear_led_config',
							"_token": $('meta[name="_token"]').attr('content'),
					},
					success: function (response)
					{
						if(response.status){
							
							location.href = "";
							// var myJSON = JSON.stringify(response.data);
							// download('data.json',myJSON);
						}
					}
				});
			});
			
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
				
			
		});
		
		
		var canvas = document.getElementById("canvas");
var ctx = canvas.getContext("2d");
var canvasOffset = $("#canvas").offset();
var offsetX = canvasOffset.left;
var offsetY = canvasOffset.top;
var storedLines = [];
var startX = 0;
var startY = 0;
var isDown;

ctx.strokeStyle = "#aaaaaa94";
ctx.lineWidth = 6;

function draw(moveToW,moveToH,lineToW,lineToH) {
	
ctx.strokeStyle = '#aaaaaa94';
ctx.lineWidth = 6;
ctx.beginPath();
ctx.moveTo(moveToW, moveToH);
ctx.lineTo(lineToW, lineToH);
ctx.stroke();
}
function callFunction(){
// draw('mouseX 2','mouseY 2','mouseX 1','mouseY 1');


draw(321,160,23,160);
draw(573,160,412,161);
draw(894,160,733,160);
draw(893,69,984,68);
draw(482,252,296,252);
draw(755,251,572,250);
draw(985,68,664,250);
draw(640,69,777,69);
draw(114,69,457,68);
draw(204,160,389,253);
draw(297,69,664,250);
draw(641,24,709,69);
draw(296,68,665,249);
draw(68,160,183,69);

setvalue_of_led(resultData);
}

callFunction();


$("#canvas").mousedown(function(e) {
  handleMouseDown(e);
});
$("#canvas").mousemove(function(e) {
  handleMouseMove(e);
});
$("#canvas").mouseup(function(e) {
  handleMouseUp(e);
});
$("#clear").click(function() {
  storedLines.length = 0;
  redrawStoredLines();
});

function handleMouseDown(e) {
  var mouseX = parseInt(e.clientX - offsetX);
  var mouseY = parseInt(e.clientY - offsetY);
  callFunction();
  isDown = true;
  startX = mouseX;
  startY = mouseY;
}

function handleMouseMove(e) {
  if (!isDown) {
    return;
  }
  redrawStoredLines();
  var mouseX = parseInt(e.clientX - offsetX);
  var mouseY = parseInt(e.clientY - offsetY);
  
  callFunction();
  ctx.beginPath();
  ctx.moveTo(startX, startY);
  ctx.lineTo(mouseX, mouseY);
  ctx.stroke();
}


function handleMouseUp(e) {
  isDown = false;
  var mouseX = parseInt(e.clientX - offsetX);
  var mouseY = parseInt(e.clientY - offsetY);
  callFunction();
  storedLines.push({
    x1: startX,
    y1: startY,
    x2: mouseX,
    y2: mouseY
  });
  ledMotorConfig([mouseX,mouseY,startX ,startY]);
  
  console.log(mouseX+','+mouseY+','+startX+','+startY);
  
  redrawStoredLines();
}

	function ledMotorConfig(input){
		$.ajax({
			url: "entrance-west-building-clone",
			type: 'POST',
			dataType: "JSON",
			data: {
					"type": 'save_cordinate',
					"cordinate": input,
					"_token": $('meta[name="_token"]').attr('content'),
			},
			success: function (response)
			{
				$('input[class="btn btn-secondary undo"]').show();
			}
		});
	}
	
	function set_value_of_led(input){
		draw(parseInt(input[0]),parseInt(input[1]),parseInt(input[2]),parseInt(input[3]));
	}

	function setvalue_of_led(resultData){
		if(resultData.length > 0){
		for(var i = 0; i < resultData.length; i++) {
				if (resultData[i] != null && resultData[i].length == 4) {
					set_value_of_led(resultData[i]);
				}
			}
		}
	}
	
	
function redrawStoredLines() {
  ctx.clearRect(0, 0, canvas.width, canvas.height);
  if (storedLines.length == 0) {
    return;
  }
  // redraw each stored line
  callFunction();
  for (var i = 0; i < storedLines.length; i++) {
    ctx.beginPath();
    ctx.moveTo(storedLines[i].x1, storedLines[i].y1);
    ctx.lineTo(storedLines[i].x2, storedLines[i].y2);
    ctx.stroke();
  }
}

		</script>
		
@endsection
