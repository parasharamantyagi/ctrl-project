<html>
	<head>
	<link rel="stylesheet" href="{{ url('/public/excel/jexcel.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ url('/public/excel/jsuites.css') }}" type="text/css" />
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
				td.parent {
					background-color: #242533;
					color: white;
					border: none;
					font-size: 12px;
				}
				td.parent.plus {
					padding-left: 7px;
				}
				.container {
					background-color: #242533 !important;
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
					background: url("http://18.212.23.117/public/assets/ctrlImages/LED-config-tool.png") no-repeat;
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


		<!-- button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Small Modal</button>


		<!-- Modal -->
		  <div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog modal-sm">
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">LED configuration</h4>
				</div>
				<div class="modal-body">
				  <p>
					  <!-- select class="color-select">
						<option value="1">Select color</option>
						<option style="background-color: white;" value="white">White</option>
						<option style="background-color: yellow;" value="yellow">Yellow</option>
						<option style="background-color: blue;" value="blue">Blue</option>
						<option style="background-color: red;" value="red">Red</option>
						<option style="background-color: orange;" value="orange">Orange</option>
					  </select -->
					  <select class="color-select">
						<option value="#ffffff">Select color</option>
						<option style="background-color: #f2f2f2;" value="f2f2f2">Day</option>
						<option style="background-color: #ffffff;" value="ffffff">Beam</option>
						<option style="background-color: #ff8000;" value="ff8000">Blinkers</option>
						<option style="background-color: blue;" value="blue">Blue</option>
						<option style="background-color: #ff0000;" value="ff0000">Rear</option>
						<option style="background-color: #c10603;" value="c10603">Brake</option>
					  </select>
				  </p>
				  <p>
					  <select class="value-select">
						<option value="0">Select pinout</option>
						<?php for($val =0; $val<=23; $val++) { ?>
							<option value="<?php echo $val; ?>"><?php echo $val; ?></option>
						<?php } ?>
					  </select>
				  </p>

				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
				</div>
			  </div>
			</div>
		  </div>
		<?php
		function trim_characters_color($array,$position,$key_val) {
			if(in_array($position, array_column($array, 'position'))) {
			$key = array_search($position, array_column($array,'position'));
				return $array[$key][$key_val];
			}else{
				return 'white';
			}
		}
		
		function trim_characters($array,$position,$key_val) {
			if(in_array($position, array_column($array, 'position'))) {
			$key = array_search($position, array_column($array,'position'));
				return $array[$key][$key_val];
			}else{
				return '';
			}
		}
		
		if(session()->has('flash-message')){
				$data_leds = json_decode(session()->get('flash-message'),true)['leds'];		
		}
		?>
		<table class="myTable car" id="myTable" border="1px">
				<tbody>
					<tr>
						<td class="parent plus">9</td>
						<td class="child {{trim_characters($data_leds,'F9','color')}}" data-color="{{trim_characters_color($data_leds,'F9','color')}}" data-position="F9">{{trim_characters($data_leds,'F9','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'G9','color')}}" data-color="{{trim_characters_color($data_leds,'G9','color')}}" data-position="G9">{{trim_characters($data_leds,'G9','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'H9','color')}}" data-color="{{trim_characters_color($data_leds,'H9','color')}}" data-position="H9">{{trim_characters($data_leds,'H9','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'I9','color')}}" data-color="{{trim_characters_color($data_leds,'I9','color')}}" data-position="I9">{{trim_characters($data_leds,'I9','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'J9','color')}}" data-color="{{trim_characters_color($data_leds,'J9','color')}}" data-position="J9">{{trim_characters($data_leds,'J9','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'K9','color')}}" data-color="{{trim_characters_color($data_leds,'K9','color')}}" data-position="K9">{{trim_characters($data_leds,'K9','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'L9','color')}}" data-color="{{trim_characters_color($data_leds,'L9','color')}}" data-position="L9">{{trim_characters($data_leds,'L9','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'M9','color')}}" data-color="{{trim_characters_color($data_leds,'M9','color')}}" data-position="M9">{{trim_characters($data_leds,'M9','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'N9','color')}}" data-color="{{trim_characters_color($data_leds,'N9','color')}}" data-position="N9">{{trim_characters($data_leds,'N9','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'O9','color')}}" data-color="{{trim_characters_color($data_leds,'O9','color')}}" data-position="O9">{{trim_characters($data_leds,'O9','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'P9','color')}}" data-color="{{trim_characters_color($data_leds,'P9','color')}}" data-position="P9">{{trim_characters($data_leds,'P9','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'Q9','color')}}" data-color="{{trim_characters_color($data_leds,'Q9','color')}}" data-position="Q9">{{trim_characters($data_leds,'Q9','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'R9','color')}}" data-color="{{trim_characters_color($data_leds,'R9','color')}}" data-position="R9">{{trim_characters($data_leds,'R9','pin')}}</td>
						<td class="parent plus">9</td>
					</tr>
					<tr>
						<td class="parent plus">8</td>
						<td class="child {{trim_characters($data_leds,'F8','color')}}" data-color="{{trim_characters_color($data_leds,'F8','color')}}" data-position="F8">{{trim_characters($data_leds,'F8','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'G8','color')}}" data-color="{{trim_characters_color($data_leds,'G8','color')}}" data-position="G8">{{trim_characters($data_leds,'G8','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'H8','color')}}" data-color="{{trim_characters_color($data_leds,'H8','color')}}" data-position="H8">{{trim_characters($data_leds,'H8','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'I8','color')}}" data-color="{{trim_characters_color($data_leds,'I8','color')}}" data-position="I8">{{trim_characters($data_leds,'I8','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'J8','color')}}" data-color="{{trim_characters_color($data_leds,'J8','color')}}" data-position="J8">{{trim_characters($data_leds,'J8','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'K8','color')}}" data-color="{{trim_characters_color($data_leds,'K8','color')}}" data-position="K8">{{trim_characters($data_leds,'K8','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'L8','color')}}" data-color="{{trim_characters_color($data_leds,'L8','color')}}" data-position="L8">{{trim_characters($data_leds,'L8','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'M8','color')}}" data-color="{{trim_characters_color($data_leds,'M8','color')}}" data-position="M8">{{trim_characters($data_leds,'M8','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'N8','color')}}" data-color="{{trim_characters_color($data_leds,'N8','color')}}" data-position="N8">{{trim_characters($data_leds,'N8','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'O8','color')}}" data-color="{{trim_characters_color($data_leds,'O8','color')}}" data-position="O8">{{trim_characters($data_leds,'O8','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'P8','color')}}" data-color="{{trim_characters_color($data_leds,'P8','color')}}" data-position="P8">{{trim_characters($data_leds,'P8','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'Q8','color')}}" data-color="{{trim_characters_color($data_leds,'Q8','color')}}" data-position="Q8">{{trim_characters($data_leds,'Q8','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'R8','color')}}" data-color="{{trim_characters_color($data_leds,'R8','color')}}" data-position="R8">{{trim_characters($data_leds,'R8','pin')}}</td>
						<td class="parent plus">8</td>
					</tr>
					<tr>
						<td class="parent plus">7</td>
						<td class="child {{trim_characters($data_leds,'F7','color')}}" data-color="{{trim_characters_color($data_leds,'F7','color')}}" data-position="F7">{{trim_characters($data_leds,'F7','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'G7','color')}}" data-color="{{trim_characters_color($data_leds,'G7','color')}}" data-position="G7">{{trim_characters($data_leds,'G7','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'H7','color')}}" data-color="{{trim_characters_color($data_leds,'H7','color')}}" data-position="H7">{{trim_characters($data_leds,'H7','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'I7','color')}}" data-color="{{trim_characters_color($data_leds,'I7','color')}}" data-position="I7">{{trim_characters($data_leds,'I7','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'J7','color')}}" data-color="{{trim_characters_color($data_leds,'J7','color')}}" data-position="J7">{{trim_characters($data_leds,'J7','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'K7','color')}}" data-color="{{trim_characters_color($data_leds,'K7','color')}}" data-position="K7">{{trim_characters($data_leds,'K7','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'L7','color')}}" data-color="{{trim_characters_color($data_leds,'L7','color')}}" data-position="L7">{{trim_characters($data_leds,'L7','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'M7','color')}}" data-color="{{trim_characters_color($data_leds,'M7','color')}}" data-position="M7">{{trim_characters($data_leds,'M7','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'N7','color')}}" data-color="{{trim_characters_color($data_leds,'N7','color')}}" data-position="N7">{{trim_characters($data_leds,'N7','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'O7','color')}}" data-color="{{trim_characters_color($data_leds,'O7','color')}}" data-position="O7">{{trim_characters($data_leds,'O7','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'P7','color')}}" data-color="{{trim_characters_color($data_leds,'P7','color')}}" data-position="P7">{{trim_characters($data_leds,'P7','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'Q7','color')}}" data-color="{{trim_characters_color($data_leds,'Q7','color')}}" data-position="Q7">{{trim_characters($data_leds,'Q7','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'R7','color')}}" data-color="{{trim_characters_color($data_leds,'R7','color')}}" data-position="R7">{{trim_characters($data_leds,'R7','pin')}}</td>
						<td class="parent plus">7</td>
					</tr>
					<tr>
						<td class="parent plus">6</td>
						<td class="child {{trim_characters($data_leds,'F6','color')}}" data-color="{{trim_characters_color($data_leds,'F6','color')}}" data-position="F6">{{trim_characters($data_leds,'F6','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'G6','color')}}" data-color="{{trim_characters_color($data_leds,'G6','color')}}" data-position="G6">{{trim_characters($data_leds,'G6','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'H6','color')}}" data-color="{{trim_characters_color($data_leds,'H6','color')}}" data-position="H6">{{trim_characters($data_leds,'H6','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'I6','color')}}" data-color="{{trim_characters_color($data_leds,'I6','color')}}" data-position="I6">{{trim_characters($data_leds,'I6','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'J6','color')}}" data-color="{{trim_characters_color($data_leds,'J6','color')}}" data-position="J6">{{trim_characters($data_leds,'J6','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'K6','color')}}" data-color="{{trim_characters_color($data_leds,'K6','color')}}" data-position="K6">{{trim_characters($data_leds,'K6','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'L6','color')}}" data-color="{{trim_characters_color($data_leds,'L6','color')}}" data-position="L6">{{trim_characters($data_leds,'L6','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'M6','color')}}" data-color="{{trim_characters_color($data_leds,'M6','color')}}" data-position="M6">{{trim_characters($data_leds,'M6','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'N6','color')}}" data-color="{{trim_characters_color($data_leds,'N6','color')}}" data-position="N6">{{trim_characters($data_leds,'N6','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'O6','color')}}" data-color="{{trim_characters_color($data_leds,'O6','color')}}" data-position="O6">{{trim_characters($data_leds,'O6','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'P6','color')}}" data-color="{{trim_characters_color($data_leds,'P6','color')}}" data-position="P6">{{trim_characters($data_leds,'P6','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'Q6','color')}}" data-color="{{trim_characters_color($data_leds,'Q6','color')}}" data-position="Q6">{{trim_characters($data_leds,'Q6','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'R6','color')}}" data-color="{{trim_characters_color($data_leds,'R6','color')}}" data-position="R6">{{trim_characters($data_leds,'R6','pin')}}</td>
						<td class="parent plus">6</td>
					</tr>
					<tr>
						<td class="parent plus">5</td>
						<td class="child {{trim_characters($data_leds,'F5','color')}}" data-color="{{trim_characters_color($data_leds,'F5','color')}}" data-position="F5">{{trim_characters($data_leds,'F5','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'G5','color')}}" data-color="{{trim_characters_color($data_leds,'G5','color')}}" data-position="G5">{{trim_characters($data_leds,'G5','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'H5','color')}}" data-color="{{trim_characters_color($data_leds,'H5','color')}}" data-position="H5">{{trim_characters($data_leds,'H5','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'I5','color')}}" data-color="{{trim_characters_color($data_leds,'I5','color')}}" data-position="I5">{{trim_characters($data_leds,'I5','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'J5','color')}}" data-color="{{trim_characters_color($data_leds,'J5','color')}}" data-position="J5">{{trim_characters($data_leds,'J5','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'K5','color')}}" data-color="{{trim_characters_color($data_leds,'K5','color')}}" data-position="K5">{{trim_characters($data_leds,'K5','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'L5','color')}}" data-color="{{trim_characters_color($data_leds,'L5','color')}}" data-position="L5">{{trim_characters($data_leds,'L5','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'M5','color')}}" data-color="{{trim_characters_color($data_leds,'M5','color')}}" data-position="M5">{{trim_characters($data_leds,'M5','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'N5','color')}}" data-color="{{trim_characters_color($data_leds,'N5','color')}}" data-position="N5">{{trim_characters($data_leds,'N5','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'O5','color')}}" data-color="{{trim_characters_color($data_leds,'O5','color')}}" data-position="O5">{{trim_characters($data_leds,'O5','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'P5','color')}}" data-color="{{trim_characters_color($data_leds,'P5','color')}}" data-position="P5">{{trim_characters($data_leds,'P5','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'Q5','color')}}" data-color="{{trim_characters_color($data_leds,'Q5','color')}}" data-position="Q5">{{trim_characters($data_leds,'Q5','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'R5','color')}}" data-color="{{trim_characters_color($data_leds,'R5','color')}}" data-position="R5">{{trim_characters($data_leds,'R5','pin')}}</td>
						<td class="parent plus">5</td>
					</tr>
					<tr>
						<td class="parent plus">4</td>
						<td class="child {{trim_characters($data_leds,'F4','color')}}" data-color="{{trim_characters_color($data_leds,'F4','color')}}" data-position="F4">{{trim_characters($data_leds,'F4','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'G4','color')}}" data-color="{{trim_characters_color($data_leds,'G4','color')}}" data-position="G4">{{trim_characters($data_leds,'G4','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'H4','color')}}" data-color="{{trim_characters_color($data_leds,'H4','color')}}" data-position="H4">{{trim_characters($data_leds,'H4','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'I4','color')}}" data-color="{{trim_characters_color($data_leds,'I4','color')}}" data-position="I4">{{trim_characters($data_leds,'I4','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'J4','color')}}" data-color="{{trim_characters_color($data_leds,'J4','color')}}" data-position="J4">{{trim_characters($data_leds,'J4','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'K4','color')}}" data-color="{{trim_characters_color($data_leds,'K4','color')}}" data-position="K4">{{trim_characters($data_leds,'K4','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'L4','color')}}" data-color="{{trim_characters_color($data_leds,'L4','color')}}" data-position="L4">{{trim_characters($data_leds,'L4','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'M4','color')}}" data-color="{{trim_characters_color($data_leds,'M4','color')}}" data-position="M4">{{trim_characters($data_leds,'M4','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'N4','color')}}" data-color="{{trim_characters_color($data_leds,'N4','color')}}" data-position="N4">{{trim_characters($data_leds,'N4','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'O4','color')}}" data-color="{{trim_characters_color($data_leds,'O4','color')}}" data-position="O4">{{trim_characters($data_leds,'O4','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'P4','color')}}" data-color="{{trim_characters_color($data_leds,'P4','color')}}" data-position="P4">{{trim_characters($data_leds,'P4','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'Q4','color')}}" data-color="{{trim_characters_color($data_leds,'Q4','color')}}" data-position="Q4">{{trim_characters($data_leds,'Q4','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'R4','color')}}" data-color="{{trim_characters_color($data_leds,'R4','color')}}" data-position="R4">{{trim_characters($data_leds,'R4','pin')}}</td>
						<td class="parent plus">4</td>
					</tr>
					<tr>
						<td class="parent plus">3</td>
						<td class="child {{trim_characters($data_leds,'F3','color')}}" data-color="{{trim_characters_color($data_leds,'F3','color')}}" data-position="F3">{{trim_characters($data_leds,'F3','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'G3','color')}}" data-color="{{trim_characters_color($data_leds,'G3','color')}}" data-position="G3">{{trim_characters($data_leds,'G3','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'H3','color')}}" data-color="{{trim_characters_color($data_leds,'H3','color')}}" data-position="H3">{{trim_characters($data_leds,'H3','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'I3','color')}}" data-color="{{trim_characters_color($data_leds,'I3','color')}}" data-position="I3">{{trim_characters($data_leds,'I3','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'J3','color')}}" data-color="{{trim_characters_color($data_leds,'J3','color')}}" data-position="J3">{{trim_characters($data_leds,'J3','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'K3','color')}}" data-color="{{trim_characters_color($data_leds,'K3','color')}}" data-position="K3">{{trim_characters($data_leds,'K3','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'L3','color')}}" data-color="{{trim_characters_color($data_leds,'L3','color')}}" data-position="L3">{{trim_characters($data_leds,'L3','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'M3','color')}}" data-color="{{trim_characters_color($data_leds,'M3','color')}}" data-position="M3">{{trim_characters($data_leds,'M3','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'N3','color')}}" data-color="{{trim_characters_color($data_leds,'N3','color')}}" data-position="N3">{{trim_characters($data_leds,'N3','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'O3','color')}}" data-color="{{trim_characters_color($data_leds,'O3','color')}}" data-position="O3">{{trim_characters($data_leds,'O3','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'P3','color')}}" data-color="{{trim_characters_color($data_leds,'P3','color')}}" data-position="P3">{{trim_characters($data_leds,'P3','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'Q3','color')}}" data-color="{{trim_characters_color($data_leds,'Q3','color')}}" data-position="Q3">{{trim_characters($data_leds,'Q3','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'R3','color')}}" data-color="{{trim_characters_color($data_leds,'R3','color')}}" data-position="R3">{{trim_characters($data_leds,'R3','pin')}}</td>
						<td class="parent plus">3</td>
					</tr>
					<tr>
						<td class="parent plus">2</td>
						<td class="child {{trim_characters($data_leds,'F2','color')}}" data-color="{{trim_characters_color($data_leds,'F2','color')}}" data-position="F2">{{trim_characters($data_leds,'F2','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'G2','color')}}" data-color="{{trim_characters_color($data_leds,'G2','color')}}" data-position="G2">{{trim_characters($data_leds,'G2','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'H2','color')}}" data-color="{{trim_characters_color($data_leds,'H2','color')}}" data-position="H2">{{trim_characters($data_leds,'H2','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'I2','color')}}" data-color="{{trim_characters_color($data_leds,'I2','color')}}" data-position="I2">{{trim_characters($data_leds,'I2','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'J2','color')}}" data-color="{{trim_characters_color($data_leds,'J2','color')}}" data-position="J2">{{trim_characters($data_leds,'J2','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'K2','color')}}" data-color="{{trim_characters_color($data_leds,'K2','color')}}" data-position="K2">{{trim_characters($data_leds,'K2','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'L2','color')}}" data-color="{{trim_characters_color($data_leds,'L2','color')}}" data-position="L2">{{trim_characters($data_leds,'L2','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'M2','color')}}" data-color="{{trim_characters_color($data_leds,'M2','color')}}" data-position="M2">{{trim_characters($data_leds,'M2','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'N2','color')}}" data-color="{{trim_characters_color($data_leds,'N2','color')}}" data-position="N2">{{trim_characters($data_leds,'N2','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'O2','color')}}" data-color="{{trim_characters_color($data_leds,'O2','color')}}" data-position="O2">{{trim_characters($data_leds,'O2','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'P2','color')}}" data-color="{{trim_characters_color($data_leds,'P2','color')}}" data-position="P2">{{trim_characters($data_leds,'P2','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'Q2','color')}}" data-color="{{trim_characters_color($data_leds,'Q2','color')}}" data-position="Q2">{{trim_characters($data_leds,'Q2','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'R2','color')}}" data-color="{{trim_characters_color($data_leds,'R2','color')}}" data-position="R2">{{trim_characters($data_leds,'R2','pin')}}</td>
						<td class="parent plus">2</td>
					</tr>
					<tr>
						<td class="parent plus">1</td>
						<td class="child {{trim_characters($data_leds,'F1','color')}}" data-color="{{trim_characters_color($data_leds,'F1','color')}}" data-position="F1">{{trim_characters($data_leds,'F1','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'G1','color')}}" data-color="{{trim_characters_color($data_leds,'G1','color')}}" data-position="G1">{{trim_characters($data_leds,'G1','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'H1','color')}}" data-color="{{trim_characters_color($data_leds,'H1','color')}}" data-position="H1">{{trim_characters($data_leds,'H1','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'I1','color')}}" data-color="{{trim_characters_color($data_leds,'I1','color')}}" data-position="I1">{{trim_characters($data_leds,'I1','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'J1','color')}}" data-color="{{trim_characters_color($data_leds,'J1','color')}}" data-position="J1">{{trim_characters($data_leds,'J1','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'K1','color')}}" data-color="{{trim_characters_color($data_leds,'K1','color')}}" data-position="K1">{{trim_characters($data_leds,'K1','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'L1','color')}}" data-color="{{trim_characters_color($data_leds,'L1','color')}}" data-position="L1">{{trim_characters($data_leds,'L1','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'M1','color')}}" data-color="{{trim_characters_color($data_leds,'M1','color')}}" data-position="M1">{{trim_characters($data_leds,'M1','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'N1','color')}}" data-color="{{trim_characters_color($data_leds,'N1','color')}}" data-position="N1">{{trim_characters($data_leds,'N1','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'O1','color')}}" data-color="{{trim_characters_color($data_leds,'O1','color')}}" data-position="O1">{{trim_characters($data_leds,'O1','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'P1','color')}}" data-color="{{trim_characters_color($data_leds,'P1','color')}}" data-position="P1">{{trim_characters($data_leds,'P1','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'Q1','color')}}" data-color="{{trim_characters_color($data_leds,'Q1','color')}}" data-position="Q1">{{trim_characters($data_leds,'Q1','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'R1','color')}}" data-color="{{trim_characters_color($data_leds,'R1','color')}}" data-position="R1">{{trim_characters($data_leds,'R1','pin')}}</td>
						<td class="parent plus">1</td>
					</tr>
					<tr>
						<td class="parent plus">0</td>
						<td class="child {{trim_characters($data_leds,'F0','color')}}" data-color="{{trim_characters_color($data_leds,'F0','color')}}" data-position="F0">{{trim_characters($data_leds,'F0','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'G0','color')}}" data-color="{{trim_characters_color($data_leds,'G0','color')}}" data-position="G0">{{trim_characters($data_leds,'G0','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'H0','color')}}" data-color="{{trim_characters_color($data_leds,'H0','color')}}" data-position="H0">{{trim_characters($data_leds,'H0','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'I0','color')}}" data-color="{{trim_characters_color($data_leds,'I0','color')}}" data-position="I0">{{trim_characters($data_leds,'I0','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'J0','color')}}" data-color="{{trim_characters_color($data_leds,'J0','color')}}" data-position="J0">{{trim_characters($data_leds,'J0','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'K0','color')}}" data-color="{{trim_characters_color($data_leds,'K0','color')}}" data-position="K0">{{trim_characters($data_leds,'K0','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'L0','color')}}" data-color="{{trim_characters_color($data_leds,'L0','color')}}" data-position="L0">{{trim_characters($data_leds,'L0','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'M0','color')}}" data-color="{{trim_characters_color($data_leds,'M0','color')}}" data-position="M0">{{trim_characters($data_leds,'M0','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'N0','color')}}" data-color="{{trim_characters_color($data_leds,'N0','color')}}" data-position="N0">{{trim_characters($data_leds,'N0','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'O0','color')}}" data-color="{{trim_characters_color($data_leds,'O0','color')}}" data-position="O0">{{trim_characters($data_leds,'O0','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'P0','color')}}" data-color="{{trim_characters_color($data_leds,'P0','color')}}" data-position="P0">{{trim_characters($data_leds,'P0','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'Q0','color')}}" data-color="{{trim_characters_color($data_leds,'Q0','color')}}" data-position="Q0">{{trim_characters($data_leds,'Q0','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'R0','color')}}" data-color="{{trim_characters_color($data_leds,'R0','color')}}" data-position="R0">{{trim_characters($data_leds,'R0','pin')}}</td>
						<td class="parent plus">0</td>
					</tr>
					<tr>
						<td class="parent">-1</td>
						<td class="child {{trim_characters($data_leds,'F-1','color')}}" data-color="{{trim_characters_color($data_leds,'F-1','color')}}" data-position="F-1">{{trim_characters($data_leds,'F-1','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'G-1','color')}}" data-color="{{trim_characters_color($data_leds,'G-1','color')}}" data-position="G-1">{{trim_characters($data_leds,'G-1','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'H-1','color')}}" data-color="{{trim_characters_color($data_leds,'H-1','color')}}" data-position="H-1">{{trim_characters($data_leds,'H-1','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'I-1','color')}}" data-color="{{trim_characters_color($data_leds,'I-1','color')}}" data-position="I-1">{{trim_characters($data_leds,'I-1','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'J-1','color')}}" data-color="{{trim_characters_color($data_leds,'J-1','color')}}" data-position="J-1">{{trim_characters($data_leds,'J-1','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'K-1','color')}}" data-color="{{trim_characters_color($data_leds,'K-1','color')}}" data-position="K-1">{{trim_characters($data_leds,'K-1','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'L-1','color')}}" data-color="{{trim_characters_color($data_leds,'L-1','color')}}" data-position="L-1">{{trim_characters($data_leds,'L-1','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'M-1','color')}}" data-color="{{trim_characters_color($data_leds,'M-1','color')}}" data-position="M-1">{{trim_characters($data_leds,'M-1','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'N-1','color')}}" data-color="{{trim_characters_color($data_leds,'N-1','color')}}" data-position="N-1">{{trim_characters($data_leds,'N-1','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'O-1','color')}}" data-color="{{trim_characters_color($data_leds,'O-1','color')}}" data-position="O-1">{{trim_characters($data_leds,'O-1','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'P-1','color')}}" data-color="{{trim_characters_color($data_leds,'P-1','color')}}" data-position="P-1">{{trim_characters($data_leds,'P-1','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'Q-1','color')}}" data-color="{{trim_characters_color($data_leds,'Q-1','color')}}" data-position="Q-1">{{trim_characters($data_leds,'Q-1','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'R-1','color')}}" data-color="{{trim_characters_color($data_leds,'R-1','color')}}" data-position="R-1">{{trim_characters($data_leds,'R-1','pin')}}</td>
						<td class="parent">-1</td>
					</tr>
					<tr>
						<td class="parent">-2</td>
						<td class="child {{trim_characters($data_leds,'F-2','color')}}" data-color="{{trim_characters_color($data_leds,'F-2','color')}}" data-position="F-2">{{trim_characters($data_leds,'F-2','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'G-2','color')}}" data-color="{{trim_characters_color($data_leds,'G-2','color')}}" data-position="G-2">{{trim_characters($data_leds,'G-2','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'H-2','color')}}" data-color="{{trim_characters_color($data_leds,'H-2','color')}}" data-position="H-2">{{trim_characters($data_leds,'H-2','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'I-2','color')}}" data-color="{{trim_characters_color($data_leds,'I-2','color')}}" data-position="I-2">{{trim_characters($data_leds,'I-2','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'J-2','color')}}" data-color="{{trim_characters_color($data_leds,'J-2','color')}}" data-position="J-2">{{trim_characters($data_leds,'J-2','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'K-2','color')}}" data-color="{{trim_characters_color($data_leds,'K-2','color')}}" data-position="K-2">{{trim_characters($data_leds,'K-2','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'L-2','color')}}" data-color="{{trim_characters_color($data_leds,'L-2','color')}}" data-position="L-2">{{trim_characters($data_leds,'L-2','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'M-2','color')}}" data-color="{{trim_characters_color($data_leds,'M-2','color')}}" data-position="M-2">{{trim_characters($data_leds,'M-2','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'N-2','color')}}" data-color="{{trim_characters_color($data_leds,'N-2','color')}}" data-position="N-2">{{trim_characters($data_leds,'N-2','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'O-2','color')}}" data-color="{{trim_characters_color($data_leds,'O-2','color')}}" data-position="O-2">{{trim_characters($data_leds,'O-2','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'P-2','color')}}" data-color="{{trim_characters_color($data_leds,'P-2','color')}}" data-position="P-2">{{trim_characters($data_leds,'P-2','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'Q-2','color')}}" data-color="{{trim_characters_color($data_leds,'Q-2','color')}}" data-position="Q-2">{{trim_characters($data_leds,'Q-2','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'R-2','color')}}" data-color="{{trim_characters_color($data_leds,'R-2','color')}}" data-position="R-2">{{trim_characters($data_leds,'R-2','pin')}}</td>
						<td class="parent">-2</td>
					</tr>
					<tr>
						<td class="parent">-3</td>
						<td class="child {{trim_characters($data_leds,'F-3','color')}}" data-color="{{trim_characters_color($data_leds,'F-3','color')}}" data-position="F-3">{{trim_characters($data_leds,'F-3','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'G-3','color')}}" data-color="{{trim_characters_color($data_leds,'G-3','color')}}" data-position="G-3">{{trim_characters($data_leds,'G-3','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'H-3','color')}}" data-color="{{trim_characters_color($data_leds,'H-3','color')}}" data-position="H-3">{{trim_characters($data_leds,'H-3','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'I-3','color')}}" data-color="{{trim_characters_color($data_leds,'I-3','color')}}" data-position="I-3">{{trim_characters($data_leds,'I-3','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'J-3','color')}}" data-color="{{trim_characters_color($data_leds,'J-3','color')}}" data-position="J-3">{{trim_characters($data_leds,'J-3','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'K-3','color')}}" data-color="{{trim_characters_color($data_leds,'K-3','color')}}" data-position="K-3">{{trim_characters($data_leds,'K-3','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'L-3','color')}}" data-color="{{trim_characters_color($data_leds,'L-3','color')}}" data-position="L-3">{{trim_characters($data_leds,'L-3','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'M-3','color')}}" data-color="{{trim_characters_color($data_leds,'M-3','color')}}" data-position="M-3">{{trim_characters($data_leds,'M-3','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'N-3','color')}}" data-color="{{trim_characters_color($data_leds,'N-3','color')}}" data-position="N-3">{{trim_characters($data_leds,'N-3','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'O-3','color')}}" data-color="{{trim_characters_color($data_leds,'O-3','color')}}" data-position="O-3">{{trim_characters($data_leds,'O-3','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'P-3','color')}}" data-color="{{trim_characters_color($data_leds,'P-3','color')}}" data-position="P-3">{{trim_characters($data_leds,'P-3','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'Q-3','color')}}" data-color="{{trim_characters_color($data_leds,'Q-3','color')}}" data-position="Q-3">{{trim_characters($data_leds,'Q-3','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'R-3','color')}}" data-color="{{trim_characters_color($data_leds,'R-3','color')}}" data-position="R-3">{{trim_characters($data_leds,'R-3','pin')}}</td>
						<td class="parent">-3</td>
					</tr>
					<tr>
						<td class="parent">-4</td>
						<td class="child {{trim_characters($data_leds,'F-4','color')}}" data-color="{{trim_characters_color($data_leds,'F-4','color')}}" data-position="F-4">{{trim_characters($data_leds,'F-4','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'G-4','color')}}" data-color="{{trim_characters_color($data_leds,'G-4','color')}}" data-position="G-4">{{trim_characters($data_leds,'G-4','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'H-4','color')}}" data-color="{{trim_characters_color($data_leds,'H-4','color')}}" data-position="H-4">{{trim_characters($data_leds,'H-4','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'I-4','color')}}" data-color="{{trim_characters_color($data_leds,'I-4','color')}}" data-position="I-4">{{trim_characters($data_leds,'I-4','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'J-4','color')}}" data-color="{{trim_characters_color($data_leds,'J-4','color')}}" data-position="J-4">{{trim_characters($data_leds,'J-4','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'K-4','color')}}" data-color="{{trim_characters_color($data_leds,'K-4','color')}}" data-position="K-4">{{trim_characters($data_leds,'K-4','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'L-4','color')}}" data-color="{{trim_characters_color($data_leds,'L-4','color')}}" data-position="L-4">{{trim_characters($data_leds,'L-4','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'M-4','color')}}" data-color="{{trim_characters_color($data_leds,'M-4','color')}}" data-position="M-4">{{trim_characters($data_leds,'M-4','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'N-4','color')}}" data-color="{{trim_characters_color($data_leds,'N-4','color')}}" data-position="N-4">{{trim_characters($data_leds,'N-4','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'O-4','color')}}" data-color="{{trim_characters_color($data_leds,'O-4','color')}}" data-position="O-4">{{trim_characters($data_leds,'O-4','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'P-4','color')}}" data-color="{{trim_characters_color($data_leds,'P-4','color')}}" data-position="P-4">{{trim_characters($data_leds,'P-4','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'Q-4','color')}}" data-color="{{trim_characters_color($data_leds,'Q-4','color')}}" data-position="Q-4">{{trim_characters($data_leds,'Q-4','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'R-4','color')}}" data-color="{{trim_characters_color($data_leds,'R-4','color')}}" data-position="R-4">{{trim_characters($data_leds,'R-4','pin')}}</td>
						<td class="parent">-4</td>
					</tr>
					<tr>
						<td class="parent">-5</td>
						<td class="child {{trim_characters($data_leds,'F-5','color')}}" data-color="{{trim_characters_color($data_leds,'F-5','color')}}" data-position="F-5">{{trim_characters($data_leds,'F-5','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'G-5','color')}}" data-color="{{trim_characters_color($data_leds,'G-5','color')}}" data-position="G-5">{{trim_characters($data_leds,'G-5','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'H-5','color')}}" data-color="{{trim_characters_color($data_leds,'H-5','color')}}" data-position="H-5">{{trim_characters($data_leds,'H-5','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'I-5','color')}}" data-color="{{trim_characters_color($data_leds,'I-5','color')}}" data-position="I-5">{{trim_characters($data_leds,'I-5','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'J-5','color')}}" data-color="{{trim_characters_color($data_leds,'J-5','color')}}" data-position="J-5">{{trim_characters($data_leds,'J-5','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'K-5','color')}}" data-color="{{trim_characters_color($data_leds,'K-5','color')}}" data-position="K-5">{{trim_characters($data_leds,'K-5','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'L-5','color')}}" data-color="{{trim_characters_color($data_leds,'L-5','color')}}" data-position="L-5">{{trim_characters($data_leds,'L-5','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'M-5','color')}}" data-color="{{trim_characters_color($data_leds,'M-5','color')}}" data-position="M-5">{{trim_characters($data_leds,'M-5','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'N-5','color')}}" data-color="{{trim_characters_color($data_leds,'N-5','color')}}" data-position="N-5">{{trim_characters($data_leds,'N-5','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'O-5','color')}}" data-color="{{trim_characters_color($data_leds,'O-5','color')}}" data-position="O-5">{{trim_characters($data_leds,'O-5','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'P-5','color')}}" data-color="{{trim_characters_color($data_leds,'P-5','color')}}" data-position="P-5">{{trim_characters($data_leds,'P-5','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'Q-5','color')}}" data-color="{{trim_characters_color($data_leds,'Q-5','color')}}" data-position="Q-5">{{trim_characters($data_leds,'Q-5','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'R-5','color')}}" data-color="{{trim_characters_color($data_leds,'R-5','color')}}" data-position="R-5">{{trim_characters($data_leds,'R-5','pin')}}</td>
						<td class="parent">-5</td>
					</tr>
					<tr>
						<td class="parent">-6</td>
						<td class="child {{trim_characters($data_leds,'F-6','color')}}" data-color="{{trim_characters_color($data_leds,'F-6','color')}}" data-position="F-6">{{trim_characters($data_leds,'F-6','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'G-6','color')}}" data-color="{{trim_characters_color($data_leds,'G-6','color')}}" data-position="G-6">{{trim_characters($data_leds,'G-6','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'H-6','color')}}" data-color="{{trim_characters_color($data_leds,'H-6','color')}}" data-position="H-6">{{trim_characters($data_leds,'H-6','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'I-6','color')}}" data-color="{{trim_characters_color($data_leds,'I-6','color')}}" data-position="I-6">{{trim_characters($data_leds,'I-6','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'J-6','color')}}" data-color="{{trim_characters_color($data_leds,'J-6','color')}}" data-position="J-6">{{trim_characters($data_leds,'J-6','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'K-6','color')}}" data-color="{{trim_characters_color($data_leds,'K-6','color')}}" data-position="K-6">{{trim_characters($data_leds,'K-6','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'L-6','color')}}" data-color="{{trim_characters_color($data_leds,'L-6','color')}}" data-position="L-6">{{trim_characters($data_leds,'L-6','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'M-6','color')}}" data-color="{{trim_characters_color($data_leds,'M-6','color')}}" data-position="M-6">{{trim_characters($data_leds,'M-6','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'N-6','color')}}" data-color="{{trim_characters_color($data_leds,'N-6','color')}}" data-position="N-6">{{trim_characters($data_leds,'N-6','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'O-6','color')}}" data-color="{{trim_characters_color($data_leds,'O-6','color')}}" data-position="O-6">{{trim_characters($data_leds,'O-6','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'P-6','color')}}" data-color="{{trim_characters_color($data_leds,'P-6','color')}}" data-position="P-6">{{trim_characters($data_leds,'P-6','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'Q-6','color')}}" data-color="{{trim_characters_color($data_leds,'Q-6','color')}}" data-position="Q-6">{{trim_characters($data_leds,'Q-6','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'R-6','color')}}" data-color="{{trim_characters_color($data_leds,'R-6','color')}}" data-position="R-6">{{trim_characters($data_leds,'R-6','pin')}}</td>
						<td class="parent">-6</td>
					</tr>
					<tr>
						<td class="parent">-7</td>
						<td class="child {{trim_characters($data_leds,'F-7','color')}}" data-color="{{trim_characters_color($data_leds,'F-7','color')}}" data-position="F-7">{{trim_characters($data_leds,'F-7','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'G-7','color')}}" data-color="{{trim_characters_color($data_leds,'G-7','color')}}" data-position="G-7">{{trim_characters($data_leds,'G-7','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'H-7','color')}}" data-color="{{trim_characters_color($data_leds,'H-7','color')}}" data-position="H-7">{{trim_characters($data_leds,'H-7','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'I-7','color')}}" data-color="{{trim_characters_color($data_leds,'I-7','color')}}" data-position="I-7">{{trim_characters($data_leds,'I-7','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'J-7','color')}}" data-color="{{trim_characters_color($data_leds,'J-7','color')}}" data-position="J-7">{{trim_characters($data_leds,'J-7','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'K-7','color')}}" data-color="{{trim_characters_color($data_leds,'K-7','color')}}" data-position="K-7">{{trim_characters($data_leds,'K-7','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'L-7','color')}}" data-color="{{trim_characters_color($data_leds,'L-7','color')}}" data-position="L-7">{{trim_characters($data_leds,'L-7','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'M-7','color')}}" data-color="{{trim_characters_color($data_leds,'M-7','color')}}" data-position="M-7">{{trim_characters($data_leds,'M-7','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'N-7','color')}}" data-color="{{trim_characters_color($data_leds,'N-7','color')}}" data-position="N-7">{{trim_characters($data_leds,'N-7','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'O-7','color')}}" data-color="{{trim_characters_color($data_leds,'O-7','color')}}" data-position="O-7">{{trim_characters($data_leds,'O-7','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'P-7','color')}}" data-color="{{trim_characters_color($data_leds,'P-7','color')}}" data-position="P-7">{{trim_characters($data_leds,'P-7','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'Q-7','color')}}" data-color="{{trim_characters_color($data_leds,'Q-7','color')}}" data-position="Q-7">{{trim_characters($data_leds,'Q-7','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'R-7','color')}}" data-color="{{trim_characters_color($data_leds,'R-7','color')}}" data-position="R-7">{{trim_characters($data_leds,'R-7','pin')}}</td>
						<td class="parent">-7</td>
					</tr>
					<tr>
						<td class="parent">-8</td>
						<td class="child {{trim_characters($data_leds,'F-8','color')}}" data-color="{{trim_characters_color($data_leds,'F-8','color')}}" data-position="F-8">{{trim_characters($data_leds,'F-8','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'G-8','color')}}" data-color="{{trim_characters_color($data_leds,'G-8','color')}}" data-position="G-8">{{trim_characters($data_leds,'G-8','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'H-8','color')}}" data-color="{{trim_characters_color($data_leds,'H-8','color')}}" data-position="H-8">{{trim_characters($data_leds,'H-8','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'I-8','color')}}" data-color="{{trim_characters_color($data_leds,'I-8','color')}}" data-position="I-8">{{trim_characters($data_leds,'I-8','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'J-8','color')}}" data-color="{{trim_characters_color($data_leds,'J-8','color')}}" data-position="J-8">{{trim_characters($data_leds,'J-8','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'K-8','color')}}" data-color="{{trim_characters_color($data_leds,'K-8','color')}}" data-position="K-8">{{trim_characters($data_leds,'K-8','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'L-8','color')}}" data-color="{{trim_characters_color($data_leds,'L-8','color')}}" data-position="L-8">{{trim_characters($data_leds,'L-8','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'M-8','color')}}" data-color="{{trim_characters_color($data_leds,'M-8','color')}}" data-position="M-8">{{trim_characters($data_leds,'M-8','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'N-8','color')}}" data-color="{{trim_characters_color($data_leds,'N-8','color')}}" data-position="N-8">{{trim_characters($data_leds,'N-8','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'O-8','color')}}" data-color="{{trim_characters_color($data_leds,'O-8','color')}}" data-position="O-8">{{trim_characters($data_leds,'O-8','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'P-8','color')}}" data-color="{{trim_characters_color($data_leds,'P-8','color')}}" data-position="P-8">{{trim_characters($data_leds,'P-8','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'Q-8','color')}}" data-color="{{trim_characters_color($data_leds,'Q-8','color')}}" data-position="Q-8">{{trim_characters($data_leds,'Q-8','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'R-8','color')}}" data-color="{{trim_characters_color($data_leds,'R-8','color')}}" data-position="R-8">{{trim_characters($data_leds,'R-8','pin')}}</td>
						<td class="parent">-8</td>
					</tr>
					<tr>
						<td class="parent">-9</td>
						<td class="child {{trim_characters($data_leds,'F-9','color')}}" data-color="{{trim_characters_color($data_leds,'F-9','color')}}" data-position="F-9">{{trim_characters($data_leds,'F-9','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'G-9','color')}}" data-color="{{trim_characters_color($data_leds,'G-9','color')}}" data-position="G-9">{{trim_characters($data_leds,'G-9','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'H-9','color')}}" data-color="{{trim_characters_color($data_leds,'H-9','color')}}" data-position="H-9">{{trim_characters($data_leds,'H-9','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'I-9','color')}}" data-color="{{trim_characters_color($data_leds,'I-9','color')}}" data-position="I-9">{{trim_characters($data_leds,'I-9','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'J-9','color')}}" data-color="{{trim_characters_color($data_leds,'J-9','color')}}" data-position="J-9">{{trim_characters($data_leds,'J-9','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'K-9','color')}}" data-color="{{trim_characters_color($data_leds,'K-9','color')}}" data-position="K-9">{{trim_characters($data_leds,'K-9','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'L-9','color')}}" data-color="{{trim_characters_color($data_leds,'L-9','color')}}" data-position="L-9">{{trim_characters($data_leds,'L-9','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'M-9','color')}}" data-color="{{trim_characters_color($data_leds,'M-9','color')}}" data-position="M-9">{{trim_characters($data_leds,'M-9','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'N-9','color')}}" data-color="{{trim_characters_color($data_leds,'N-9','color')}}" data-position="N-9">{{trim_characters($data_leds,'N-9','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'O-9','color')}}" data-color="{{trim_characters_color($data_leds,'O-9','color')}}" data-position="O-9">{{trim_characters($data_leds,'O-9','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'P-9','color')}}" data-color="{{trim_characters_color($data_leds,'P-9','color')}}" data-position="P-9">{{trim_characters($data_leds,'P-9','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'Q-9','color')}}" data-color="{{trim_characters_color($data_leds,'Q-9','color')}}" data-position="Q-9">{{trim_characters($data_leds,'Q-9','pin')}}</td>
						<td class="child {{trim_characters($data_leds,'R-9','color')}}" data-color="{{trim_characters_color($data_leds,'R-9','color')}}" data-position="R-9">{{trim_characters($data_leds,'R-9','pin')}}</td>
						<td class="parent">-9</td>
					</tr>
					<tr>
						<td class="parent footer"></td><td class="parent footer">F</td><td class="parent footer">G</td><td class="parent footer">H</td><td class="parent footer">I</td><td class="parent footer">J</td>
						<td class="parent footer">K</td><td class="parent footer">L</td><td class="parent footer">M</td><td class="parent footer">N</td><td class="parent footer">O</td>
						<td class="parent footer">P</td><td class="parent footer">Q</td><td class="parent footer">R</td><td class="parent footer"></td>
					</tr>
				</tbody>
		</table>

					<div class="modal-header">
									<input type="submit" class="btn btn-primary car" value="Save changes">
					</div>
					
				<div class="modal-header">
					<button type="button" data-id="Bluetooth connect" class="btn btn-danger invalid">&nbsp;Test&nbsp;</button><span class="span invalid" data-id="Bluetooth connect">Bluetooth connect</span>
					<button type="button" data-id="Lights (beam + rear)" class="btn btn-danger invalid">&nbsp;Test&nbsp;</button><span class="span invalid" data-id="Lights (beam + rear)">Lights (beam + rear)</span>
					<button type="button" data-id="Daylight left" class="btn btn-danger invalid">&nbsp;Test&nbsp;</button><span class="span invalid" data-id="Daylight left">Daylight left</span>
					<button type="button" data-id="Daylight right" class="btn btn-danger invalid">&nbsp;Test&nbsp;</button><span class="span invalid" data-id="Daylight right">Daylight right</span>
					<button type="button" data-id="Low beam" class="btn btn-danger invalid">&nbsp;Test&nbsp;</button><span class="span invalid" data-id="Low beam">Low beam</span>
					<button type="button" data-id="High beam" class="btn btn-danger invalid">&nbsp;Test&nbsp;</button><span class="span invalid" data-id="High beam">High beam</span>
					<button type="button" data-id="Blinkers left" class="btn btn-danger invalid">&nbsp;Test&nbsp;</button><span class="span invalid" data-id="Blinkers left">Blinkers left</span>
					<button type="button" data-id="Blinkers right" class="btn btn-danger invalid">&nbsp;Test&nbsp;</button><span class="span invalid" data-id="Blinkers right">Blinkers right</span>
					<button type="button" data-id="Rear Light" class="btn btn-danger invalid">&nbsp;Test&nbsp;</button><span class="span invalid" data-id="Rear Light">Rear Light</span>
					<button type="button" data-id="Brake lights" class="btn btn-danger invalid">&nbsp;Test&nbsp;</button><span class="span invalid" data-id="Brake lights">Brake lights</span>
					<button type="button" data-id="X-Light" class="btn btn-danger invalid">&nbsp;Test&nbsp;</button><span class="span invalid" data-id="X-Light">X-Light</span>
					<button type="button" data-id="Hazard light" class="btn btn-danger invalid">&nbsp;Test&nbsp;</button><span class="span invalid" data-id="Hazard light">Hazard light</span>
					<button type="button" data-id="Demo" class="btn btn-danger invalid">&nbsp;Test&nbsp;</button><span class="span invalid" data-id="Demo">Demo</span>
					<button type="button" data-id="Bluetooth advertising" class="btn btn-danger invalid">&nbsp;Test&nbsp;</button><span class="span invalid" data-id="Bluetooth advertising">Bluetooth advertising</span>
					<button type="button" data-id="Battery charging indication" class="btn btn-danger invalid">&nbsp;Test&nbsp;</button><span class="span invalid" data-id="Battery charging indication">Battery charging indication</span>
					<button type="button" data-id="Power ON indication" class="btn btn-danger invalid">&nbsp;Test&nbsp;</button><span class="span invalid" data-id="Power ON indication">Power ON indication</span>
					<button type="button" data-id="Power OFF indication" class="btn btn-danger invalid">&nbsp;Test&nbsp;</button><span class="span invalid" data-id="Power OFF indication">Power OFF indication</span>
					<button type="button" data-id="Bluetooth disconnect" class="btn btn-danger invalid">&nbsp;Test&nbsp;</button><span class="span invalid" data-id="Bluetooth disconnect">Bluetooth disconnect</span>
				</div>
				
		</div>
		<br>
		<div class="container_check"><p class="pp_class"><input type="checkbox" id="blinkers_override" name="blinkers_override" value="1" <?php echo (!empty($blinkers_override['blinkers_override_l']) || !empty($blinkers_override['blinkers_override_r'])) ? 'checked':''; ?>> Disable the following pins when blinkers are used: left <input type="text" id="blinkers_override_l" name="blinkers_override_l" value="{{ implode(',',$blinkers_override['blinkers_override_l']) }}"> right <input type="text" id="blinkers_override_r" name="blinkers_override_r" value="{{ implode(',',$blinkers_override['blinkers_override_r']) }}"> (if multiple values, use comma to separate)</p></div>
		<br><br>
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
		
	<script src="{{ url('/public/newbootstrap/vendor/jquery/jquery.min.js') }}"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="{{ url('/public/excel/jexcel.js') }}"></script>
	<script src="{{ url('/public/excel/jsuites.js') }}"></script>
	<script>
			$(document).ready(function(){
				
				$(function (){ // global rightclick handler - trigger custom event "rightclick"
					var mouseDownElements = [];
					$(document).on('mousedown', '*', function(event)
					{
						if (event.which == 3)
						{
							mouseDownElements.push(this);
						}
					});
					$(document).on('mouseup', '*', function(event)
					{
						if (event.which == 3 && mouseDownElements.indexOf(this) >= 0)
						{
							$(this).trigger('rightclick');
						}
					});
					$(document).on('mouseup', function()
					{
						 mouseDownElements.length = 0;
					});
					// disable contextmenu
					$(document).on('contextmenu', function(event)
					{
						 event.preventDefault();
					});
				});


				var cell_index = null;
				$('.child').on('rightclick', function(event){
					// alert(event.button);
					cell_index = $(this);
					if(cell_index.attr("data-color") !== 'white'){
						// if(event.button == 2){
							if(confirm('Are you sure to delete this cell')){
								cell_index = $(this);
								cell_index.removeClass(cell_index.attr('data-color'));
								cell_index.attr("data-color",'white');
								cell_index.html('');
							}
						// }
					}
				});
				
				// window.oncontextmenu = function ()
				// {
				// showCustomMenu();
				// return false;     // cancel default menu
			// }
				// <button type="button" class="" data-dismiss="modal">Clear</button>
				
				
				
				
				$('.child').on("click", function(event){
						cell_index = $(this);
						$('select[class="color-select"]').prop('selectedIndex',0);
						$('select[class="value-select"]').prop('selectedIndex',0);
						$("#myModal").modal();
				});
				
				// $('button[class="btn btn-default clear"]').on("click", function(event){
						// alert('aaaaaaaa');
						// cell_index = $(this);
						// cell_index.html('');
				// });
				
				$('select[class="color-select"]').on("change", function(color){
						// cell_index.css("background-color",$(this).children("option:selected").val());
						cell_index.attr("class",'child '+$(this).children("option:selected").val());
						cell_index.attr("data-color",$(this).children("option:selected").val());
						// data-color="white"
				});
				$('select[class="value-select"]').on("change", function(value){
						cell_index.html($(this).children("option:selected").val());
				});

				function download(file, text) {
                    var element = document.createElement('a');
                    element.setAttribute('href', 'data:text/plain;charset=utf-8, '
                                         + encodeURIComponent(text));
                    element.setAttribute('download', file);
                    document.body.appendChild(element);
                    element.click();
                    document.body.removeChild(element);
                }
				
				$('input[class="btn btn-primary car"]').on("click", function(event){
						 var row_1 = [];
						 var row_2 = [];
						 var row_3 = [];
						 var row_4 = [];
						 var row_5 = [];
						 var row_6 = [];
						 var row_7 = [];
						 var row_8 = [];
						 var row_9 = [];
						 var row_10 = [];
						 var row_11 = [];
						 var row_12 = [];
						 var row_13 = [];
						 $('#myTable tr').each(function(row, tr){
							 if(row <= 18 ) {
								if(($(tr).find('td:eq(1)').text() != '' || $(tr).find('td:eq(1)').attr('data-color') != 'white'))
										row_1[row] = {pin: ($(tr).find('td:eq(1)').text()) ? ($(tr).find('td:eq(1)').text()) : '0',color:$(tr).find('td:eq(1)').attr('data-color'),position:$(tr).find('td:eq(1)').attr('data-position')};
								if(($(tr).find('td:eq(2)').text() != '' || $(tr).find('td:eq(2)').attr('data-color') != 'white'))
										row_2[row] = {pin: ($(tr).find('td:eq(2)').text()) ? ($(tr).find('td:eq(2)').text()) : '0',color:$(tr).find('td:eq(2)').attr('data-color'),position:$(tr).find('td:eq(2)').attr('data-position')};
								if(($(tr).find('td:eq(3)').text() != '' || $(tr).find('td:eq(3)').attr('data-color') != 'white'))
										row_3[row] = {pin: ($(tr).find('td:eq(3)').text()) ? ($(tr).find('td:eq(3)').text()) : '0',color:$(tr).find('td:eq(3)').attr('data-color'),position:$(tr).find('td:eq(3)').attr('data-position')};
								if(($(tr).find('td:eq(4)').text() != '' || $(tr).find('td:eq(4)').attr('data-color') != 'white'))
										row_4[row] = {pin: ($(tr).find('td:eq(4)').text()) ? ($(tr).find('td:eq(4)').text()) : '0',color:$(tr).find('td:eq(4)').attr('data-color'),position:$(tr).find('td:eq(4)').attr('data-position')};
								if(($(tr).find('td:eq(5)').text() != '' || $(tr).find('td:eq(5)').attr('data-color') != 'white'))
										row_5[row] = {pin: ($(tr).find('td:eq(5)').text()) ? ($(tr).find('td:eq(5)').text()) : '0',color:$(tr).find('td:eq(5)').attr('data-color'),position:$(tr).find('td:eq(5)').attr('data-position')};
								if(($(tr).find('td:eq(6)').text() != '' || $(tr).find('td:eq(6)').attr('data-color') != 'white'))
										row_6[row] = {pin: ($(tr).find('td:eq(6)').text()) ? ($(tr).find('td:eq(6)').text()) : '0',color:$(tr).find('td:eq(6)').attr('data-color'),position:$(tr).find('td:eq(6)').attr('data-position')};
								if(($(tr).find('td:eq(7)').text() != '' || $(tr).find('td:eq(7)').attr('data-color') != 'white'))
										row_7[row] = {pin: ($(tr).find('td:eq(7)').text()) ? ($(tr).find('td:eq(7)').text()) : '0',color:$(tr).find('td:eq(7)').attr('data-color'),position:$(tr).find('td:eq(7)').attr('data-position')};
								if(($(tr).find('td:eq(8)').text() != '' || $(tr).find('td:eq(8)').attr('data-color') != 'white'))
										row_8[row] = {pin: ($(tr).find('td:eq(8)').text()) ? ($(tr).find('td:eq(8)').text()) : '0',color:$(tr).find('td:eq(8)').attr('data-color'),position:$(tr).find('td:eq(8)').attr('data-position')};
								if(($(tr).find('td:eq(9)').text() != '' || $(tr).find('td:eq(9)').attr('data-color') != 'white'))
										row_9[row] = {pin: ($(tr).find('td:eq(9)').text()) ? ($(tr).find('td:eq(9)').text()) : '0',color:$(tr).find('td:eq(9)').attr('data-color'),position:$(tr).find('td:eq(9)').attr('data-position')};
								if(($(tr).find('td:eq(10)').text() != '' || $(tr).find('td:eq(10)').attr('data-color') != 'white'))
										row_10[row] = {pin: ($(tr).find('td:eq(10)').text()) ? ($(tr).find('td:eq(10)').text()) : '0',color:$(tr).find('td:eq(10)').attr('data-color'),position:$(tr).find('td:eq(10)').attr('data-position')};
								if(($(tr).find('td:eq(11)').text() != '' || $(tr).find('td:eq(11)').attr('data-color') != 'white'))
										row_11[row] = {pin: ($(tr).find('td:eq(11)').text()) ? ($(tr).find('td:eq(11)').text()) : '0',color:$(tr).find('td:eq(11)').attr('data-color'),position:$(tr).find('td:eq(11)').attr('data-position')};
								if(($(tr).find('td:eq(12)').text() != '' || $(tr).find('td:eq(12)').attr('data-color') != 'white'))
										row_12[row] = {pin: ($(tr).find('td:eq(12)').text()) ? ($(tr).find('td:eq(12)').text()) : '0',color:$(tr).find('td:eq(12)').attr('data-color'),position:$(tr).find('td:eq(12)').attr('data-position')};
								if(($(tr).find('td:eq(13)').text() != '' || $(tr).find('td:eq(13)').attr('data-color') != 'white'))
										row_13[row] = {pin: ($(tr).find('td:eq(13)').text()) ? ($(tr).find('td:eq(13)').text()) : '0',color:$(tr).find('td:eq(13)').attr('data-color'),position:$(tr).find('td:eq(13)').attr('data-position')};
								}
						});

						function my_filter_array(myState_array) {
							myState_array.filter(function (el) {
									return el != null;
							});
						}
						function my_fiter_array(objects) {
							return objects.filter(function (el) {
							  return el != null;
							});
						}
						var myState_array = [];
							if(row_1.length >= 1 && row_1 != null)
								myState_array = myState_array.concat(my_fiter_array(row_1));
							if(row_2.length >= 1 && row_2 != null)
								myState_array = myState_array.concat(my_fiter_array(row_2));
							if(row_3.length >= 1 && row_3 != null)
								myState_array = myState_array.concat(my_fiter_array(row_3));
							if(row_4.length >= 1 && row_4 != null)
								myState_array = myState_array.concat(my_fiter_array(row_4));
							if(row_5.length >= 1 && row_5 != null)
								myState_array = myState_array.concat(my_fiter_array(row_5));
							if(row_6.length >= 1 && row_6 != null)
								myState_array = myState_array.concat(my_fiter_array(row_6));
							if(row_7.length >= 1 && row_7 != null)
								myState_array = myState_array.concat(my_fiter_array(row_7));
							if(row_8.length >= 1 && row_8 != null)
								myState_array = myState_array.concat(my_fiter_array(row_8));
							if(row_9.length >= 1 && row_9 != null)
								myState_array = myState_array.concat(my_fiter_array(row_9));
							if(row_10.length >= 1 && row_10 != null)
								myState_array = myState_array.concat(my_fiter_array(row_10));
							if(row_11.length >= 1 && row_11 != null)
								myState_array = myState_array.concat(my_fiter_array(row_11));
							if(row_12.length >= 1 && row_12 != null)
								myState_array = myState_array.concat(my_fiter_array(row_12));
							if(row_13.length >= 1 && row_13 != null)
								myState_array = myState_array.concat(my_fiter_array(row_13));

							myJSON = JSON.stringify({leds:myState_array});
							// localStorage.setItem("myitem", JSON.stringify({leds:myState_array}));
						// download("data.json", myJSON);
						$.ajax({
							url: "create-new-car",
							type: 'POST',
							dataType: "JSON",
							data: {
									"_token": "{{ csrf_token() }}",
									"vehicle_id": "{{ $vehicle_id }}",
									"type": "data_leds",
									"data_leds": myJSON,
							},
							success: function (response)
							{
								if(response.status == true){
									window.location.href = "redirect/create-new-car?message="+response.message+"&vehicle_id="+response.vehicle_id;
								}
							}
						});
				});
			});
	</script>
	
	<script>
	var resultDatas = "{{ json_encode($data_leds) }}";
	
	var excel_leds_data = "{{ $excel_leds }}";
	var result_excel_leds_data = JSON.parse(excel_leds_data.replace(/&quot;/g,'"'));
	// var resultDatas = '{{ $page_info["inputData"] }}';
	
	var resultData = JSON.parse(resultDatas.replace(/&quot;/g,'"'));
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
	
	// console.log(result_inputData_val);
	function inputDataReturn_key(position_val) {
				var found_val = "";
				for(var i = 0; i < result_inputData_val.length; i++) {
					if (result_inputData_val[i].pin == position_val) {
						found_val = result_inputData_val[i].position;
						break;
					}
				}
			// console.log(found_val);	
			return found_val;
	}
	
	function inputDataReturn_key_all(position_val) {
				var result_excel_leds_datas = result_excel_leds_data.sequences;
				var my_i_pos = 0;
				var found_val = [];
				for(var i = 0; i < result_excel_leds_datas.length; i++) {
					if (result_excel_leds_datas[i].bit == position_val) {
						found_val[my_i_pos] = result_excel_leds_datas[i].position;
						my_i_pos++;
					}
				}
			// console.log(found_val);	
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
	var pinDatas = resultData.map(function(data) {
			return data.pin;
	});
	var pinData = pinDatas.sort((a,b)=>a-b);
	
	// console.log(pinData);
	// console.log(resultData);
	
	function getKeyByValue(object, value) {
	  return Object.keys(object).find(key => object[key] === value);
	}
	
	// var bit_position = { "X-Light": 12, "DayLight": 6, "Low beam": 7, "High beam": 8, "Blinkers left": 9, "Blinkers right": 10, "Rear Light": 11};
	// var bit_position = { "X-Light": 10, "DayLight": 2, "Low beam": 4, "High beam": 5, "Blinkers left": 6, "Blinkers right": 7, "Rear Light": 8};
	
	var bit_position = { "Bluetooth connect": 0, "Lights (beam + rear)": 1, "Daylight left": 2,"Daylight right": 3, "High beam": 5, "Blinkers left": 6, "Blinkers right": 7, "Rear Light": 8, "Brake lights": 9, "X-Light": 10, "Hazard light": 12, "Demo": 34,"Bluetooth advertising":35, "Battery charging indication": 36, "Power ON indication": 37, "Power OFF indication": 38, "Bluetooth disconnect": 39};
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
			var sum_var = Number(time_0) + Number(time_1) + Number(time_2) + Number(time_3) + Number(time_4);
			
			// console.log(getKeyByValue(bit_position,key.bit));
			// console.log(getKeyByValue(bit_position,key.bit));
			$('button[data-id="'+getKeyByValue(bit_position,key.bit)+'"]').removeClass("invalid");
			$('span[data-id="'+getKeyByValue(bit_position,key.bit)+'"]').removeClass("invalid");
			
			return [getKeyByValue(bit_position,key.bit), key.pin, time_0, start_0, stop_0,time_1,start_1,stop_1,time_2,start_2,stop_2,time_3,start_3,stop_3,time_4,start_4,stop_4,sum_var];
		});
		var data1 = excel_final_array;
	}else{
		var data1 = [['', '', '', '','','','','','','','','','','','','','','']];
	}
	// console.log(result_excel_leds_data);
	
	// var data1 = [excel_data];
	
	var imp = 0;
	function insertColumns(){
		// $('#spreadsheet').jexcel('insertColumn', 3, null, 2);
		// event.preventDefault(); return false;
		// console.log(imp);
		return imp;
		imp++;
	}
	
	
	
	var table = jexcel(document.getElementById('spreadsheet'), {
		data:data1,
		colHeaders: [ 'Sequence','Pin number', 'T', 'Start', 'Stop' , 'T', 'Start', 'Stop', 'T', 'Start', 'Stop', 'T', 'Start', 'Stop', 'T', 'Start', 'Stop', 'ms' ],
		nestedHeaders:[
			[
				{ title:''},
				{ title:''},
				{ title:'Time', colspan:'16' },
			],
			[
				{ title:''},
				{ title:''},
				{ title:' 1',colspan:'3'},
				{ title:' 2',colspan:'3'},
				{ title:' 3',colspan:'3'},
				{ title:' 4',colspan:'3'},
				{ title:' 5',colspan:'3'},
				{ title:' Sum'},
			],
		],
		columns: [
			{ type: 'autocomplete', width: 200, source:['Bluetooth connect','Lights (beam + rear)','Daylight left','Daylight right','Low beam','High beam','Blinkers left','Blinkers right', 'Rear Light', 'Brake lights','X-Light','Hazard light','Demo','Bluetooth advertising','Battery charging indication','Power ON indication','Power OFF indication','Bluetooth disconnect'] },
			{ type: 'autocomplete', width: 120, source:pinData },
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
				var index_bit_data = bit_position[bits[index]];
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
			
			var final_data = position.map(function(currentValue, index, arr){
				
				var index_bit_data = bit_position[bits[index]];
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
				
				
				return 	{
							'bit':index_bit_data,
							'pin':Number(currentValue),
							'data': final_array_Pos
						};
			});
			
			// console.log(final_data);
				
			var final_array = [];
			for (var i = 0; i < final_data.length; i++) {
					if(final_data[i].bit || final_data[i].bit == 0)
					{
						 // && final_data[i].pin
							final_array[i] = final_data[i];
					}
			}
			
			var final_data_position_array = [];
			for (var i = 0; i < final_data_position.length; i++) {
					if(final_data_position[i].bit || final_data_position[i].bit == 0)
					{
						 // && final_data_position[i].pin
							final_data_position_array[i] = final_data_position[i];
					}
			}
			
			var myJSON_option = "{{ $setting_option }}";
			var myJSON_option_option = JSON.parse(myJSON_option.replace(/&quot;/g,'"'));
			
			// var result = a.map(function (x) { 
			  // return parseInt(x, 10); 
			// });
			
			if($('input[name="blinkers_override"]:checked').val()){
				myJSON_option_option.blinkers_override_l = $('input[name="blinkers_override_l"]').val().split(',').map(function (x) { return parseInt(x, 10); });
				myJSON_option_option.blinkers_override_r = $('input[name="blinkers_override_r"]').val().split(',').map(function (y) { return parseInt(y, 10); });
			}else{
				myJSON_option_option.blinkers_override_l = [];
				myJSON_option_option.blinkers_override_r = [];
			}
			
			// console.log(myJSON_option_option.blinkers_override_l);
			var myJSON = JSON.stringify({sequences:final_array,options:myJSON_option_option});
			var myJSON_db = JSON.stringify({sequences:final_data_position_array,options:myJSON_option_option});
			
			download("data.json", myJSON);
			$.ajax({
							url: "create-new-car",
							type: 'POST',
							dataType: "JSON",
							data: {
									"_token": "{{ csrf_token() }}",
									"vehicle_id": "{{ $vehicle_id }}",
									"type": "excel_leds",
									"excel_leds": myJSON_db,
							},
							success: function (response)
							{
								if(response.status == true){
									window.location.href = "";
								}
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
			
		// <button type="button" data-id="X-Light" class="btn btn-danger">
		// function transition(ii) {
			// console.log(ii);
		// }
		
		$('button[class="btn btn-danger"]').click(function(){
			var val_ues = bit_position[$(this).data('id')];
				var my_val_data_val_ues = inputDataReturn_key_all(val_ues);
				// console.log(my_val_data_val_ues);
				// $('td[data-position="F6"]').css("transition", "all .6s ease-out");
				// $('td[data-position="F8"]').addClass("green");
	
				
				var i_v = Math.round(255 * 0.392156862745098);	
				var time_end = (i_v * 10);
				for(var i = 0; i < my_val_data_val_ues.length; i++) {
					// console.log(inputDataReturn_key(my_val_data_val_ues[i]));
					// $('td[data-position="'+inputDataReturn_key(my_val_data_val_ues[i])+'"]').text('');
					$('td[data-position="'+inputDataReturn_key(my_val_data_val_ues[i])+'"]').addClass("blink-bg");
					// append('<div class="my_progress_bar">'+my_val_data_val_ues[i]+'</div>');
					// $('td[data-position="'+inputDataReturn_key(my_val_data_val_ues[i])+'"]').css("transition", "all .6s ease-out");&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					// $('td[data-position="'+inputDataReturn_key(my_val_data_val_ues[i])+'"]').addClass("green");
					
					// ,my_val_data_val_ues[i]
					apperance(inputDataReturn_key(my_val_data_val_ues[i]),time_end);
				}
			
				
				// console.log(time_end);
				function apperance(i,time_end) {
					setTimeout(function() {
						// .children('div').remove();
						$('td[data-position="'+i+'"]').removeClass('blink-bg');
						// $('td[data-position="'+i+'"]').text(val);
					}, time_end);
				}
				// var i = 0;
				
				// function move() {
				  // if (i == 0) {
					// i = 1;
					// var elem = $('.myTable td div[class="my_progress_bar"]');
					// var width = 1;
					// var id = setInterval(frame, 10);
					// function frame() {
					  // if (width >= i_v) {
						// clearInterval(id);
						// i = 0;
					  // } else {
						// width++;
						// elem.css({"width":width + "%","height":"100%"});
					  // }
					// }
				  // }
				// }
				// move();
				
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
