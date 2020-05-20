<html>
<head>

</head>

<body>


<link rel="stylesheet" href="{{ url('/public/excel/jexcel.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ url('/public/excel/jsuites.css') }}" type="text/css" />
<style>
			.btn-primary { color: #fff; background-color: #337ab7; border-color: #2e6da4; }
			.btn { display: inline-block; margin-bottom: 0; font-weight: 400; text-align: center; white-space: nowrap; vertical-align: middle; -ms-touch-action: manipulation; touch-action: manipulation; cursor: pointer; background-image: none; border: 1px solid transparent; padding: 6px 12px; font-size: 14px; line-height: 1.42857143; border-radius: 4px; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; }
			.input-file { display: none; }
			.image-upload-img { width: 60px; cursor: pointer; margin-top: 0px; }
</style>

<form method="POST" enctype="multipart/form-data" id="uploadForm">
		@csrf
		<label><a href='' onclick="$('#spreadsheet').jexcel('insertRow'); event.preventDefault(); return false;">Add row</a></label>
		
        <label style="margin-left: 160px;">Upload File: 
		<img class="image-upload-img" src="https://goo.gl/pB9rpQ"/>
		<input class="input-file" type="file" name="jsonfile"></label>
		<label class="file_name">{{ $page_info["file_name"] }}</label>
		<label style="color:red;margin-right: 17px;" class="uploded_file_error">{{ $page_info["error"] }}</label>
        <input type="submit" class="btn btn-primary" value="Submit">
		
</form>


<div id="spreadsheet"></div>
	<br><br>
	<div class="modal-header">
		<input type="submit" class="btn btn-primary save" value="Save changes">
	</div>
<script src="{{ url('/public/excel/jquery.min.js') }}"></script>
<script src="{{ url('/public/excel/jexcel.js') }}"></script>
<script src="{{ url('/public/excel/jsuites.js') }}"></script>
<script>
	var resultDatas = '{{ $page_info["inputData"] }}';
	var resultData = JSON.parse(resultDatas.replace(/&quot;/g,'"')).leds;
	var result_inputData_val = resultData;

	function inputDataGet(position_val) {
			var found_val = "";
			for(var i = 0; i < result_inputData_val.length; i++) {
			    if (result_inputData_val[i].position == position_val) {
			        found_val = result_inputData_val[i].pin;
			        break;
			    }
			}
		return found_val;
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
	var pinData = resultData.map(function(data) {
			return data.position;
	});
	var jsexcel_event = function(instance, cell, col, row, val) {
			var value_1 = $('#spreadsheet').jexcel('getColumnData', 2);
			var value_2 = $('#spreadsheet').jexcel('getColumnData', 5);
			var value_3 = $('#spreadsheet').jexcel('getColumnData', 8);
			var value_4 = $('#spreadsheet').jexcel('getColumnData', 11);
			var value_5 = $('#spreadsheet').jexcel('getColumnData', 14);
			var totao_sum = 0;
			value_1.map(function(currentValue, index, arr){
			var total_index = index+1;
					totao_sum = parseInt(currentValue);
					if(parseInt(value_2[index]))
					{
						totao_sum = totao_sum+parseInt(value_2[index]);
					}
					if(parseInt(value_3[index]))
					{
						totao_sum = totao_sum+parseInt(value_3[index]);
					}
					if(parseInt(value_4[index]))
					{
						totao_sum = totao_sum+parseInt(value_4[index]);
					}
					if(parseInt(value_5[index]))
					{
						totao_sum = totao_sum+parseInt(value_5[index]);
					}
					
					if(!totao_sum)
					{
							totao_sum = 0;
					}
					$('#spreadsheet').jexcel('setValue', 'R'+total_index,totao_sum);
			});
	}

	var data1 = [
		['', '', '', '','','','','','','','','','','','','','',''],
	];
	var table = jexcel(document.getElementById('spreadsheet'), {
		data:data1,
		colHeaders: [ 'Sequence','Position', 'T', 'Start', 'Stop' , 'T', 'Start', 'Stop', 'T', 'Start', 'Stop', 'T', 'Start', 'Stop', 'T', 'Start', 'Stop', 'ms' ],
		nestedHeaders:[
			[
				{ title:''},
				{ title:''},
				{ title:'Time', colspan:'16' },
			],
			[
				{ title:''},
				{ title:''},
				// { title:' Other Information', colspan:'2' }
				{ title:' 1',colspan:'3'},
				{ title:' 2',colspan:'3'},
				{ title:' 3',colspan:'3'},
				{ title:' 4',colspan:'3'},
				{ title:' 5',colspan:'3'},
				{ title:' Sum'},
			],
		],
		columns: [
			{ type: 'autocomplete', width: 300, source:['X-Light','DayLight','Low beam','High beam','Biinkers left','Biinkers right','Rear Light'] },
			{ type: 'autocomplete', width: 200, source:pinData },
			{ type: 'text' },
			{ type: 'text' }
		],
		style: {
			A2:'background-color: ;',
			B1:'background-color: ;',
		},
		onselection:jsexcel_event,
	});


	$(document).ready(function(){
		
		
		
		var bit_position = { "X-Light": "12", "DayLight": "6", "Low beam": "7", "High beam": "8", "Biinkers left": "9", "Biinkers right": "10", "Rear Light": "11"};
	  $('input[class="btn btn-primary save"]').click(function(){
			var position = $('#spreadsheet').jexcel('getColumnData', 1);
			var bits = $('#spreadsheet').jexcel('getColumnData', 0);
			var val_t_1 = $('#spreadsheet').jexcel('getColumnData', 2);
			var val_start_1 = $('#spreadsheet').jexcel('getColumnData', 3);
			var val_stop_1 = $('#spreadsheet').jexcel('getColumnData', 4);

			var val_t_2 = $('#spreadsheet').jexcel('getColumnData', 5);
			var val_start_2 = $('#spreadsheet').jexcel('getColumnData', 6);
			var val_stop_2 = $('#spreadsheet').jexcel('getColumnData', 7);

			var final_data = position.map(function(currentValue, index, arr){
				// if(bits[index])
				// {
					var index_bit_data = bit_position.currentValue;
				// }
				
				var final_array_Pos = [];
				if(val_t_1[index] || val_start_1[index])
				{
					var final_array_Pos = final_array_Pos.concat({'time':val_t_1[index],'start':val_start_1[index],'stop':val_stop_1[index]});
				}
				
				if(val_t_2[index] || val_start_2[index])
				{
					var final_array_Pos = final_array_Pos.concat({'time':val_t_2[index],'start':val_start_2[index],'stop':val_stop_2[index]});
				}
				return 	{
							'bit':index_bit_data,
							'pin':inputDataGet(currentValue),
							'data': final_array_Pos
						};
			});
				
			var final_array = [];
			for (var i = 0; i < final_data.length; i++) {
					if(final_data[i].bit && final_data[i].pin)
					{
							final_array[i] = final_data[i];
					}
			}

			var myJSON = JSON.stringify({sequences:final_array});
			download("data.json", myJSON);
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
	
	});


</script>
</body>
</html>
