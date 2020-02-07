
<html>
	<head>
			<style>
				.myTable
					{
						width: 100%;
						background-color: #DFDBDB;
						padding: 5%;
						border: none;
						height: 100%;
					}
				td {
						width: 50px;
						text-align: center;
					}
				.container {
						padding-top: 40px;
					}
				td.parent {
					background-color: #242533;
					color: white;
					border: none;
				}
				td.parent.plus {
					padding-left: 7px;
				}
				body {
					background-color: #242533 !important;
				}
				td.parent.footer {
					height: 50px;
				}
				.myTable tr td.child
					{
						border: none;
					}
				select {
					width: 50%;
					border-radius: 0.25rem;
				}
			</style>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	</head>
<body>
		<div class="container">



		<!-- button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Small Modal</button -->


		<!-- Modal -->
		  <div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog modal-sm">
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Modal Header</h4>
				</div>
				<div class="modal-body">
				  <p>
					  <select class="color-select">
						<option value="1">Select color</option>
						<option style="background-color: yellow;" value="yellow">Yellow</option>
						<option style="background-color: blue;" value="blue">Blue</option>
						<option style="background-color: red;" value="red">Red</option>
						<option style="background-color: orange;" value="orange">Orange</option>
					  </select>
				  </p>
				  <p>
					  <select class="value-select">
						<option value="0">Select Value</option>
						<?php for($val =0; $val<=23; $val++) { ?>
							<option value="<?php echo $val; ?>"><?php echo $val; ?></option>
						<?php } ?>
					  </select>
				  </p>

				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			  </div>
			</div>
		  </div>

		<table class="myTable" id="myTable" border="1px">
				<tbody>
					<tr>
						<td class="parent plus">9</td>
						<td class="child" data-color="white" data-position="F9" style="background-color: white;"></td><td class="child" data-color="white" data-position="G9"></td><td class="child" data-color="white" data-position="H9" style="background-color: white;"></td><td class="child" data-color="white" data-position="I9"></td><td class="child" data-color="white" data-position="J9"></td>
						<td class="child" data-color="white" data-position="K9"></td><td class="child" data-color="white" data-position="L9"></td><td class="child" data-color="white" data-position="M9"></td><td class="child" data-color="white" data-position="N9"></td><td class="child" data-color="white" data-position="O9"></td>
						<td class="child" data-color="white" data-position="P9"></td><td class="child" data-color="white" data-position="Q9"></td><td class="child" data-color="white" data-position="R9" style="background-color: white;"></td>
						<td class="parent plus">9</td>
					</tr>
					<tr>
						<td class="parent plus">8</td>
						<td class="child" data-color="white" data-position="F8"></td><td class="child" data-color="white" data-position="G8"></td><td class="child" data-color="white" data-position="H8"></td><td class="child" data-color="white" data-position="I8"></td><td class="child" data-color="white" data-position="J8"></td>
						<td class="child" data-color="white" data-position="K8"></td><td class="child" data-color="white" data-position="L8"></td><td class="child" data-color="white" data-position="M8"></td><td class="child" data-color="white" data-position="N8"></td><td class="child" data-color="white" data-position="O8"></td>
						<td class="child" data-color="white" data-position="P8"></td><td class="child" data-color="white" data-position="Q8"></td><td class="child" data-color="white" data-position="R8"></td>
						<td class="parent plus">8</td>
					</tr>
					<tr>
						<td class="parent plus">7</td>
						<td class="child" data-color="white" data-position="F7" style="background-color: white;"></td><td class="child" data-color="white" data-position="G7"></td><td class="child" data-color="white" data-position="H7"></td><td class="child" data-color="white" data-position="I7"></td><td class="child" data-color="white" data-position="J7"></td>
						<td class="child" data-color="white" data-position="K7" style="background-color: white;"></td><td class="child" data-color="white" data-position="L7"></td><td class="child" data-color="white" data-position="M7" style="background-color: white;"></td><td class="child" data-color="white" data-position="N7"></td><td class="child" data-color="white" data-position="O7"></td>
						<td class="child" data-color="white" data-position="P7"></td><td class="child" data-color="white" data-position="Q7"></td><td class="child" data-color="white" data-position="R7" style="background-color: white;"></td>
						<td class="parent plus">7</td>
					</tr>
					<tr>
						<td class="parent plus">6</td>
						<td class="child" data-color="white" data-position="F6"></td><td class="child" data-color="white" data-position="G6"></td><td class="child" data-color="white" data-position="H6"></td><td class="child" data-color="white" data-position="I6"></td><td class="child" data-color="white" data-position="J6"></td>
						<td class="child" data-color="white" data-position="K6"></td><td class="child" data-color="white" data-position="L6"></td><td class="child" data-color="white" data-position="M6"></td><td class="child" data-color="white" data-position="N6"></td><td class="child" data-color="white" data-position="O6"></td>
						<td class="child" data-color="white" data-position="P6"></td><td class="child" data-color="white" data-position="Q6"></td><td class="child" data-color="white" data-position="R6"></td>
						<td class="parent plus">6</td>
					</tr>
					<tr>
						<td class="parent plus">5</td>
						<td class="child" data-color="white" data-position="F5" style="background-color: white;"></td><td class="child" data-color="white" data-position="G5"></td><td class="child" data-color="white" data-position="H5"></td><td class="child" data-color="white" data-position="I5"></td><td class="child" data-color="white" data-position="J5"></td>
						<td class="child" data-color="white" data-position="K5"></td><td class="child" data-color="white" data-position="L5"></td><td class="child" data-color="white" data-position="M5"></td><td class="child" data-color="white" data-position="N5"></td><td class="child" data-color="white" data-position="O5"></td>
						<td class="child" data-color="white" data-position="P5"></td><td class="child" data-color="white" data-position="Q5"></td><td class="child" data-color="white" data-position="R5" style="background-color: white;"></td>
						<td class="parent plus">5</td>
					</tr>
					<tr>
						<td class="parent plus">4</td>
						<td class="child" data-color="white" data-position="F4"></td><td class="child" data-color="white" data-position="G4"></td><td class="child" data-color="white" data-position="H4"></td><td class="child" data-color="white" data-position="I4"></td><td class="child" data-color="white" data-position="J4"></td>
						<td class="child" data-color="white" data-position="K4"></td><td class="child" data-color="white" data-position="L4"></td><td class="child" data-color="white" data-position="M4"></td><td class="child" data-color="white" data-position="N4"></td><td class="child" data-color="white" data-position="O4"></td>
						<td class="child" data-color="white" data-position="P4"></td><td class="child" data-color="white" data-position="Q4"></td><td class="child" data-color="white" data-position="R4"></td>
						<td class="parent plus">4</td>
					</tr>
					<tr>
						<td class="parent plus">3</td>
						<td class="child" data-color="white" data-position="F3"></td><td class="child" data-color="white" data-position="G3"></td><td class="child" data-color="white" data-position="H3"></td><td class="child" data-color="white" data-position="I3"></td><td class="child" data-color="white" data-position="J3"></td>
						<td class="child" data-color="white" data-position="K3"></td><td class="child" data-color="white" data-position="L3"></td><td class="child" data-color="white" data-position="M3"></td><td class="child" data-color="white" data-position="N3"></td><td class="child" data-color="white" data-position="O3"></td>
						<td class="child" data-color="white" data-position="P3"></td><td class="child" data-color="white" data-position="Q3"></td><td class="child" data-color="white" data-position="R3"></td>
						<td class="parent plus">3</td>
					</tr>
					<tr>
						<td class="parent plus">2</td>
						<td class="child" data-color="white" data-position="F2" style="background-color: white;"></td><td class="child" data-color="white" data-position="G2"></td><td class="child" data-color="white" data-position="H2"></td><td class="child" data-color="white" data-position="I2"></td><td class="child" data-color="white" data-position="J2"></td>
						<td class="child" data-color="white" data-position="K2"></td><td class="child" data-color="white" data-position="L2"></td><td class="child" data-color="white" data-position="M2"></td><td class="child" data-color="white" data-position="N2"></td><td class="child" data-color="white" data-position="O2"></td>
						<td class="child" data-color="white" data-position="P2"></td><td class="child" data-color="white" data-position="Q2"></td><td class="child" data-color="white" data-position="R2" style="background-color: white;"></td>
						<td class="parent plus">2</td>
					</tr>
					<tr>
						<td class="parent plus">1</td>
						<td class="child" data-color="white" data-position="F1"></td><td class="child" data-color="white" data-position="G1"></td><td class="child" data-color="white" data-position="H1"></td><td class="child" data-color="white" data-position="I1"></td><td class="child" data-color="white" data-position="J1"></td>
						<td class="child" data-color="white" data-position="K1"></td><td class="child" data-color="white" data-position="L1"></td><td class="child" data-color="white" data-position="M1"></td><td class="child" data-color="white" data-position="N1"></td><td class="child" data-color="white" data-position="O1"></td>
						<td class="child" data-color="white" data-position="P1"></td><td class="child" data-color="white" data-position="Q1"></td><td class="child" data-color="white" data-position="R1"></td>
						<td class="parent plus">1</td>
					</tr>
					<tr>
						<td class="parent plus">0</td>
						<td class="child" data-color="white" data-position="F0"></td><td class="child" data-color="white" data-position="G0"></td><td class="child" data-color="white" data-position="H0"></td><td class="child" data-color="white" data-position="I0"></td><td class="child" data-color="white" data-position="J0"></td>
						<td class="child" data-color="white" data-position="K0"></td><td class="child" data-color="white" data-position="L0"></td><td class="child" data-color="white" data-position="M0"></td><td class="child" data-color="white" data-position="N0"></td><td class="child" data-color="white" data-position="O0"></td>
						<td class="child" data-color="white" data-position="P0"></td><td class="child" data-color="white" data-position="Q0"></td><td class="child" data-color="white" data-position="R0"></td>
						<td class="parent plus">0</td>
					</tr>
					<tr>
						<td class="parent">-1</td>
						<td class="child" data-color="white" data-position="F-1"></td><td class="child" data-color="white" data-position="G-1"></td><td class="child" data-color="white" data-position="H-1"></td><td class="child" data-color="white" data-position="I-1"></td><td class="child" data-color="white" data-position="J-1"></td>
						<td class="child" data-color="white" data-position="K-1"></td><td class="child" data-color="white" data-position="L-1"></td><td class="child" data-color="white" data-position="M-1"></td><td class="child" data-color="white" data-position="N-1"></td><td class="child" data-color="white" data-position="O-1"></td>
						<td class="child" data-color="white" data-position="P-1"></td><td class="child" data-color="white" data-position="Q-1"></td><td class="child" data-color="white" data-position="R-1"></td>
						<td class="parent">-1</td>
					</tr>
					<tr>
						<td class="parent">-2</td>
						<td class="child" data-color="white" data-position="F-2" style="background-color: white;"></td><td class="child" data-color="white" data-position="G-2"></td><td class="child" data-color="white" data-position="H-2"></td><td class="child" data-color="white" data-position="I-2"></td><td class="child" data-color="white" data-position="J-2"></td>
						<td class="child" data-color="white" data-position="K-2"></td><td class="child" data-color="white" data-position="L-2"></td><td class="child" data-color="white" data-position="M-2"></td><td class="child" data-color="white" data-position="N-2"></td><td class="child" data-color="white" data-position="O-2"></td>
						<td class="child" data-color="white" data-position="P-2"></td><td class="child" data-color="white" data-position="Q-2"></td><td class="child" data-color="white" data-position="R-2" style="background-color: white;"></td>
						<td class="parent">-2</td>
					</tr>
					<tr>
						<td class="parent">-3</td>
						<td class="child" data-color="white" data-position="F-3"></td><td class="child" data-color="white" data-position="G-3"></td><td class="child" data-color="white" data-position="H-3"></td><td class="child" data-color="white" data-position="I-3"></td><td class="child" data-color="white" data-position="J-3"></td>
						<td class="child" data-color="white" data-position="K-3"></td><td class="child" data-color="white" data-position="L-3"></td><td class="child" data-color="white" data-position="M-3"></td><td class="child" data-color="white" data-position="N-3"></td><td class="child" data-color="white" data-position="O-3"></td>
						<td class="child" data-color="white" data-position="P-3"></td><td class="child" data-color="white" data-position="Q-3"></td><td class="child" data-color="white" data-position="R-3"></td>
						<td class="parent">-3</td>
					</tr>
					<tr>
						<td class="parent">-4</td>
						<td class="child" data-color="white" data-position="F-4"></td><td class="child" data-color="white" data-position="G-4"></td><td class="child" data-color="white" data-position="H-4"></td><td class="child" data-color="white" data-position="I-4"></td><td class="child" data-color="white" data-position="J-4"></td>
						<td class="child" data-color="white" data-position="K-4"></td><td class="child" data-color="white" data-position="L-4"></td><td class="child" data-color="white" data-position="M-4"></td><td class="child" data-color="white" data-position="N-4"></td><td class="child" data-color="white" data-position="O-4"></td>
						<td class="child" data-color="white" data-position="P-4"></td><td class="child" data-color="white" data-position="Q-4"></td><td class="child" data-color="white" data-position="R-4"></td>
						<td class="parent">-4</td>
					</tr>
					<tr>
						<td class="parent">-5</td>
						<td class="child" data-color="white" data-position="F-5" style="background-color: white;"></td><td class="child" data-color="white" data-position="G-5"></td><td class="child" data-color="white" data-position="H-5"></td><td class="child" data-color="white" data-position="I-5"></td><td class="child" data-color="white" data-position="J-5"></td>
						<td class="child" data-color="white" data-position="K-5"></td><td class="child" data-color="white" data-position="L-5"></td><td class="child" data-color="white" data-position="M-5"></td><td class="child" data-color="white" data-position="N-5"></td><td class="child" data-color="white" data-position="O-5"></td>
						<td class="child" data-color="white" data-position="P-5"></td><td class="child" data-color="white" data-position="Q-5"></td><td class="child" data-color="white" data-position="R-5" style="background-color: white;"></td>
						<td class="parent">-5</td>
					</tr>
					<tr>
						<td class="parent">-6</td>
						<td class="child" data-color="white" data-position="F-6"></td><td class="child" data-color="white" data-position="G-6"></td><td class="child" data-color="white" data-position="H-6"></td><td class="child" data-color="white" data-position="I-6"></td><td class="child" data-color="white" data-position="J-6"></td>
						<td class="child" data-color="white" data-position="K-6"></td><td class="child" data-color="white" data-position="L-6"></td><td class="child" data-color="white" data-position="M-6"></td><td class="child" data-color="white" data-position="N-6"></td><td class="child" data-color="white" data-position="O-6"></td>
						<td class="child" data-color="white" data-position="P-6"></td><td class="child" data-color="white" data-position="Q-6"></td><td class="child" data-color="white" data-position="R-6"></td>
						<td class="parent">-6</td>
					</tr>
					<tr>
						<td class="parent">-7</td>
						<td class="child" data-color="white" data-position="F-7" style="background-color: white;"></td><td class="child" data-color="white" data-position="G-7"></td><td class="child" data-color="white" data-position="H-7"></td><td class="child" data-color="white" data-position="I-7"></td><td class="child" data-color="white" data-position="J-7"></td>
						<td class="child" data-color="white" data-position="K-7" style="background-color: white;"></td><td class="child" data-color="white" data-position="L-7"></td><td class="child" data-color="white" data-position="M-7" style="background-color: white;"></td><td class="child" data-color="white" data-position="N-7"></td><td class="child" data-color="white" data-position="O-7"></td>
						<td class="child" data-color="white" data-position="P-7"></td><td class="child" data-color="white" data-position="Q-7"></td><td class="child" data-color="white" data-position="R-7" style="background-color: white;"></td>
						<td class="parent">-7</td>
					</tr>
					<tr>
						<td class="parent">-8</td>
						<td class="child" data-color="white" data-position="F-8"></td><td class="child" data-color="white" data-position="G-8"></td><td class="child" data-color="white" data-position="H-8"></td><td class="child" data-color="white" data-position="I-8"></td><td class="child" data-color="white" data-position="J-8"></td>
						<td class="child" data-color="white" data-position="K-8"></td><td class="child" data-color="white" data-position="L-8"></td><td class="child" data-color="white" data-position="M-8"></td><td class="child" data-color="white" data-position="N-8"></td><td class="child" data-color="white" data-position="O-8"></td>
						<td class="child" data-color="white" data-position="P-8"></td><td class="child" data-color="white" data-position="Q-8"></td><td class="child" data-color="white" data-position="R-8"></td>
						<td class="parent">-8</td>
					</tr>
					<tr>
						<td class="parent">-9</td>
						<td class="child" data-color="white" data-position="F-9" style="background-color: white;"></td><td class="child" data-color="white" data-position="G-9"></td><td class="child" data-color="white" data-position="H-9" style="background-color: white;"></td><td class="child" data-color="white" data-position="I-9"></td><td class="child" data-color="white" data-position="J-9"></td>
						<td class="child" data-color="white" data-position="K-9"></td><td class="child" data-color="white" data-position="L-9"></td><td class="child" data-color="white" data-position="M-9"></td><td class="child" data-color="white" data-position="N-9"></td><td class="child" data-color="white" data-position="O-9"></td>
						<td class="child" data-color="white" data-position="P-9"></td><td class="child" data-color="white" data-position="Q-9"></td><td class="child" data-color="white" data-position="R-9" style="background-color: white;"></td>
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
									<input type="submit" class="btn btn-primary" value="Save changes">
					</div>
		</div>
	<script src="http://18.212.23.117/blogs/public/newbootstrap/vendor/jquery/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script>
			$(document).ready(function(){
				var cell_index = null;
				$('.child').on("click", function(event){
						cell_index = $(this);
						$('select[class="color-select"]').prop('selectedIndex',0);
						$('select[class="value-select"]').prop('selectedIndex',0);
						$("#myModal").modal();
				});

				$('select[class="color-select"]').on("change", function(color){
						cell_index.css("background-color",$(this).children("option:selected").val());
						cell_index.attr("data-color",$(this).children("option:selected").val());
						// data-color="white"
				});
				$('select[class="value-select"]').on("change", function(value){
						cell_index.html($(this).children("option:selected").val());
				});

				function download(file, text) { 
  
                    //creating an invisible element 
                    var element = document.createElement('a'); 
                    element.setAttribute('href', 'data:text/plain;charset=utf-8, ' 
                                         + encodeURIComponent(text)); 
                    element.setAttribute('download', file); 
  
                    //the above code is equivalent to 
                    // <a href="path of file" download="file name"> 
  
                    document.body.appendChild(element); 
  
                    //onClick property 
                    element.click(); 
  
                    document.body.removeChild(element); 
                } 
				
				$('input[type="submit"]').on("click", function(event){
						// alert('shbhjbhjbhjb');

						// var currentRow = $('.myTable').closest("tr:eq(0)");
						// var col1=currentRow.find("td").text();
						// alert(col1);
							// $('#myTable tr:eq(2)').each(function() {
							// 	var customerId = $(this).find(".customerIDCell").text();
							// 	alert(customerId);
						 // });

						 // $('#myTable tr').each(function() {
						 //    var customerId = $(this).find(".customerIDCell").html();
							// 	alert(customerId);
						 // });
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
						// var final_array = {"status":1,leds:{"F":row_1,"G":row_2,"H":row_3,"I":row_4,"J":row_5,"K":row_6,"L":row_7,"M":row_8,"N":row_9,"O":row_10,"P":row_11,"Q":row_12,"R":row_13}};
						// var final_array = {"status":1,leds:{row_1,row_2,row_3,row_4,row_5,row_6,row_7,row_8,row_9,row_10,row_11,row_12,row_13}};
						
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
							
						// var my_arr = [row_1,row_2,row_3,row_4,row_5,row_6,row_7,row_8,row_9,row_10,row_11,row_12,row_13];
						
						// console.log(filtered);
						// function filter(myState_array) {
							// $.each(myState_array, function(key, value){
								// if (value === "" || value === null){
									// delete myState_array[key];
								// }
							// });
						// }
						
						var myJSON = JSON.stringify({leds:myState_array});
						// console.log(myJSON);
						download("data.json", myJSON);
						// var final_array = ["F"=>row_1,row_2,row_3,row_4,row_5,row_6,row_7,row_8,row_9,row_10,row_11,row_12,row_13];
						// alert(final_array);
						// console.log(myJSON);
						
				});
			});
	</script>
</body>
</html>