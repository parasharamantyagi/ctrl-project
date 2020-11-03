
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="{{ url('/public/assets/images/icone.jpg') }}">
<title> Ctrl</title>
 
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-116706082-1"></script>
		<script>
		 window.dataLayer = window.dataLayer || [];
		 function gtag(){dataLayer.push(arguments);}
		 gtag('js', new Date());

		 gtag('config', 'UA-116706082-1');
		</script>
		
			
<!-- Mobile Specific Meta -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- Store CSRF token for AJAX calls -->
	
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- Stylesheets -->
		<link href="{{ url('/assets/bootstrap/bootstrap.min.css') }}" rel="stylesheet"><!-- Bootstrap core CSS -->
		<link href="https://ebookbazaar.com/style/font-awesome.min.css" rel="stylesheet"><!-- font-awesome Bootstrap core CSS -->
		<link href="{{ url('/assets/login/style.css') }}" rel="stylesheet"><!-- Custom CSS -->
		<link href="{{ url('/assets/login/responsive.css') }}" rel="stylesheet"><!-- Custom responsive CSS --> 
		<link href="{{ url('/assets/login/font-awesome.min.css') }}" rel="stylesheet"><!-- Custom responsive CSS --> 
		<link href="{{ url('/assets/login/animate.min.css') }}" rel="stylesheet"><!-- Custom responsive CSS --> 
		<link rel="stylesheet" type="text/css" href="{{ url('/public/assets/login/toastr.css') }}">
		<!-- Favicon and Apple Icons -->
		<link rel="shortcut icon" href="{{ url('public/ctrl-icon/ctrl_title3x.png') }}">
</head>
		<body>
			<div class="top_header">
		
		</div><!--/top_header-->
<style>
.top_header, .header, .user_breadcrumbs {display:none !important;}
.logo {margin: 0px auto 30px; width: 50%;}
</style>
<section class="admin_login_panel">		
<div class="login_details_admin_outer">			
<div class="login_details">			
<div class="logo">
			<a href="{{ url('/admin') }}"><img class="login-image-icone" alt="eBookBazaar" src="{{ url('public/ctrl-icon/ctrl_title3x.png') }}"></a>
		</div>			
<div class="login_innerdetails">
                    <form class="form-horizontal" role="form" method="POST" action="">
                         {{ csrf_field() }}
                        <div class="form-group input-group">	
                            <!-- label for="email" class="col-md-4 control-label">E-Mail Address</label  -->
                            <div class="col-md-12">
								<span class="input-group-addon"><img src="{{ url('public/ctrl-icon/email1.png') }}"></span>
								<input id="email" type="email" class="form-control" name="email" value="" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
							<span class="input-group-addon"><img src="{{ url('public/ctrl-icon/lock1.png') }}"></span>
                                <input id="password" type="password" class="form-control" name="password" required>
									@if($errors->any())
										<span class="help-block"><strong>{{$errors->first()}}</strong></span>
									@endif
							</div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 txt_center">
                                <button type="submit" class="hvr-sweep-to-right-bgcolor">
                                    Login
                                </button>
                            </div>
                        </div>
						<div class="form-group">
							<div class="col-xs-6 txt_right">
								<a class="btn btn-link " href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                            </div>
                        </div>
                    </form>	
                </div>
            </div>
            </div>
			</section>


<!-- JavaScript -->
<script src="{{ url('/assets/jquery/jquery/jquery.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


</body>
</html>