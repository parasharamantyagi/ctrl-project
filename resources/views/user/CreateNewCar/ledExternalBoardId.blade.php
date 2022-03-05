<html>
	<head>
	<link rel="stylesheet" href="{{ url('/excel/jexcel.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ url('/excel/jsuites.css') }}" type="text/css" />
	<style>
			.btn-primary { color: #fff; background-color: #337ab7; border-color: #2e6da4; }
			.btn { display: inline-block; margin-bottom: 0; font-weight: 400; text-align: center; white-space: nowrap; vertical-align: middle; -ms-touch-action: manipulation; touch-action: manipulation; cursor: pointer; background-image: none; border: 1px solid transparent; padding: 6px 12px; font-size: 14px; line-height: 1.42857143; border-radius: 4px; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; }
			.input-file { display: none; }
			.image-upload-img { width: 60px; cursor: pointer; margin-top: 0px; }
	</style>
			<style>
			
				.blink-bg{
					animation: blinkingBackground 1s infinite;
				}
				@keyframes blinkingBackground{
					0%		{ background-color: #cacce3;}
					25%		{ background-color: #aaafe3;}
					50%		{ background-color: #8d95eb;}
					75%		{ background-color: #646fed;}
					100%	{ background-color: #0013f0;}
				}
				.myTable
					{
						width: 1100px;
						background-color: #DFDBDB;
						padding: 5%;
						border: none;
						height: 432px;
					}
				td {
						width: 50px;
						text-align: center;
					}
				
				// .myTable tbody tr td.child{
						// border-radius: 37px;
						// height: 70px;
				// }
				.container {
						padding-top: 40px;
					}
				.container_check {
						padding-left: 85px;
					}
				td.parent.plus {
					padding-left: 7px;
				}
				
				td.parent.footer {
					height: 50px;
				}
				.myTable tr td.child
					{
						border: none;
						color: #696969;
					}
				.myTable tr td.child.gray
					{
						background-color: #a6a6a6;
					}
					
				.myTable tr td.child.f2f2f2
					{
						background-color: #f2f2f2;
					}
					
				.myTable tr td.child.ffffff
					{
						background-color: #ffffff;
					}
				.myTable tr td.child.ff8000
					{
						background-color: #ff8000;
					}
				// .myTable tr td.child.0000ff
					// {
						// background-color: #0000ff;
					// }
				.myTable tr td.child.ff0000
					{
						background-color: #ff0000;
					}
				.myTable tr td.child.c10603
					{
						background-color: #c10603;
					}


				// .myTable tr td.child.yellow
					// {
						// background-color: yellow;
					// }
				// .myTable tr td.child.white
					// {
						// background-color: white;
					// }
				.myTable tr td.child.blue
					{
						background-color: blue;
					}
				// .myTable tr td.child.red
					// {
						// background-color: red;
					// }
				// .myTable tr td.child.orange
					// {
						// background-color: orange;
					// }
					
				.myTable tr td.child.green
					{
						background-color: green;
					}
				
				
									
				select {
					width: 50%;
					border-radius: 0.25rem;
				}

				table.car {
					background-color: #D3D3D3;
					background: url("http://52.21.91.157/assets/ctrlImages/LED-config-tool.png") no-repeat;
					background-size: 87%;
					background-position: 50% 0%;
				}

				/* table.myTable {
											background: url("http://18.212.23.117/public/assets/ctrlImages/LED-config-tool.png");
							} */
				.main-menue {
				  width: 35px;
				  height: 5px;
				  background-color: white;
				  margin: 6px 0;
				}
				.main-menue-link {
					padding: 0px 22px;
					margin: -15px;
				}
				span{
					color: white;
					margin: 3px;
					margin-right: 7px;
				}
				td.jexcel_dropdown {
					font-size: 15px;
				}
				.pp_class {
					font-size: 15px;
				}
				.excel_sav_button {
					padding: 7px 84px;
				}
				// .my_progress_bar {
				  // width: 1%;
				  // height: 21px;
				  // background-color: #4CAF50;
				// }
			</style>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	</head>
<body>
		<div class="container">
		<a href="javascript:void(0)" class="btn btn-primary" onclick="form_return()">Back</a>
		<a href="{{ url(user_role('vehicle-view/'.$vehicle_id)) }}" class="btn btn-primary">Vehicle info</a>
		<a href='{{ url(user_role("settings{$setting_page_id}")) }}' class="btn btn-primary">Settings</a>
		<a href="{{ url(user_role('create-new-car?vehicle_id='.$_GET['vehicle_id'])) }}" class="btn btn-primary">LED config</a>
		<a href="{{ url(user_role('car-button?vehicle_id='.$_GET['vehicle_id'])) }}" class="btn btn-primary">Button config</a>
		<a href="{{ url(user_role('multimedia?vehicle_id='.$_GET['vehicle_id'])) }}" class="btn btn-primary">Multimedia</a>
		<a href="{{ url(user_role('led-external-board-id?vehicle_id='.$_GET['vehicle_id'])) }}" class="btn btn-primary">LED EXTERNAL BOARD ID</a>
				
		</div>
		<br>
		
		<div class="excel_sav_button">
		<label><a href='' onclick="$('#spreadsheet').jexcel('insertRow'); event.preventDefault(); return false;">Add row</a></label>
		<label><a href='javascript:void(0)' onclick="insertColumns()">Add column</a></label>
		<br>
		<div id="spreadsheet"></div>
		<br><br>
		<div class="modal-header">
			<input type="submit" class="btn btn-primary save" value="Save changes">
		</div>
		</div>
		
		<br>
		
		
	<script src="{{ url('/newbootstrap/vendor/jquery/jquery.min.js') }}"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="{{ url('/excel/jexcel.js') }}"></script>
	<script src="{{ url('/excel/jsuites.js') }}"></script>
	<script>
	
	
	
	var excel_leds_data = "{{ $excel_leds }}";
	var result_excel_leds_data = JSON.parse(excel_leds_data.replace(/&quot;/g,'"'));
	
	
	var excel_sequence_name = "{{ $entrance_val }}";
	var result_excel_sequence_name = JSON.parse(excel_sequence_name.replace(/&quot;/g,'"'));
	// console.log(result_excel_sequence_name);
	
	var bit_position = { "Bluetooth connect": 0, "Lights (beam + rear)": 1, "Daylight left": 2,"Daylight right": 3, "High beam": 5, "Blinkers left": 6, "Blinkers right": 7, "Rear Light": 8, "Brake lights": 9, "X-Light": 10, "Hazard light": 12, "Demo": 34,"Bluetooth advertising":35, "Battery charging indication": 36, "Power ON indication": 37, "Power OFF indication": 38, "Bluetooth disconnect": 39};
	
	function deleteAllRows(){
		if(confirm('Are you sure to delete all rows ...?')){
			$.ajax({
					url: "led-motor-excel-sheet",
					type: 'POST',
					dataType: "JSON",
					data: {
							"_token": "{{ csrf_token() }}",
							"vehicle_id": "{{ $_GET['vehicle_id'] }}",
							"type": "delete-led-sequence-config"
					},
					success: function (response)
					{
						if(response.status == true){
							window.location.href = "";
						}
					}
				});
		}
	}
	
	function getKeyByValue(object, value) {
	  return Object.keys(object).find(key => object[key] === value);
	  // return 'Daylight right';
	}
	
	// const allKey = Object.keys(resultData);
	function download(file, text) {
                    var element = document.createElement('a');
                    element.setAttribute('href', 'data:text/plain;charset=utf-8, '
                                         + encodeURIComponent(text));
                    element.setAttribute('download', file);
                    document.body.appendChild(element);
                    element.click();
                    document.body.removeChild(element);
                }

	let sequence = new Array();
	for(i=0;i<=39;i++)
	{
	  sequence[i]= i.toString();
	  // a++;
	}
	
	// let a = 100;
	let pinData = new Array();
	for(a=1;a<=139;a++)
	{
	  // pinData[]= a.toString();
	  pinData.push(a.toString());
	  
	  // a++;
	}
	// console.log(pinData);
	
	if(result_excel_leds_data.sequences){
		
		var result_excel_leds_data_sequences = result_excel_leds_data.sequences;
		// console.log(result_excel_leds_data_sequences);
		var excel_final_array = [];
		var excel_final_array = result_excel_leds_data_sequences.map(function(key){
			
			var time_0 = (key && key.data && key.data[0]) ? key.data[0].time : '';
			var start_0 = (key && key.data && key.data[0]) ? key.data[0].start : '';
			var stop_0 = (key && key.data && key.data[0]) ? key.data[0].stop : '';
			
			var time_1 = (key && key.data && key.data[1]) ? key.data[1].time : '';
			var start_1 = (key && key.data && key.data[1]) ? key.data[1].start : '';
			var stop_1 = (key && key.data && key.data[1]) ? key.data[1].stop : '';
			
			var time_2 = (key && key.data && key.data[2]) ? key.data[2].time : '';
			var start_2 = (key && key.data && key.data[2]) ? key.data[2].start : '';
			var stop_2 = (key && key.data && key.data[2]) ? key.data[2].stop : '';
			
			var time_3 = (key && key.data && key.data[3]) ? key.data[3].time : '';
			var start_3 = (key && key.data && key.data[3]) ? key.data[3].start : '';
			var stop_3 = (key && key.data && key.data[3]) ? key.data[3].stop : '';
			
			var time_4 = (key && key.data && key.data[4]) ? key.data[4].time : '';
			var start_4 = (key && key.data && key.data[4]) ? key.data[4].start : '';
			var stop_4 = (key && key.data && key.data[4]) ? key.data[4].stop : '';
			// var sum_var = Number(time_0) + Number(time_1) + Number(time_2) + Number(time_3) + Number(time_4);
			
			// console.log(getKeyByValue(bit_position,key.bit));
			// console.log(getKeyByValue(bit_position,key.bit));
			// $('button[data-id="'+getKeyByValue(bit_position,key.bit)+'"]').removeClass("invalid");
			// $('span[data-id="'+getKeyByValue(bit_position,key.bit)+'"]').removeClass("invalid");
			
			return [key.bit, key.pin, time_0, start_0, stop_0,time_1,start_1,stop_1,time_2,start_2,stop_2,time_3,start_3,stop_3,time_4,start_4,stop_4];
		});
		
		// console.log(excel_final_array);
		var data1 = excel_final_array;
		// var data1 = [['', '', '', '','','','','','','','','','','','','','','']];
	}else{
		var data1 = [['', '', '', '','','','','','','','','','','','','','','']];
	}
	
	var imp = 0;
	function insertColumns(){
		return imp;
		imp++;
	}
	
	// console.log(sequence);
	var table = jexcel(document.getElementById('spreadsheet'), {
		data:data1,
		colHeaders: [ 'Sequence','Pin number', 'T', 'Start', 'Stop' , 'T', 'Start', 'Stop', 'T', 'Start', 'Stop', 'T', 'Start', 'Stop', 'T', 'Start', 'Stop' ],
		nestedHeaders:[
			[
				{ title:''},
				{ title:''},
				{ title:'Time', colspan:'15' },
			],
			[
				{ title:''},
				{ title:''},
				{ title:' 1',colspan:'3'},
				{ title:' 2',colspan:'3'},
				{ title:' 3',colspan:'3'},
				{ title:' 4',colspan:'3'},
				{ title:' 5',colspan:'3'}
			],
		],
		columns: [
			{ type: 'autocomplete', width: 200, source:result_excel_sequence_name },
			{ type: 'autocomplete', width: 120, source:pinData },
			{ type: 'text' },
			{ type: 'text' }
		],
		style: {
			A2:'background-color: ;',
			B1:'background-color: ;',
		}
	});


	$(document).ready(function(){
	  $('input[class="btn btn-primary save"]').click(function(){
			var position = $('#spreadsheet').jexcel('getColumnData', 1);
			var bits = $('#spreadsheet').jexcel('getColumnData', 0);
			
			var val_t_1 = $('#spreadsheet').jexcel('getColumnData', 2);
			var val_start_1 = $('#spreadsheet').jexcel('getColumnData', 3);
			var val_stop_1 = $('#spreadsheet').jexcel('getColumnData', 4);

			var val_t_2 = $('#spreadsheet').jexcel('getColumnData', 5);
			var val_start_2 = $('#spreadsheet').jexcel('getColumnData', 6);
			var val_stop_2 = $('#spreadsheet').jexcel('getColumnData', 7);
			
			var val_t_3 = $('#spreadsheet').jexcel('getColumnData', 8);
			var val_start_3 = $('#spreadsheet').jexcel('getColumnData', 9);
			var val_stop_3 = $('#spreadsheet').jexcel('getColumnData', 10);
			
			var val_t_4 = $('#spreadsheet').jexcel('getColumnData', 11);
			var val_start_4 = $('#spreadsheet').jexcel('getColumnData', 12);
			var val_stop_4 = $('#spreadsheet').jexcel('getColumnData', 13);
			
			var val_t_5 = $('#spreadsheet').jexcel('getColumnData', 14);
			var val_start_5 = $('#spreadsheet').jexcel('getColumnData', 15);
			var val_stop_5 = $('#spreadsheet').jexcel('getColumnData', 16);
			
			var final_data_position = position.map(function(currentValue, index, arr){
				var index_bit_data = bits[index];
				var final_array_Pos = [];
				if(val_t_1[index] || val_start_1[index])
				{
					var final_array_Pos = final_array_Pos.concat({'time':Number(val_t_1[index]),'start':Number(val_start_1[index]),'stop':Number(val_stop_1[index])});
				}
				if(val_t_2[index] || val_start_2[index])
				{
					var final_array_Pos = final_array_Pos.concat({'time':Number(val_t_2[index]),'start':Number(val_start_2[index]),'stop':Number(val_stop_2[index])});
				}
				if(val_t_3[index] || val_start_3[index])
				{
					var final_array_Pos = final_array_Pos.concat({'time':Number(val_t_3[index]),'start':Number(val_start_3[index]),'stop':Number(val_stop_3[index])});
				}
				if(val_t_4[index] || val_start_4[index])
				{
					var final_array_Pos = final_array_Pos.concat({'time':Number(val_t_4[index]),'start':Number(val_start_4[index]),'stop':Number(val_stop_4[index])});
				}
				if(val_t_5[index] || val_start_5[index])
				{
					var final_array_Pos = final_array_Pos.concat({'time':Number(val_t_5[index]),'start':Number(val_start_5[index]),'stop':Number(val_stop_5[index])});
				}
				// 'position':currentValue,
				return 	{
							'bit':index_bit_data,
							'pin':Number(currentValue),
							'data': final_array_Pos
						};
			});
			
			var myJSON_db = JSON.stringify({sequences:final_data_position});
			// console.log(myJSON_db);
			download("data.json", myJSON_db);
			
			$.ajax({
					url: "create-new-car",
					type: 'POST',
					dataType: "JSON",
					data: {
							"_token": "{{ csrf_token() }}",
							"vehicle_id": "{{$vehicle_id}}",
							"type": "led-external-board-id",
							"excel_leds": myJSON_db,
					},
					success: function (response)
					{
						
					}
				});
			
			
	  });
	  
			// $('body').click(function() {
				// jsexcel_event();
			// });
			
			$('input[type="file"]'). change(function(e){
				var fileName = e.target.files[0]. type; //name
				if(fileName === 'application/json')
				{
					$('label[class="file_name"]').html(e.target.files[0].name);
					$('label[class="uploded_file_error"]').html('');
				}else{
					$('label[class="file_name"]').html('');
					$('label[class="uploded_file_error"]').html('Sorry you can upload only json file!');
				}
			});
		
		$('span[class="span invalid"]').remove();
			$('button[class="btn btn-danger invalid"]').remove();
		});
	
		function form_return()
		{
			window.history.back();
		}
			
	</script>
</body>
</html>
