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
	var result_entrance_val = "{{ $entrance_val }}";
	var result_entrance_val_parse = JSON.parse(result_entrance_val.replace(/&quot;/g,'"'));
	
	
	var excel_leds_data = "{{ $excel_leds }}";
	var result_excel_leds_data = JSON.parse(excel_leds_data.replace(/&quot;/g,'"'));
	

	
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
	
	let a = 100;
	let pinData = new Array();
	for(i=0;i<=125;i++)
	{
	  pinData[i]= a.toString();
	  a++;
	}
	
	if(result_excel_leds_data.length > 0){
		
		var excel_final_array = result_excel_leds_data.map(function(key){
			
			var time_0 = (key && key.name) ? key.name : '';
			var time_1 = (key && key.board) ? key.board : '';
			var time_2 = (key && key.driver) ? key.driver : '';
			
			var time_3 = (key && key.type) ? key.type : '';
			var time_4 = (key && key.sequence) ? key.sequence : '';
			
			
			return [time_0, time_1, time_2, time_3,time_4];
		});
		var data1 = excel_final_array;
	}else{
		var data1 = [['', '', '',  '', '']];
	}
	
	var imp = 0;
	function insertColumns(){
		return imp;
		imp++;
	}
	
	
	
	// console.log(sequence);
	var table = jexcel(document.getElementById('spreadsheet'), {
		data:data1,
		colHeaders: [ '<b>Name</b>','Board', 'Driver' , 'Type' ,'<b>Sequence</b>'],
		nestedHeaders:[
			[
				{ title:'LED sequence config', colspan:'5'}
			],
			[
				{ title:''},
				{ title:'<b>ID</b>',colspan:'3'},
				{ title:''},
			],
		],
		columns: [
			{ type: 'autocomplete', width: 200, source:result_entrance_val_parse },
			{ type: 'autocomplete', width: 120, source:pinData },
			{ type: 'autocomplete', width: 130, source:["0","1","2","3","4","5","6","7","8","9"] },
			{ type: 'autocomplete', width: 75, source:["0","1","2","3","4","5","6","7","8","9"] },
			{ type: 'autocomplete', width: 150, source:sequence }
		],
		style: {
			A2:'background-color: ;',
			B1:'background-color: ;',
		}
	});


	$(document).ready(function(){
	  $('input[class="btn btn-primary save"]').click(function(){
			var boardId = $('#spreadsheet').jexcel('getColumnData', 0);
			var motor_id = $('#spreadsheet').jexcel('getColumnData', 1);
			var type_id = $('#spreadsheet').jexcel('getColumnData', 2);
			var gear_ratio = $('#spreadsheet').jexcel('getColumnData', 3);
			var mode = $('#spreadsheet').jexcel('getColumnData', 4);
			
			var final_data_position = boardId.map(function(currentValue, index, arr){
				var index_bit_data = currentValue;
				var index_motor_id = motor_id[index];
				var index_type_id = type_id[index];
				var index_gear_ratio = gear_ratio[index];
				var index_mode = mode[index];
				
				return {name:index_bit_data, board:index_motor_id, driver:index_type_id, type:index_gear_ratio, sequence:index_mode};

			});
			
			download("data.json", JSON.stringify(final_data_position));
			$.ajax({
					url: "led-motor-excel-sheet",
					type: 'POST',
					dataType: "JSON",
					data: {
							"_token": "{{ csrf_token() }}",
							"vehicle_id": "{{ $_GET['vehicle_id'] }}",
							"type": "led-sequence-config",
							"excel_leds": final_data_position,
					},
					success: function (response)
					{
						
					}
				});
			
			
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
