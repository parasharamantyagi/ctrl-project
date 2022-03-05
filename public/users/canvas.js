var canvas = document.getElementById("canvas");
var ctx = canvas.getContext("2d");
var canvasOffset = $("#canvas").offset();
var offsetX = canvasOffset.left;
var offsetY = canvasOffset.top;
var storedLines = [];
var startX = 0;
var startY = 0;
var isDown;

ctx.strokeStyle = "black";
ctx.lineWidth = 2;

function draw(moveToW,moveToH,lineToW,lineToH) {
	
ctx.strokeStyle = 'black';
ctx.lineWidth = 2;
ctx.beginPath();
ctx.moveTo(moveToW, moveToH);
ctx.lineTo(lineToW, lineToH);
ctx.stroke();
}
function callFunction(){
// draw('mouseX 2','mouseY 2','mouseX 1','mouseY 1');
draw(300,150,20,150);
draw(200,150,300,60);
draw(691,149,481,148);
draw(899,145,778,146);
draw(513,61,240,59);
draw(970,70,898,71);
draw(532,253,289,255);
draw(882,262,700,261);
draw(721,260,402,59);
draw(721,262,970,69);
draw(394,254,260,151);
draw(714,62,631,63);
draw(626,19,668,61);

ledMotorConfig_get_val();
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
	
	
	function ledMotorConfig_get_val(){
		$.ajax({
			url: "entrance-west-building-clone",
			type: 'POST',
			dataType: "JSON",
			data: {
					"type": 'get_ledMotorConfig',
					"_token": $('meta[name="_token"]').attr('content'),
			},
			success: function (response)
			{
				var resultData = JSON.parse(response.replace(/&quot;/g,'"'));
				setvalue_of_led(resultData);
			}
		});
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
