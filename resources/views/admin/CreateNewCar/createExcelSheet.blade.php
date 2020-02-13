<html>
<head>

</head>

<body>


<link rel="stylesheet" href="{{ url('/public/excel/jexcel.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ url('/public/excel/jsuites.css') }}" type="text/css" />



<form method="POST" enctype="multipart/form-data">
		@csrf
		<label><a href='' onclick="$('#spreadsheet').jexcel('insertRow'); event.preventDefault(); return false;">Add row</a></label>
        <label style="margin-left: 160px;">Upload File: <input type="file" name="jsonfile"></label>
		<label style="color:red;margin-right: 17px;">{{ $page_info["error"] }}</label>
        <input type="submit" value="Submit">
</form>
	

<div id="spreadsheet"></div>

<script src="{{ url('/public/excel/jquery.min.js') }}"></script>
<script src="{{ url('/public/excel/jexcel.js') }}"></script>
<script src="{{ url('/public/excel/jsuites.js') }}"></script>
<script>
	var resultDatas = '{{ $page_info["inputData"] }}';
	var result_inputData_val = JSON.parse(('{{ $page_info["inputData_val"] }}').replace(/&quot;/g,'"')).leds;
	
	// JSON.stringify();
	var resultData = JSON.parse(resultDatas.replace(/&quot;/g,'"'));
	
	const allKey = Object.keys(resultData);
	// console.log(result_inputData_val);
	
	var allBitVal = Object.values(resultData);
	var bitVal = allBitVal.map(function(data) {
			return data.bit.toString();
	});
	
	// 
	var pinData = result_inputData_val.map(function(data) {
			return data.position;
	});
	// console.log(pinData);
	
	
	var jsexcel_event = function(instance, cell, col, row, val) {
			// console.log('hbhjbjkjn');
			var value_1 = $('#spreadsheet').jexcel('getColumnData', 2);
			var value_2 = $('#spreadsheet').jexcel('getColumnData', 5);
			// console.log(value_1);
			// console.log(col);
			var totao_sum = 0;
			value_1.map(function(currentValue, index, arr){
			var total_index = index+1;
					totao_sum = parseInt(currentValue);
					if(parseInt(value_2[index]))
					{
						totao_sum = totao_sum+parseInt(value_2[index]);
					}
					
					$('#spreadsheet').jexcel('setValue', 'R'+total_index,totao_sum);
					// $('#spreadsheet').jexcel('setValue', 'Q'+total_index,'12');
			});
			// console.log(value);
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
			{ type: 'autocomplete', width: 300, source:allKey },
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
</script>
</body>
</html>