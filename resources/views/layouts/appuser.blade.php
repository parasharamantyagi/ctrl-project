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
  <link href="{{ url('/newbootstrap/vendor/bootstrap/css/bootstrap.css') }}" rel="stylesheet">  
  <link rel="stylesheet" type="text/css" href="{{ url('/assets/bootstrap/jquery.dataTables.css') }}">
  <link rel="stylesheet" type="text/css" id="a" href="{{ url('/users/custom.css') }}"/>
  
  
  <!-- Custom fonts for this template -->
  <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet">
  <link href="{{ url('/newbootstrap/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="{{ url('/newbootstrap/css/resume.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{ url('/assets/bootstrap/jquery-confirm.min.css') }}">
  <link rel="stylesheet" href="{{ url('/newbootstrap/datetimepicker/jquery-ui.css') }}">
  <link rel="stylesheet" href="{{ url('/assets/bootstrap/select2.min.css') }}">
	
</head>

<body id="page-top">

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary " id="sideNav">

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand js-scroll-trigger" href="#page-top">
      <span class="d-block d-lg-none">CTRL</span>
      <span class="d-none d-lg-block">
        <img class="img-fluid img-profile mx-auto mb-2" src="{{ url('/ctrl-icon/ctrl_title3x.png') }}" alt="">
      </span>
    </a>
	
	
	
    <div class="collapse navbar-collapse bg-dark" id="navbarSupportedContent">
      <ul class="navbar-nav">
        <li class="nav-item {{ Request::segment(2) == 'dashboard' ? 'active': '' }}">
          <a class="nav-link js-scroll-trigger" href="{{ url(user_role('dashboard')) }}">Dashboard</a>
        </li>
        <!-- li class="nav-item {{ Request::segment(2) == 'setting' ? 'active': '' }}">
          <a class="nav-link js-scroll-trigger" href="{{ url(user_role('setting/all')) }}">SETTINGS</a>
        </li -->
        <li class="nav-item {{ Request::segment(2) == 'vehicle' ? 'active': '' }}">
          <a class="nav-link js-scroll-trigger" href="{{ url(user_role('vehicle')) }}">PRODUCT</a>
        </li>
        <li class="nav-item {{ Request::segment(2) == 'profile' ? 'active': '' }}">
          <a class="nav-link js-scroll-trigger" href="{{ url(user_role('profile')) }}">Profile</a>
        </li>
		<li class="nav-item {{ Request::segment(2) == 'led-motor-config' ? 'active': '' }}">
          <a class="nav-link js-scroll-trigger" href="{{ url(user_role('led-motor-config')) }}">LED & Motor config</a>
        </li>
		<!-- li class="nav-item {{ Request::segment(2) == 'create-new-car' ? 'active': '' }}">
          <a class="nav-link js-scroll-trigger" href="{{ url(user_role('create-new-car')) }}">LED config</a>
        </li>
		<li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="{{ url(user_role('create-new-car')) }}" target="_blank">TOOL-1</a>
        </li>
		<li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="{{ url(user_role('create-excel-sheet')) }}" target="_blank">TOOL-2</a>
        </li -->
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Log out</a>
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
  
  
  
  
  <script src="{{ url('/newbootstrap/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ url('/newbootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('/assets/jquery/actions.js') }}"></script>
	<script type="text/javascript" src="{{ url('/assets/jquery/custom.js') }}"></script>
  <!-- Plugin JavaScript -->
  <script src="{{ url('/newbootstrap/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script type='text/javascript' src="{{ url('/assets/jquery/jquery.dataTables.min.js') }}"></script>
  <!-- Custom scripts for this template -->
  <script src="{{ url('/newbootstrap/js/resume.min.js') }}"></script>
  <script type="text/javascript" src="{{ url('/assets/jquery/jquery.toaster.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
  <script type="text/javascript" src="{{ url('/newbootstrap/datetimepicker/jquery-ui.js') }}"></script>
  <script type="text/javascript" src="{{ url('/assets/jquery/select2.min.js') }}"></script>
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

