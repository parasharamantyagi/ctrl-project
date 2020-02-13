
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
	var dataTable = jQuery('.viewuser-parent #example').DataTable({
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
					dataTable.draw();
		});
		
		$('.adduser-parent #Updateuser').submit(function(event){
			$('#ctrlscrolbar').html('<div class="author_loading"><img src="'+$('meta[name="_token"]').attr('base_url')+'/public/ctrl-icon/loder.gif'+'" height="150" width="150"></div>');
				var val_return = true;
				if($('input[name="phone_no"]').val().length < 10)
				{
					$('#ctrlscrolbar').html('');
					$('#phone_noValidation').html('<font color="red">Min 10 characters are required.</font>');
					val_return = false;
				}else{
					$('#phone_noValidation').html('');
					val_return = true;
				}
						 
				if($('input[name="password"]').val().length < 6 && "{{ $page_info['page_title'] }}" === "Add User")
				{
					$('#ctrlscrolbar').html('');
					$('#passwordValidation').html('<font color="red">Min 6 characters are required.</font>');
					val_return = false;
				}else{
					$('#passwordValidation').html('');
				}
				if($('input[name="confirm_password"]').val().length < 6 && "{{ $page_info['page_title'] }}" === "Add User")
				{
					$('#ctrlscrolbar').html('');
					$('#passwordcanformValidation').html('<font color="red">Min 6 characters are required.</font>');
					val_return = false;
				}else{
					$('#passwordcanformValidation').html('');
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
						var result = JSON.parse(response);
						if(result.status === false)
						{
							$('#'+result.type).html('<font color="red">'+result.message+'</font>');
						}else{
							window.location.href = "../redirect/users?message="+result.message;
						}
					}
				});
					event.preventDefault();
		});
		
		function form_return()
		{
			window.history.back();
		}
  });