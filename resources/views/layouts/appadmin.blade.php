<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Resume - Start Bootstrap Theme</title>

  <!-- Bootstrap core CSS -->
  <link href="{{ url('/public/newbootstrap/vendor/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" id="a" href="{{ url('/public/assets/bootstrap/custom.css') }}"/>
  
  
  <!-- Custom fonts for this template -->
  <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet">
  <link href="{{ url('/public/newbootstrap/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="{{ url('/public/newbootstrap/css/resume.min.css') }}" rel="stylesheet">
  

</head>

<body id="page-top">

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary " id="sideNav">
    <a class="navbar-brand js-scroll-trigger" href="#page-top">
      <span class="d-block d-lg-none">CTRL</span>
      <span class="d-none d-lg-block">
        <img class="img-fluid img-profile mx-auto mb-2" src="http://18.212.23.117/blogs/public/ctrl-icon/ctrl_title3x.png" alt="">
      </span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="{{ url('/admin/dashboard') }}">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="{{ url('/admin/settings') }}">SETTINGS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="{{ url('/admin/view-vehicle') }}">VEHICLE</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="{{ url('/admin/news-deals') }}">NEWS & DEALS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="{{ url('/admin/users') }}">User</a>
        </li>
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
  
  
  
  
  <script src="{{ url('/public/newbootstrap/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ url('/public/newbootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('/public/assets/jquery/actions.js') }}"></script>
	<script type="text/javascript" src="{{ url('/public/assets/jquery/custom.js') }}"></script>
  <!-- Plugin JavaScript -->
  <script src="{{ url('/public/newbootstrap/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script type='text/javascript' src="{{ url('/public/assets/jquery/jquery.dataTables.min.js') }}"></script>
  <!-- Custom scripts for this template -->
  <script src="{{ url('/public/newbootstrap/js/resume.min.js') }}"></script>
  <script type="text/javascript" src="{{ url('/public/assets/jquery/jquery.toaster.js') }}"></script>

	@yield('script')
</body>

</html>

