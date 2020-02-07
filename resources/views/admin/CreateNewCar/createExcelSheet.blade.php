<html>
<head>

</head>

<body>


<link rel="stylesheet" href="{{ url('/public/excel/jexcel.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ url('/public/excel/jsuites.css') }}" type="text/css" />


<ul>
	<li><a href='' onclick="$('#spreadsheet').jexcel('insertRow'); event.preventDefault(); return false;">Insert a new blank row at the end of the table</a></li>
</ul>
<div id="spreadsheet"></div>

<script src="{{ url('/public/excel/jquery.min.js') }}"></script>
<script src="{{ url('/public/excel/jexcel.js') }}"></script>
<script src="{{ url('/public/excel/jsuites.js') }}"></script>
<script>
	var data1 = [
		['X-light 1', 'F1', '100', '0','0','100','100','100','','','','','','','','',''],
		['X-light 2', 'F-1', '100', '0','0','100','100','100','','','','','','','','',''],
		['X-light 3', 'i3', '100', '100','0','100','100','100','','','','','','','','',''],
		['Blinkers LEFT', 'i-3', '100', '100','0','100','100','100','','','','','','','','',''],
		['', '', '', '','','','','','','','','','','','','',''],
		['', '', '', '','','','','','','','','','','','','',''],
		['', '', '', '','','','','','','','','','','','','',''],
		['', '', '', '','','','','','','','','','','','','',''],
		['', '', '', '','','','','','','','','','','','','',''],
		['', '', '', '','','','','','','','','','','','','',''],
		['', '', '', '','','','','','','','','','','','','',''],
		['', '', '', '','','','','','','','','','','','','',''],
		['', '', '', '','','','','','','','','','','','','',''],
		['', '', '', '','','','','','','','','','','','','',''],
		['', '', '', '','','','','','','','','','','','','',''],
		['', '', '', '','','','','','','','','','','','','',''],
	];
	var table = jexcel(document.getElementById('spreadsheet'), {
		data:data1,
		colHeaders: [ 'Sequence','Position', 'T', 'Start', 'Stop' , 'T', 'Start', 'Stop', 'T', 'Start', 'Stop', 'T', 'Start', 'Stop', 'T', 'Start', 'Stop' ],
		nestedHeaders:[
			[
				{ title:''},
				{ title:''},
				{ title:'Time', colspan:'15' },
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
			],
		],
		columns: [
			{ type: 'text', width: 300, url: '/jexcel/countries', autocomplete: true, multiple: true },
			{ type: 'text', width: 200 },
			{ type: 'text' },
			{ type: 'text' },
		],
		style: {
			A2:'background-color: ;',
			B1:'background-color: ;',
		},
	});
</script>
</body>
</html>