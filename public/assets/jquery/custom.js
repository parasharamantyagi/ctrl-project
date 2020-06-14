
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

    // $('#special').on('click', function () {
      // mySelect.find('option:selected').prop('disabled', true);
      // mySelect.selectpicker('refresh');
    // });

    // $('#special2').on('click', function () {
      // mySelect.find('option:disabled').prop('disabled', false);
      // mySelect.selectpicker('refresh');
    // });

    // $('#basic2').selectpicker({
      // liveSearch: true,
      // maxOptions: 1
    // });
	var dataTableViewuserParent = jQuery('.viewuser-parent #example').DataTable({
				dom: 'lifrtp',
				"scrollX": true,
				// language: {
					// "infoFiltered": "",
					// processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
				// },
				"processing": true,
				"serverSide": true,
				"bInfo" : false,
				"pageLength": 50,
				"fnDrawCallback":function(){
						if ($('#example tr').length < 50) {
							$('.dataTables_paginate').hide();
						}
				},
				lengthMenu: [
					[50, 100, 250, 500, 999999],
					['50', '100', '250', '500', 'Show all']
				],
				"ajax": {
					"headers" : {
						'X-CSRF-Token': $('meta[name="_token"]').attr('content')
					},
					"url": "user-table",
					"dataType": "json",
					"type": "POST",
					"data": function(data) {
						data.user_roll = $('select[name="user_roll"]').val()	
					}
				},
				"columns": [
					{"data": "name","sClass":"text_align"},
					{"data": "email","sClass":"text_align","render": function(email,type,full,meta){
						return '<p>'+email+'</p>';
					}},
					{"data": "phone_no","sClass":"text_align" , "render": function(phone_no,type,full,meta){
							return (phone_no) ? phone_no : '';
					}},
					{"data": "image", "searchable": false, "orderable": false, "render": function(data_image,type,full,meta){
							return '<img src="../public/assets/userimages/'+data_image+'" class="user_img img-circle" alt="Cinque Terre">';
					}},
					{"data": "status","sClass":"text_align" , "searchable": false, "orderable": false, "render": function(data,type,full,meta){
						let user_status = (full.status == "1") ? 'active' : '';
							return '<button type="button" class="btn btn-sm btn-secondary btn-toggle '+user_status+'" data-toggle="button" aria-pressed="true" data-id="'+full._id+'" autocomplete="off"><div class="handle"></div></button>';
					}},
					{"data": "_id","sClass":"text_align" , "searchable": false, "orderable": false, "render": function(data,type,full,meta){
							return '<a href="users/'+data+'"><i class="fa fa-pencil-square-o" title="Edit user"></i></a><a href="#" class="delete-user" data-id="'+data+'"><i class="fa fa-trash" title="Delete user"></i></a>';
					}},
				]
			});
			
	$(document).on('click', '.viewuser-parent .delete-user', function(){
					var delete_id = $(this).data('id');
					var tabe_tr = $(this).parents('tr');
					var token = $(this).data("token");
                        $.confirm({
                            icon: 'fa fa-frown-o',
							content: 'Are you sure to delete this user ..?',
                            theme: 'modern',
                            closeIcon: true,
                            animation: 'scale',
                            type: 'blue',
							 buttons: {
                                'confirm': {
                                    text: 'Delete',
                                    btnClass: 'btn btn-primary',
                                    action: function(){
										tabe_tr.remove();
										 $.ajax({
											url: "users/"+delete_id,
											type: 'delete',
											dataType: "JSON",
											headers : {
												'X-CSRF-Token': $('meta[name="_token"]').attr('content')
											},
											success: function (response)
											{
												$.toaster({ priority : 'success', title : 'Success', message : response.message });
											}
										});
                                    }
                                },
                                cancel: function(){
                                },
                            }
                        });
			});
			
		$(document).on('click', '.viewuser-parent .btn-secondary.btn-toggle', function(){
					$.ajax({
							url: "user-status",
							type: 'POST',
							dataType: "JSON",
							headers : {
									'X-CSRF-Token': $('meta[name="_token"]').attr('content')
							},
							data: {
									"status": $(this).attr("aria-pressed"),
									"id": $(this).data('id'),
							},
							success: function (response)
							{
								// $.toaster({ priority : 'success', title : 'Success', message : response.message });
							}
						});
		});
		
		$(document).on('change', '.viewuser-parent select[name="user_roll"]', function(){
					dataTableViewuserParent.draw();
		});
		
		$('.adduser-parent #Updateuser').submit(function(event){
			$('#ctrlscrolbar').html('<div class="author_loading"><img src="'+$('meta[name="_token"]').attr('base_url')+'/public/ctrl-icon/loder.gif'+'" height="150" width="150"></div>');
				var val_return = true;
				if($('input[name="phone_no"]').val() != "" && $('input[name="phone_no"]').val().length < 10)
				{
					$('#ctrlscrolbar').html('');
					$('#phone_noValidation').html('<font color="red">Min 10 characters are required.</font>');
					val_return = false;
				}else{
					$('#phone_noValidation').html('');
					val_return = true;
				}
						 
				if($('input[name="password"]').val().length < 6 && $('#page_title').text() === "Add User")
				{
					$('#ctrlscrolbar').html('');
					$('#passwordValidation').html('<font color="red">Min 6 characters are required.</font>');
					val_return = false;
				}else{
					$('#passwordValidation').html('');
				}
				if($('input[name="confirm_password"]').val().length < 6 && $('#page_title').text() === "Add User")
				{
					$('#ctrlscrolbar').html('');
					$('#passwordcanformValidation').html('<font color="red">Min 6 characters are required.</font>');
					val_return = false;
				}else{
					$('#passwordcanformValidation').html('');
				}
				
				if($('input[name="unique_short_id"]').val().length < 4)
				{
					$('#ctrlscrolbar').html('');
					$('#unique_short_idValidation').html('<font color="red">Min 4 characters are required.</font>');
					val_return = false;
				}else{
					$('#unique_short_idValidation').html('');
				}
						
				if(val_return === false)
				{
					return val_return;
				}
				$.ajax({
					type:this.method,
					url: this.action,
					contentType: false, 
					processData:false,   
					data: new FormData(this),
					success:function(response)
					{
						$('#ctrlscrolbar').html('');
						$('#publisherEmailValidation').html('');
						$('#passwordcanformValidation').html('');
						if(response.status === false)
						{
							$('#'+response.type).html('<font color="red">'+response.message+'</font>');
						}else if(response.status === true){
							window.location.href = "../redirect/users?message="+response.message;
						}
					}
				});
					event.preventDefault();
		});
		
		
		
		
		/// view Viewvehicleinfoall script start
		
	var dataTableViewvehicleinfoall = $('.viewvehicleinfoall #exampleViewVehicleInfoAll').DataTable({
      dom: 'lifrtp',
      "scrollX": true,
      "processing": true,
      "serverSide": true,
      "bInfo" : false,
      "pageLength": 50,
	  "aaSorting": [[4, 'asc']],
      "fnDrawCallback":function(){
          if ($('#exampleViewVehicleInfoAll tr').length < 50) {
            $('.dataTables_paginate').hide();
          }
      },
      lengthMenu: [
        [50, 100, 250, 500, 999999],
        ['50', '100', '250', '500', 'Show all']
      ],
      "ajax": {
        "url": "vehicle-table",
        "dataType": "json",
        "type": "POST",
        "data": function(data) {
          data._token = $('meta[name="_token"]').attr('content'),
          data.brand_name = $('input[class="brand_name"]').val()
        }
      },
      "columns": [
        // {"data": "_id","sClass":"text_align", "render": function(data,type,full,meta){
            // return data;
        // }},
		
		{"data": "brand","sClass":"text_align", "render": function(data,type,full,meta){
            return (data) ? data : '';
        }},
        {"data": "model","sClass":"text_align", "render": function(data,type,full,meta){
            return (data) ? data : '';
        }},
		{"data": "model_spec","sClass":"text_align", "render": function(data,type,full,meta){
            return (data) ? data : '';
        }},
		{"data": "release_year","sClass":"text_align release_year_text_align", "render": function(data,type,full,meta){
            return (data) ? data : '';
        }},
		{"data": "art_no","sClass":"text_align", "render": function(data,type,full,meta){
            return (data) ? data : '';
        }},
        {"data": "vehicle_setting","sClass":"text_align", "render": function(data,type,full,meta){
				var vechile_setting_status = '';
				var vechile_setting__id = 0;
							if(data && data[0]){
								if(data[0]['setting_status'] == '1'){
									var vechile_setting_status = 'active';
								}
								var vechile_setting__id = data[0]._id;
							}
            // if(data == "1")
              // var vechile_setting_status = 'active';
            // else
              // var vechile_setting_status = '';
            return '<button type="button" class="btn btn-sm btn-secondary btn-toggle '+vechile_setting_status+'" data-id="'+vechile_setting__id+'" data-toggle="button" aria-pressed="true" autocomplete="off"><div class="handle"></div></button>';
        }},
        {"data": "_id", "searchable": false, "orderable": false, "render": function(data,type,full,meta){
			// <a href="settings/'+data+'"><i class="fa fa-pencil-square-o" title="Edit setting"></i></a>
			var all_vall = '<a href="vehicle-view/'+data+'" class="edit-user" data-id="'+data+'"><i class="fa fa-eye" title="View"></i></a>';
				all_vall += '<a href="#" class="delete-user" data-id="'+data+'"><i class="fa fa-trash" title="Delete vehicle"></i></a>';
				// <a href="javascript::void(0)" class="qr-code" data-id="'+data+'" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-qrcode" title="View qr-code"></i></a>
			// <a href="settings/'+data+'"><i class="fa fa-pencil-square-o" title="Edit setting"></i></a> 
			// <a href="vehicle/'+full.vehicle_id+'" class="edit-user" data-id="'+full.getvehicle._id+'"><i class="fa fa-wrench" title="Edit vehicle"></i></a>
            return all_vall;
        }},
      ]
    });
	
	
	$('#exampleViewOwnedVehicleInfoAll').DataTable({
				dom: 'lifrtp',
				"scrollX": true,
				// language: {
					// "infoFiltered": "",
					// processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
				// },
				"processing": true,
				"serverSide": true,
				"bInfo" : false,
				"pageLength": 50,
				"aaSorting": [[4, 'asc']],
				"fnDrawCallback":function(){
						if ($('#exampleViewOwnedVehicleInfoAll tr').length < 50) {
							$('.dataTables_paginate').hide();
						}
				},
				lengthMenu: [
					[50, 100, 250, 500, 999999],
					['50', '100', '250', '500', 'Show all']
				],
				"ajax": {
					"url": "vehicle-table?type=owned",
					"dataType": "json",
					"type": "POST",
					"data": function(data) {
						data._token = $('meta[name="_token"]').attr('content')
					}
				},
				"columns": [
					// {"data": "_id","sClass":"text_align", "render": function(data,type,full,meta){
							// return data;
					// }},
					{"data": "brand","sClass":"text_align", "render": function(data,type,full,meta){
						return (data) ? data : '';
					}},
					{"data": "model","sClass":"text_align", "render": function(data,type,full,meta){
						return (data) ? data : '';
					}},
					{"data": "model_spec","sClass":"text_align", "render": function(data,type,full,meta){
						return (data) ? data : '';
					}},
					{"data": "release_year","sClass":"text_align release_year_text_align", "render": function(data,type,full,meta){
						return (data) ? data : '';
					}},
					{"data": "art_no","sClass":"text_align", "render": function(data,type,full,meta){
						return (data) ? data : '';
					}},
					// {"data": "setting_use_status","sClass":"text_align", "render": function(data,type,full,meta){
							// return (data === '1') ? '<p class="setting_use_status btn-danger">USED</p>' : '<p class="setting_use_status btn-success">AVAILABLE</p>';
					// }},
					{"data": "vehicle_setting","sClass":"text_align", "render": function(data,type,full,meta){
							if(data && data[0] && data[0]['setting_status'] == '1'){
								var vechile_setting_status = 'active';
								var vechile_setting__id = data[0]['_id'];
							}else{
								var vechile_setting_status = '';
								var vechile_setting__id = 0;
							}
							return '<button type="button" class="btn btn-sm btn-secondary btn-toggle '+vechile_setting_status+'" data-id="'+vechile_setting__id+'" data-toggle="button" aria-pressed="true" autocomplete="off"><div class="handle"></div></button>';
					}},
					{"data": "_id", "searchable": false, "orderable": false, "render": function(data,type,full,meta){
						// return '<a href="settings/'+data+'"><i class="fa fa-pencil-square-o" title="Edit setting"></i></a> <a href="#" class="delete-user" data-id="'+data+'" data-token="{{ csrf_token() }}"><i class="fa fa-trash" title="Delete vehicle"></i></a><br /><a href="vehicle-view/'+full.vehicle_id+'" class="edit-user" data-id="'+data+'"><i class="fa fa-eye" title="View"></i></a><a href="vehicle/'+full.vehicle_id+'" class="edit-user" data-id="'+full.getvehicle._id+'"><i class="fa fa-wrench" title="Edit vehicle"></i></a>';
						return '<a href="#" class="delete-user" data-id="'+data+'"><i class="fa fa-trash" title="Delete vehicle"></i></a>&nbsp;<a href="vehicle-view/'+data+'" class="edit-user" data-id="'+data+'"><i class="fa fa-eye" title="View"></i></a>';
					}},
				]
			});
	
	$(document).on('change', 'select[name="vehicle_id"]', function(){
        dataTableViewvehicleinfoall.draw();
    });
	
	// $(document).on('click', 'a[class="btn btn-primary vehicle_info"]', function(){
		// if(!$('.selectpickerss').val())
		// {
			// $.toaster({ priority : 'danger', title : 'Warning', message : 'Please select brand first' });
		// }else{
			// window.location.href = "view-vehicle?brand_name="+$('.selectpickerss').val();
		// }
    // });
	
	
	$(document).on('click', '.viewvehicleinfoall .delete-user', function(){
        var delete_id = $(this).data('id');
        var tabe_tr = $(this).parents('tr');
                      $.confirm({
                          icon: 'fa fa-frown-o',
						  content: 'Are you sure to delete this Vehicle ..?',
                          theme: 'modern',
                          closeIcon: true,
                          animation: 'scale',
                          type: 'blue',
						  buttons: {
									  'confirm': {
									  text: 'Delete',
									  btnClass: 'btn btn-primary',
									  action: function(){
										  tabe_tr.remove();
										   $.ajax({
											url: "vehicle/"+delete_id,
											type: 'delete',
											dataType: "JSON",
											data: {
											  "_token": $('meta[name="_token"]').attr('content'),
											},
											success: function (response)
											{
											  $.toaster({ priority : 'success', title : 'Success', message : response.message });
											}
										  });
									  }
								  },
								  cancel: function(){
								  },
                          }
                      });

    });
	
	$(document).on('click', '.viewvehicleinfoall .btn-secondary.btn-toggle', function(){
        $.ajax({
            url: "./vehicle-setting-status",
            type: 'POST',
            dataType: "JSON",
            data: {
                "_token": $('meta[name="_token"]').attr('content'),
                "status": $(this).attr("aria-pressed"),
                "id": $(this).data('id'),
            }
          });
    });
	
	$(document).on('click', '.viewvehicleinfoall a[class="qr-code"]', function(){
			$.ajax({
				url: "./get-vehicle-qrcode",
				type: 'POST',
				dataType: "JSON",
				data: {
					"id": $(this).data('id'),
					"_token": $('meta[name="_token"]').attr('content'),
				},
				success: function (response)
				{
					$('img[class="d-block w-100"]').attr('src',response);
				}
			});
	});
	
	$('.viewvehicleinfoall .carousel').carousel({
		interval: false
	});
		
		/// view viewvehicleinfoall script end
		
	$('.updateuserSetting #UpdateuserSetting').submit(function(event){
		$( "em" ).remove();
		// $('#publisherEmailValidation').html('<div class="author_loading"><img src="{{ url('public/ctrl-icon/loder.gif') }}" height="150" width="150"></div>');
		 $.ajax({
		   type:this.method,
		   url: this.action,
		   contentType: false, 
		   processData:false,   
		   data: new FormData(this),
		   success:function(response)
		   {
				var result = JSON.parse(response);
				if(result.status == true) {
					if(result.action === 'add_form')
						// $("#UpdateuserSetting").trigger("reset");
						window.location.href = "./redirect/view-vehicle?message="+result.message;
					else
						window.location.href = "../redirect/settings?setting_id="+result.setting_id+"&message="+result.message;
				}else{
					$('#password').after('<em class="error help-block">'+result.message+'</em>');
				}
		   }
		});
		event.preventDefault();
	});
	
	
	
	$('.viewtable #Updateuser').submit(function(event){
		$('#ctrlscrolbar').html('<div class="author_loading"><img src="'+$('meta[name="_token"]').attr('base_url')+'/public/ctrl-icon/loder.gif'+'" height="150" width="150"></div>');
		 $.ajax({
		   type:this.method,
		   url: this.action,
		   contentType: false, 
		   processData:false,   
		   data: new FormData(this),
		   success:function(response)
		   {
				var result = JSON.parse(response);
				$.toaster({ priority : 'success', title : 'Success', message : result.message });
		   }
		});
		event.preventDefault();
	});
	

	
					
		
		$.validator.setDefaults({
			submitHandler: function() {
				$('.viewprofile #Updateuser').submit(function(event){
						 if($('input[name="old_password"]').val() && $('input[name="new_password"]').val() && $('input[name="confirm_password"]').val())
						 {
							if($('input[name="new_password"]').val() !== $('input[name="confirm_password"]').val())
							{
								$('#passwordcanformValidation').html('<font color="red">Your confirm password does not match.</font>');
								return false;
							}
						 }
						 $('#ctrlscrolbar').html('<div class="author_loading"><img src="'+$('meta[name="_token"]').attr('base_url')+'/public/ctrl-icon/loder.gif'+'" height="150" width="150"></div>');
						 $.ajax({
						   type:this.method,
						   url: this.action,
						   contentType: false, 
						   processData:false,   
						   data: new FormData(this),
						   success:function(result)
						   {
								$('#ctrlscrolbar').html('');
								$('#passwordcanformValidation').html('');
								$('#old_passwordValidation').html('');
								// var result = JSON.parse(response);
								if(result.status === false)
								{
									$('input[name="_token"]').val(result.token);
									$('#'+result.type).html('<font color="red">'+result.message+'</font>');
									// if(result.type == 'old_passwordValidation')
									// {
										// $('input[type="password"]').val('');
									// }
								}else{
									$.toaster({ priority : 'success', title : 'Success', message : result.message });
									$('input[type="email"]').val(result.email_id);
									$('input[type="password"]').val('');
									return true;
								}
						   }
						});
						event.preventDefault();
					});
			}
		});
		
		$( document ).ready( function () {
			$(".viewprofile #Updateuser").validate({
				rules: {
					new_password: {required: false,minlength: 6},
					confirm_password: {required: false,minlength: 6,equalTo: "#new_password"}
				},
				messages: {
					new_password: {minlength:"Your password must be at least 6 characters long"},
					confirm_password: {minlength:"Your canform password must be at least 6 characters long",equalTo: "Your confirm password does't match"}
				},
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					error.addClass( "help-block" );

					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "label" ) );
					} else {
						error.insertAfter( element );
					}
				},
				highlight: function( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
				},
				unhighlight: function(element, errorClass, validClass) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
				}
			});
		});
		
			$( ".numeric-val" ).on('keypress blur', function (evt) {
				// $('input[name="'+evt.srcElement.name+'"]')
				// console.log(evt.srcElement);
				var iKeyCode = (evt.which) ? evt.which : evt.keyCode;
					if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
					{
							$( "em" ).remove();
							$(this).after('<em class="error help-block horse_power_numeric">Please add a numeric value.</em>');
						return false;
					}else{
							$( "em" ).remove();
						return true;
					}
				});
			
			$('input[name="gearbox_amount_of_gears"]').on('keyup', function () {
				var my_value = $(this).val();
				if(my_value && my_value >= 4 && my_value <=8){
					var length_input = $('input[name="max_speed_per_gears[]"]').length;
					console.log(my_value+' || '+length_input);
					if(my_value < 8){
						$('input[id="max_speed_per_gears8"]').remove();
					}
					if(my_value < 7){
						$('input[id="max_speed_per_gears7"]').remove();
					}
					if(my_value < 6){
						$('input[id="max_speed_per_gears6"]').remove();
					}
					if(my_value < 5){
						$('input[id="max_speed_per_gears5"]').remove();
					}
					if(my_value > length_input)
					{
						for(var i = length_input+1; i <= my_value; i++) {
							$('input[id="max_speed_per_gears4"]').after('<input type="text" class="form-control numeric-val box-1" name="max_speed_per_gears[]" id="max_speed_per_gears'+i+'">');
						}
					}
						
					
					
				}
			});
			
		
  });  
		function form_return()
		{
			window.history.back();
		}