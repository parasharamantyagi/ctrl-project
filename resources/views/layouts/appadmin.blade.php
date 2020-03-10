<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="_token" content="{{ csrf_token() }}" base_url="{{ url('') }}">

  <title>CTRL</title>
  

  <!-- Bootstrap core CSS -->
  <link href="{{ url('/public/newbootstrap/vendor/bootstrap/css/bootstrap.css') }}" rel="stylesheet">  
  <link rel="stylesheet" type="text/css" href="{{ url('/public/assets/bootstrap/jquery.dataTables.css') }}">
  <link rel="stylesheet" type="text/css" id="a" href="{{ url('/public/assets/bootstrap/custom.css') }}"/>
  
  
  <!-- Custom fonts for this template -->
  <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet">
  <link href="{{ url('/public/newbootstrap/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="{{ url('/public/newbootstrap/css/resume.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{ url('/public/assets/bootstrap/jquery-confirm.min.css') }}">
  <link rel="stylesheet" href="{{ url('/public/assets/bootstrap/select2.min.css') }}">
  <link rel="stylesheet" href="{{ url('/public/newbootstrap/datetimepicker/jquery-ui.css') }}">
</head>

<body id="page-top">

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary " id="sideNav">

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand js-scroll-trigger" href="{{ url(user_role('dashboard')) }}">
      <span class="d-block d-lg-none">CTRL</span>
      <span class="d-none d-lg-block">
        <img class="img-fluid img-profile mx-auto mb-2" src="{{ url('/public/ctrl-icon/ctrl_title3x.png') }}" alt="">
      </span>
    </a>
	
	
	
    <div class="collapse navbar-collapse bg-dark" id="navbarSupportedContent">
      <ul class="navbar-nav">
	  
		<li class="nav-item navbar-parent {{ Request::segment(2) == 'dashboard' ? 'active': '' }}">
          <a class="nav-link nav-link-main js-scroll-trigger" href="{{ url(user_role('dashboard')) }}">START</a>
        </li>
		
		<li class="nav-item navbar-parent {{ Request::segment(2) == 'news-deals' ? 'active': '' }}">
          <a class="nav-link nav-link-main js-scroll-trigger" href="{{ url(user_role('news-deals')) }}">NEWS & DEALS</a>
        </li>
        <!-- li class="nav-item {{ Request::segment(2) == 'dashboard' ? 'active': '' }}">
          <a class="nav-link nav-link-main js-scroll-trigger" href="{{ url(user_role('dashboard')) }}">Dashboard</a>
        </li>
        <li class="nav-item {{ Request::segment(2) == 'settings' ? 'active': '' }}">
          <a class="nav-link nav-link-main js-scroll-trigger" href="{{ url(user_role('settings')) }}">SETTINGS</a>
        </li -->
        <li class="nav-item navbar-parent {{ Request::segment(2) == 'vehicle' || Request::segment(2) == 'view-vehicle' || Request::segment(2) == 'owned' ? 'active': '' }}">
          <a class="nav-link nav-link-main js-scroll-trigger" href="{{ url(user_role('view-vehicle')) }}">Product</a>
        </li>
		  <ul class="navbar-nav">
			<li class="nav-item {{ Request::segment(2) == 'vehicle' ? 'active': '' }}">
			  <a class="nav-link nav-link-submenu js-scroll-trigger" href="{{ url(user_role('vehicle')) }}">- NEW</a>
			</li>
			<li class="nav-item {{ Request::segment(2) == 'view-vehicle' ? 'active': '' }}">
			  <a class="nav-link nav-link-submenu js-scroll-trigger" href="{{ url(user_role('view-vehicle')) }}">- EXISTING</a>
			</li>
			<li class="nav-item {{ Request::segment(2) == 'owned' ? 'active': '' }}">
			  <a class="nav-link nav-link-submenu js-scroll-trigger" href="{{ url(user_role('owned')) }}">- Owned</a>
			</li>
			<!--li class="nav-item {{ Request::segment(2) == 'led-config' ? 'active': '' }}">
			  <a class="nav-link nav-link-submenu js-scroll-trigger" href="#led-config">- Led Config</a>
			</li -->
		  </ul>
		
			
        <li class="nav-item navbar-parent {{ Request::segment(2) == 'users' || Request::segment(2) == 'create' || Request::segment(2) == 'my-setting' ? 'active': '' }}">
			<a class="nav-link nav-link-main js-scroll-trigger" href="{{ url(user_role('users')) }}">User</a>
		</li>
		  <ul class="navbar-nav">
			<li class="nav-item {{ Request::segment(2) == 'users' && Request::segment(3) == 'create' ? 'active': '' }}">
			  <a class="nav-link nav-link-submenu js-scroll-trigger" href="{{ url(user_role('users/create')) }}">- NEW</a>
			</li>
			<li class="nav-item {{ Request::segment(2) == 'users' && !Request::segment(3) ? 'active': '' }}">
			  <a class="nav-link nav-link-submenu js-scroll-trigger" href="{{ url(user_role('users')) }}">- EXISTING</a>
			</li>
			<li class="nav-item {{ Request::segment(2) == 'my-setting' ? 'active': '' }}">
			  <a class="nav-link nav-link-submenu js-scroll-trigger" href="{{ url(user_role('my-setting')) }}">- SETTINGS</a>
			</li>
		  </ul>
		
		<li class="nav-item navbar-parent {{ Request::segment(2) == 'edit-tables' ? 'active': '' }}">
			<a class="nav-link nav-link-main js-scroll-trigger" href="{{ url(user_role('edit-tables')) }}">Maintenance</a>
		</li>
		<ul class="navbar-nav">
			<li class="nav-item {{ Request::segment(2) == 'edit-tables' ? 'active': '' }}">
			  <a class="nav-link nav-link-submenu js-scroll-trigger" href="{{ url(user_role('edit-tables')) }}">- Edit tables</a>
			</li>
		</ul>
		
		<li class="nav-item navbar-parent">
          <a class="nav-link nav-link-main js-scroll-trigger" href="{{ url(user_role('create-new-car')) }}" target="_blank">TOOL-1</a>
        </li>
		
		<li class="nav-item navbar-parent">
          <a class="nav-link nav-link-main js-scroll-trigger" href="{{ url(user_role('create-excel-sheet')) }}" target="_blank">TOOL-2</a>
        </li>
		
        <li class="nav-item">
          <a class="nav-link nav-link-main js-scroll-trigger" href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Log out</a>
			 <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
				{{ csrf_field() }}
			</form>
        </li>
      </ul>
    </div>
  </nav>
	
		<div class="container-fluid p-0">
				@yield('content')
		</div>

  <!-- Bootstrap core JavaScript -->
  
  
  
  <script src="{{ url('/public/newbootstrap/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ url('/public/newbootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<!-- <script type="text/javascript" src="{{ url('/public/assets/jquery/actions.js') }}"></script> -->
  <!-- Plugin JavaScript -->
  <script src="{{ url('/public/newbootstrap/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script type='text/javascript' src="{{ url('/public/assets/jquery/jquery.dataTables.min.js') }}"></script>
  <!-- Custom scripts for this template -->
  <script src="{{ url('/public/newbootstrap/js/resume.min.js') }}"></script>
  <script type="text/javascript" src="{{ url('/public/assets/jquery/jquery.toaster.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
  <script type="text/javascript" src="{{ url('/public/assets/jquery/select2.min.js') }}"></script>
  <script type='text/javascript' src="{{ url('/public/assets/jquery/jquery.validate.min.js') }}"></script>
  <script type="text/javascript" src="{{ url('/public/newbootstrap/datetimepicker/jquery-ui.js') }}"></script>
  <script type="text/javascript" src="{{ url('/public/assets/jquery/custom.js') }}"></script>
	<script>
		
		
        // Show hide popover
	
	$(document).ready(function(){
		$(document).on("click", function(event){
			var $trigger = $(".navbar-toggler");
			if($trigger !== event.target && !$trigger.has(event.target).length){
				// alert('asdasd');
				$(".navbar-collapse").removeClass("show");
			}            
		});
	});
				$(".selectpicker").select2({
					allowClear: true
				});
				
				$(function() {
					$(".datetimepicker").datepicker({
					  changeMonth: true,
					  changeYear: true,
					  dateFormat: 'dd-mm-yy',
					  yearRange: '-100y:c+nn'
					});
				  });
	</script>
	
	@yield('script')
</body>

</html>

