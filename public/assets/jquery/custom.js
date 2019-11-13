
					$(document).ready(function(){
						jQuery('#upload_image_button').hide();
						$('#output').click(function(){
							 jQuery('#upload_image_button').click();
						})
					})
					
					 var loadFile = function(event) {
						var reader = new FileReader();
						reader.onload = function(){
						  var output = document.getElementById('output');
						  output.src = reader.result;
						};
						reader.readAsDataURL(event.target.files[0]);
					  };
			
  $(document).ready(function () {
    var mySelect = $('#first-disabled2');

    $('#special').on('click', function () {
      mySelect.find('option:selected').prop('disabled', true);
      mySelect.selectpicker('refresh');
    });

    $('#special2').on('click', function () {
      mySelect.find('option:disabled').prop('disabled', false);
      mySelect.selectpicker('refresh');
    });

    $('#basic2').selectpicker({
      liveSearch: true,
      maxOptions: 1
    });
  });