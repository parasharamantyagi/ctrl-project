
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="https://ebookbazaar.com/images/icon.png">
<title>Punjabi Books | eBookBazaar</title>
 
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-116706082-1"></script>
		<script>
		 window.dataLayer = window.dataLayer || [];
		 function gtag(){dataLayer.push(arguments);}
		 gtag('js', new Date());

		 gtag('config', 'UA-116706082-1');
		</script>
		
			<meta name="description" content="eBookBazaar is an online platform to buy Punjabi Books,Religious Books,Literature,Monographs,Novels,Poetry. Both Physical as well Digitized form.">
		<meta name="keywords" content="Punjabi books buy online,Punjabi Books,Punjabi Poetry,Sikh Religious Books,Punjabi Novels,Punjabi Literature,Buy Punjabi Books Online,Punjabi History,punjabi literature sites.">
	
<!-- Mobile Specific Meta -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- Store CSRF token for AJAX calls -->
	
<meta name="csrf-token" content="zxogo7sP1DEjcWWYxqVI3FzrDoN4UfH9codfC5xY">
		<!-- Stylesheets -->
		<link href="{{ url('/public/assets/bootstrap/bootstrap.min.css') }}" rel="stylesheet"><!-- Bootstrap core CSS -->
		<link href="https://ebookbazaar.com/style/font-awesome.min.css" rel="stylesheet"><!-- font-awesome Bootstrap core CSS -->
		<link href="{{ url('/public/assets/login/style.css') }}" rel="stylesheet"><!-- Custom CSS -->
		<link href="{{ url('/public/assets/login/responsive.css') }}" rel="stylesheet"><!-- Custom responsive CSS --> 
		<link href="{{ url('/public/assets/login/font-awesome.min.css') }}" rel="stylesheet"><!-- Custom responsive CSS --> 
		<link href="{{ url('/public/assets/login/animate.min.css') }}" rel="stylesheet"><!-- Custom responsive CSS --> 
		<link rel="stylesheet" type="text/css" href="{{ url('/public/assets/login/toastr.css') }}">
		<!-- Favicon and Apple Icons -->
		<link rel="shortcut icon" href="{{ url('public/ctrl-icon/ctrl_title3x.png') }}">
</head>
				<body>
				<!--/top_header-->
<!--/header-->

			
		<div class="hide_show"><i class="fa fa-cog" aria-hidden="true"></i></div>
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
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group input-group">	
                            <div class="col-md-12">
							<span class="input-group-addon"><img src="{{ url('public/ctrl-icon/email1.png') }}"></span>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
							@error('email')
                                    <span class="help-block"><strong>{{ $message }}</strong></span>
                            @enderror
							</div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 txt_center">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>	
					                </div>
            </div>
            </div>
</section>

	
<!-- JavaScript -->
<script src="https://ebookbazaar.com/js/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://ebookbazaar.com/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="https://purtuga.github.io/jquery.stickOnScroll/src/jquery.stickOnScroll.js"></script>
<script type="text/javascript" src="https://ebookbazaar.com/js/validator.js"></script>
<script type="text/javascript" src="https://ebookbazaar.com/js/sliderjs.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script async src="https://static.addtoany.com/menu/page.js"></script>
  

	
</body>
</html>