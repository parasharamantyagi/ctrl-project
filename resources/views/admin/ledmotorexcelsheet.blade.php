<html>
	<head>
	<link rel="stylesheet" href="{{ url('/excel/jexcel.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ url('/excel/jsuites.css') }}" type="text/css" />
	<style>
			.btn-primary { color: #fff; background-color: #337ab7; border-color: #2e6da4; }
			.btn { display: inline-block; margin-bottom: 0; font-weight: 400; text-align: center; white-space: nowrap; vertical-align: middle; -ms-touch-action: manipulation; touch-action: manipulation; cursor: pointer; background-image: none; border: 1px solid transparent; padding: 6px 12px; font-size: 14px; line-height: 1.42857143; border-radius: 4px; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; }
			.input-file { display: none; }
			.excel_sav_button { margin-left: 20px; }
			.image-upload-img { width: 60px; cursor: pointer; margin-top: 0px; }
	</style>
			<style>
			
				
			</style>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	</head>
<body>

		<br><br>
		<div class="excel_sav_button">
		<label><a href='' onclick="$('#spreadsheet').jexcel('insertRow'); event.preventDefault(); return false;">Add row</a></label>
		<label><a href='javascript:void(0)' onclick="insertColumns()">Add column</a></label>
		<label><a href='javascript:void(0)' onclick="deleteAllRows()">Delete all rows</a></label>
		<br>
		<div id="spreadsheet"></div>
		<br><br>
		<div class="modal-header">
			<input type="submit" class="btn btn-primary save" value="Save changes">
		</div>
		</div>
		
	<script src="{{ url('/newbootstrap/vendor/jquery/jquery.min.js') }}"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="{{ url('/excel/jexcel.js') }}"></script>
	<script src="{{ url('/excel/jsuites.js') }}"></script>
	
	<script>
	var resultDatas = "{{ json_encode($data_leds) }}";
	var result_entrance_val = "{{ $entrance_val }}";
	var result_entrance_val_parse = JSON.parse(result_entrance_val.replace(/&quot;/g,'"'));
	
	// console.log(result_entrance_val_parse);
	
	var excel_leds_data = "{{ $excel_leds }}";
	var result_excel_leds_data = JSON.parse(excel_leds_data.replace(/&quot;/g,'"'));
	// var resultDatas = '{{ $page_info["inputData"] }}';
	
	var resultData = JSON.parse(resultDatas.replace(/&quot;/g,'"'));
	var result_inputData_val = resultData;


	
	function deleteAllRows(){
		if(confirm('Are you sure to delete all rows ...?')){
			$.ajax({
					url: "led-motor-excel-sheet",
					type: 'POST',
					dataType: "JSON",
					data: {
							"_token": "{{ csrf_token() }}",
							"vehicle_id": "{{ $_GET['vehicle_id'] }}",
							"type": "delete_excel_leds"
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
	
	const allKey = Object.keys(resultData);
	function download(file, text) {
                    var element = document.createElement('a');
                    element.setAttribute('href', 'data:text/plain;charset=utf-8, '
                                         + encodeURIComponent(text));
                    element.setAttribute('download', file);
                    document.body.appendChild(element);
                    element.click();
                    document.body.removeChild(element);
                }

	var allBitVal = Object.values(resultData);
	// var bitVal = allBitVal.map(function(data) {
			// return data.bit.toString();
	// });
	// var pinDatas = resultData.map(function(data) {
			// return data.pin;
	// });
	// var pinData = pinDatas.sort((a,b)=>a-b);
	
	let a = 100;
	let pinData = new Array();
	for(i=0;i<=125;i++)
	{
	  pinData[i]= a.toString();
	  a++;
	}
	
	
	function getKeyByValue(object, value) {
	  return Object.keys(object).find(key => object[key] === value);
	}
	
	var bit_position = { "Bluetooth connect": 0, "Lights (beam + rear)": 1, "Daylight left": 2,"Daylight right": 3, "High beam": 5, "Blinkers left": 6, "Blinkers right": 7, "Rear Light": 8, "Brake lights": 9, "X-Light": 10, "Hazard light": 12, "Demo": 34,"Bluetooth advertising":35, "Battery charging indication": 36, "Power ON indication": 37, "Power OFF indication": 38, "Bluetooth disconnect": 39};
	var jsexcel_event = function(instance, cell, col, row, val) {
			// var value_1 = $('#spreadsheet').jexcel('getColumnData', 2);
			// var value_2 = $('#spreadsheet').jexcel('getColumnData', 5);
			// var value_3 = $('#spreadsheet').jexcel('getColumnData', 8);
			// var value_4 = $('#spreadsheet').jexcel('getColumnData', 11);
			// var value_5 = $('#spreadsheet').jexcel('getColumnData', 14);
			// var totao_sum = 0;
			// value_1.map(function(currentValue, index, arr){
			// var total_index = index+1;
					// totao_sum = parseInt(currentValue);
					// if(parseInt(value_2[index]))
					// {
						// totao_sum = totao_sum+parseInt(value_2[index]);
					// }
					// if(parseInt(value_3[index]))
					// {
						// totao_sum = totao_sum+parseInt(value_3[index]);
					// }
					// if(parseInt(value_4[index]))
					// {
						// totao_sum = totao_sum+parseInt(value_4[index]);
					// }
					// if(parseInt(value_5[index]))
					// {
						// totao_sum = totao_sum+parseInt(value_5[index]);
					// }
					
					// if(!totao_sum)
					// {
							// totao_sum = 0;
					// }
					// $('#spreadsheet').jexcel('setValue', 'R'+total_index,totao_sum);
			// });
	}
	
	// console.log(result_excel_leds_data);
	if(result_excel_leds_data.length > 0){
		
		// var result_excel_leds_data_sequences = result_excel_leds_data.sequences;
		// var excel_final_array = [];
		// var excel_final_array = result_excel_leds_data.map(function(key){
			
			// var time_0 = (key && key.data && key.data[0]) ? key.data[0].time : '';
			// var time_1 = (key && key.data && key.data[0]) ? key.data[0].start : '';
			// var time_2 = (key && key.data && key.data[0]) ? key.data[0].stop : '';
			
			// var time_3 = (key && key.data && key.data[1]) ? key.data[1].time : '';
			// var time_4 = (key && key.data && key.data[1]) ? key.data[1].start : '';
			// var time_5 = (key && key.data && key.data[1]) ? key.data[1].stop : '';
			
			// var time_6 = (key && key.data && key.data[2]) ? key.data[2].time : '';
			// var time_7 = (key && key.data && key.data[2]) ? key.data[2].start : '';
			// var time_8 = (key && key.data && key.data[2]) ? key.data[2].stop : '';
			
			// var time_9 = (key && key.data && key.data[3]) ? key.data[3].time : '';
			// var time_10 = (key && key.data && key.data[3]) ? key.data[3].start : '';
			// var time_11 = (key && key.data && key.data[3]) ? key.data[3].stop : '';
			
			// var time_12 = (key && key.data && key.data[4]) ? key.data[4].time : '';
			// var time_13 = (key && key.data && key.data[4]) ? key.data[4].start : '';
			// var time_14 = (key && key.data && key.data[4]) ? key.data[4].stop : '';
			
			// return [time_0, time_1, time_2, time_3,time_4,time_5,time_6,start_2,stop_2,time_3,start_3,stop_3,time_4,start_4,stop_4,sum_var];
		// });
		var data1 = result_excel_leds_data;
	}else{
		var data1 = [['', '', '',  '', '', '', '', '','','','','','','']];
	}
	
	var imp = 0;
	function insertColumns(){
		return imp;
		imp++;
	}
	
	
	
	// console.log(pinData);
	var table = jexcel(document.getElementById('spreadsheet'), {
		data:data1,
		colHeaders: [ '<b>ID</b>','<b>BoardID</b>','<b>DriverID</b>', '<b>TypeID</b>', '<b>Gear ratio<br/>(for stepper)</b>', '<b>Mode</b>','Value 1 (KMH/%)', 'Unit', 'Value 2 <br/>(PPS/Steps, time)' , 'Unit' , 'Value 1 (KMH/%)', 'Unit', 'Value 2 <br/>(time,mm)', 'Unit' ],
		nestedHeaders:[
			[
				{ title:''},
				{ title:''},
				{ title:''},
				{ title:''},
				{ title:''},
				{ title:''},
				{ title:'<b>Motor</b>', colspan:'8' },
			],
			[
				{ title:''},
				{ title:''},
				{ title:'<b>MOTOR ID</b>'},
				{ title:''},
				{ title:''},
				{ title:''},
				{ title:'<b>ON mode</b>',colspan:'4'},
				{ title:'<b>OFF mode</b>',colspan:'4'},
			],
		],
		columns: [
			{ type: 'autocomplete', width: 150, source:result_entrance_val_parse },
			{ type: 'autocomplete', width: 100, source:pinData },
			{ type: 'autocomplete', width: 175, source:["0","1","2","3","4","5","6","7","8","9"] },
			{ type: 'autocomplete', width: 75, source:["0","1","2","3","4","5","6","7","8","9"] },
			{ type: 'text', width: 180 },
			{ type: 'autocomplete', width: 120, source:["Speed control","Angle control"] },
			{ type: 'text', width: 130 },
			{ type: 'text', width: 75 },
			{ type: 'text', width: 150 },
			{ type: 'text', width: 75 },
			{ type: 'text', width: 130 },
			{ type: 'text', width: 75 },
			{ type: 'text', width: 150 },
			{ type: 'text', width: 75 }
		],
		style: {
			A2:'background-color: ;',
			B1:'background-color: ;',
		},
		onselection:jsexcel_event,
	});


	$(document).ready(function(){
	  $('input[class="btn btn-primary save"]').click(function(){
			var boardId = $('#spreadsheet').jexcel('getColumnData', 0);
			var motor_id = $('#spreadsheet').jexcel('getColumnData', 1);
			var type_id = $('#spreadsheet').jexcel('getColumnData', 2);
			var gear_ratio = $('#spreadsheet').jexcel('getColumnData', 3);
			var mode = $('#spreadsheet').jexcel('getColumnData', 4);
			
			var on_mode_val_1 = $('#spreadsheet').jexcel('getColumnData', 5);
			var on_mode_unit_1 = $('#spreadsheet').jexcel('getColumnData', 6);
			var on_mode_val_2 = $('#spreadsheet').jexcel('getColumnData', 7);
			var on_mode_unit_2 = $('#spreadsheet').jexcel('getColumnData', 8);

			var off_mode_val_1 = $('#spreadsheet').jexcel('getColumnData', 9);
			var off_mode_unit_1 = $('#spreadsheet').jexcel('getColumnData', 10);
			var off_mode_val_2 = $('#spreadsheet').jexcel('getColumnData', 11);
			var off_mode_unit_2 = $('#spreadsheet').jexcel('getColumnData', 12);

			var off_mode_unit_3 = $('#spreadsheet').jexcel('getColumnData', 13);
			
			var final_data_position = boardId.map(function(currentValue, index, arr){
				let object_data = [];
				if(currentValue != "" || motor_id[index] != "" || type_id[index] != "" || gear_ratio[index] != ""){
				var index_bit_data = currentValue;
				var index_motor_id = motor_id[index];
				var index_type_id = type_id[index];
				var index_gear_ratio = gear_ratio[index];
				var index_mode = mode[index];
				
				var index_on_mode_val_1 = on_mode_val_1[index];
				var index_on_mode_unit_1 = on_mode_unit_1[index];
				var index_on_mode_val_2 = on_mode_val_2[index];
				var index_on_mode_unit_2 = on_mode_unit_2[index];
				
				var index_off_mode_val_1 = off_mode_val_1[index];
				var index_off_mode_unit_1 = off_mode_unit_1[index];
				var index_off_mode_val_2 = off_mode_val_2[index];
				var index_off_mode_unit_2 = off_mode_unit_2[index];
				object_data = [
						index_bit_data, index_motor_id, index_type_id, index_gear_ratio, index_mode, 
						index_on_mode_val_1, index_on_mode_unit_1, index_on_mode_val_2, index_on_mode_unit_2,
						index_off_mode_val_1, index_off_mode_unit_1, index_off_mode_val_2, index_off_mode_unit_2
					];
				}
				return object_data;
			});
			// console.log(final_data_position[0].length);
			
			var final_data_position_s = boardId.map(function(currentValue, index, arr){
				
				var index_MOTOR_ID = motor_id[index]+type_id[index]+gear_ratio[index];
				
				return {
						ID: currentValue, BoardID: motor_id[index], 
						MOTOR_ID: index_MOTOR_ID, DRIVER_ID: type_id[index], TypeID: gear_ratio[index], 
						Gear_ratio: mode[index], mode: on_mode_val_1[index],
						on_mode_val_1: on_mode_unit_1[index], on_mode_unit_1: on_mode_val_2[index],
						on_mode_val_2: on_mode_unit_2[index], on_mode_unit_2: off_mode_val_1[index],
						off_mode_val_1: off_mode_unit_1[index], off_mode_unit_1: off_mode_val_2[index],
						off_mode_val_2: off_mode_unit_2[index], off_mode_unit_2: off_mode_unit_3[index]
				};
			});
			
			download("data.json", JSON.stringify(final_data_position_s));
			if(final_data_position[0].length){
				$.ajax({
					url: "led-motor-excel-sheet",
					type: 'POST',
					dataType: "JSON",
					data: {
							"_token": "{{ csrf_token() }}",
							"vehicle_id": "{{ $_GET['vehicle_id'] }}",
							"type": "excel_leds",
							"excel_leds": final_data_position,
					},
					success: function (response)
					{
						// if(response.status == true){
							// window.location.href = "";
						// }
					}
				});
			}
			
	  });
	  
			$('body').click(function() {
				jsexcel_event();
			});
			
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
			
		// <button type="button" data-id="X-Light" class="btn btn-danger">
		// function transition(ii) {
			// console.log(ii);
		// }
		
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
