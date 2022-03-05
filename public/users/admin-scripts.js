function allowDropThis(i) {
    i.preventDefault();
}

function dragThis(i) {
    i.dataTransfer.setData("doggo", i.target.id);
}

function dropThis(i) {
    i.preventDefault();
    var data = i.dataTransfer.getData("doggo");
	// console.log();
	// console.log(data);
	
	ajaxFunctionPosition(i.target.attributes[1].nodeValue,data);
    i.target.appendChild(document.getElementById(data));
}



function ajaxFunctionPosition(parent_key,button_key){
		$.ajax({
			url: "entrance-west-building-clone",
			type: 'POST',
			dataType: "JSON",
			data: {
					"type": 'change_button_position',
					"sequence_key": parent_key,
					"sequence_name": button_key,
					"vehicle_id": $('input[name="vehicle_id"]').val(),
					"_token": $('meta[name="_token"]').attr('content'),
			},
			success: function (response)
			{
				
			}
		});
}