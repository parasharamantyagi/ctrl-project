<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- link rel="shortcut icon" href="https://ebookbazaar.com/images/icon.png" -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge" /> -->
        <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no" />
        <title> Dashboard | Admin Panel</title> 
										
										
		
		<link rel="stylesheet" type="text/css" id="theme" href="{{ url('/public/assets/bootstrap/theme-default.css') }}"/>
		<link rel="stylesheet" type="text/css" id="theme" href="{{ url('/public/assets/bootstrap/bootstrap.min.css') }}"/>
		<link rel="stylesheet" type="text/css" id="a" href="{{ url('/public/assets/bootstrap/custom.css') }}"/>
		<link rel="stylesheet" type="text/css" id="a" href="{{ url('/public/assets/bootstrap/jquery.datetimepicker.css') }}"/>
		<link rel="stylesheet" type="text/css" id="a" href="{{ url('/public/assets/bootstrap/select2.min.css') }}"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">

</head>
<body>
	     <div class="page-container">
            
            <!-- START PAGE SIDEBAR -->
            <div class="page-sidebar">
                <!-- START X-NAVIGATION -->
                <ul class="x-navigation">
    <li class="xn-logo">
        <a href="{{ url('/admin') }}"><img class="image-icone" src="{{ url('public/ctrl-icon/ctrl_title3x.png') }}" /></a>
        <a href="#" class="x-navigation-control"></a>
    </li>

    <li class="{{ Request::segment(2) == 'dashboard' ? 'active': '' }}">
        <a href="{{ url('/admin/dashboard') }}"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>
    </li>
    <!-- li class="{{ Request::segment(2) == 'vehicle' ? 'active': '' }}">
        <a href="{{ url('/admin/vehicle') }}"><span class="fa fa-exclamation-circle"></span> <span class="xn-text">VEHICLE ID</span></a>
    </li -->
    <li class="{{ Request::segment(2) == 'settings' ? 'active': '' }}">
            <a href="{{ url('/admin/settings') }}"><i class="fas fa-file-check"></i> <span class="xn-text">SETTINGS</span></a>
    </li>

    <!-- li class=" xn-openable">
        <a href="{{ url('/admin/my-settings') }}"><span class="fa fa-book"></span> <span class="xn-users">MY SETTINGS </span></a>
        <ul>
            <li class=""><a href="{{ url('/admin/background-color') }}">Background color</a></li>
            <li class=""><a href="{{ url('/admin/pad-line-color') }}">Pad line color</a></li>
        </ul>
    </li -->
    
    <li class=" xn-openable {{ Request::segment(2) == 'view-vehicle' || Request::segment(2) == 'vehicle-info' || Request::segment(2) == 'vehicle' ? 'active': '' }}">
        <a href="{{ url('/admin/vehicle-info') }}"><i class="fa fa-car"></i> <span class="xn-text">VEHICLE</span></a>
        <ul>
            <li class="{{ Request::segment(2) == 'view-vehicle' ? 'active': '' }}"><a href="{{ url('/admin/view-vehicle') }}">View vehicle</a></li>
			<li class="{{ Request::segment(2) == 'vehicle' ? 'active': '' }}"><a href="{{ url('/admin/vehicle') }}">Add vehicle</a></li>
        </ul>
    </li>
    <li class="">
        <a href="{{ url('/admin/news-deals') }}"><i class="fa fa-camera-retro"></i><span class="xn-text">NEWS & DEALS</span></a>
    </li>
	
	<li class=" xn-openable {{ Request::segment(2) == 'users' || Request::segment(2) == 'view-profile' ? 'active': '' }}">
        <a href="javascript::void(0)"><i class="fa fa-user"></i> <span class="xn-text">User</span></a>
        <ul>
            <li class="{{ Request::segment(2) == 'users' && Request::segment(3) == 'create' ? 'active': '' }}"><a href="{{ url('/admin/users/create') }}">Add user</a></li>
            <li class="{{ Request::segment(2) == 'users' && Request::segment(3) != 'create' ? 'active': '' }}"><a href="{{ url('/admin/users') }}">View user</a></li>
            <li class="{{ Request::segment(2) == 'view-profile' ? 'active': '' }}"><a href="{{ url('/admin/view-profile') }}">View Profile</a></li>
        </ul>
    </li>
	
</ul>                <!-- END X-NAVIGATION -->
            </div>
            <!-- END PAGE SIDEBAR -->
            <!-- PAGE CONTENT -->
            <div class="page-content">
                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                   <!-- TOGGLE NAVIGATION -->
    <li class="xn-icon-button">
        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
    </li>
    <!-- END TOGGLE NAVIGATION -->
    <!-- SEARCH -->
    <!-- <li class="xn-search">
        <form role="form">
            <input type="text" name="search" placeholder="Search..."/>
        </form>
    </li>    -->
    <!-- END SEARCH -->
    <!-- SIGN OUT -->
    <li class="xn-icon-button pull-right">
         <a  href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
		 <span class="fa fa-sign-out"></span></a>       
		 <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
			{{ csrf_field() }}
		</form>	 	
    </li> 
    <!-- END SIGN OUT -->                    </ul>
                <!-- END X-NAVIGATION VERTICAL --> 
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
<li class="active">Dashboard</li>
                </ul>
                <!-- END BREADCRUMB -->                       
                
                 <!-- PAGE TITLE -->
                <div class="page-title">                    
                                    </div>
                <!-- END PAGE TITLE --> 

                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <!-- START ALERT BLOCKS -->


                        
<!-- END ALERT BLOCKS -->                    

				@yield('content')
			
	

                    
                </div>
                <!-- END PAGE CONTENT WRAPPER -->                                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

        <!-- MESSAGE BOX-->
                <!-- END MESSAGE BOX-->

        <!-- START PRELOADS -->
                <!-- END PRELOADS -->                  
        
    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->


<script type="text/javascript" src="{{ url('/public/assets/jquery/jquery/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ url('/public/assets/jquery/jquery-ui/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="https://ebookbazaar.com/assets/backend/js/plugins/bootstrap/bootstrap.min.js"></script>

<script type='text/javascript' src="{{ url('/public/assets/jquery/jquery.dataTables.min.js') }}"></script>        
<script type='text/javascript' src="{{ url('/public/assets/jquery/bootstrap-datepicker.js') }}"></script> 
<script type='text/javascript' src="{{ url('/public/assets/jquery/bootstrap-select.js') }}"></script>

<script type='text/javascript' src="{{ url('/public/assets/jquery/bootstrap-timepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ url('/public/assets/jquery/plugins.js') }}"></script> 
<script type="text/javascript" src="{{ url('/public/assets/jquery/actions.js') }}"></script>
<script type="text/javascript" src="{{ url('/public/assets/jquery/custom.js') }}"></script>
<script type="text/javascript" src="{{ url('/public/assets/jquery/jquery.toaster.js') }}"></script>

@yield('script')
	<script>
				 // $(document).ready(function () {
					 // $('#hide_image_for_test').hide();
				 // })
				
							// function data_target_removeUser()
							// {
							// $(".popup-overlay, .popup-content").removeClass("active");
							// }
				
	</script>
	
<!-- Required for autocomplete -->


<!-- END TEMPLATE -->


    <!-- END SCRIPTS -->    
        
</body>
</html>
