
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="https://ebookbazaar.com/images/icon.png">
<title> Login for Punjabi Books | eBookBazaar</title>
 
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
	
<meta name="csrf-token" content="Avh8FPmkUJvtarv0v2fmcgZX1TzI6Uov2GtFqLcy">
<!-- Stylesheets -->
<link href="https://ebookbazaar.com/style/bootstrap.min.css" rel="stylesheet"><!-- Bootstrap core CSS -->
<link href="https://ebookbazaar.com/style/font-awesome.min.css" rel="stylesheet"><!-- font-awesome Bootstrap core CSS -->
<link href="https://ebookbazaar.com/style/style.css" rel="stylesheet"><!-- Custom CSS -->
<link href="https://ebookbazaar.com/style/responsive.css" rel="stylesheet"><!-- Custom responsive CSS --> 


<link href="https://ebookbazaar.com/style/custom/font-awesome.min.css" rel="stylesheet"><!-- Custom responsive CSS --> 
<link href="https://ebookbazaar.com/style/custom/animate.min.css" rel="stylesheet"><!-- Custom responsive CSS --> 
<link rel="stylesheet" type="text/css" href="https://ebookbazaar.com/css/toastr.css">
	
<!-- Favicon and Apple Icons -->
<link rel="shortcut icon" href="https://ebookbazaar.com/img/favicon.png">
</head>
				<body class='login_blade_template'>
				
			<div class="hide_show"><i class="fa fa-cog" aria-hidden="true"></i></div>
<section class="login_panel">	

<div class="col-xs-12 col-sm-12 wh_login_right">	
<div class="login_details">			
<h1>Login for Punjabi Books</h1>			
<div class="login_innerdetails">				
<form class="form-horizontal" role="form" method="POST" action="https://ebookbazaar.com/login">                         
<input type="hidden" name="redirect" value="">
<input type="hidden" name="_token" value="Avh8FPmkUJvtarv0v2fmcgZX1TzI6Uov2GtFqLcy">                        
<div class="form-group input-group padd">							
<span class="input-group-addon"><img src="https://ebookbazaar.com/images/email1.png"></span>                            
<input id="email" placeholder="Email" class="form-control" name="email" value="" required="" autofocus="" type="email">
							                        
							</div>                       
							<div class="form-group input-group padd">					
							<span class="input-group-addon"><img src="https://ebookbazaar.com/images/lock1.png"></span>                            
							<input id="password" placeholder="Password" class="form-control" name="password" required="" type="password">							
							                        
							</div>                        
							<div class="form-group padd">                             
							<div class="col-sm-12 col-xs-12 padding_0 remeber_me">								
							<div class="checkbox">                                    
							<label>                                        
							<input class="wh_check" name="remember"  type="checkbox">  <span class="checkmark"></span>Remember Me                                    
							</label>                                
							</div>							
							</div>														
							</div>                        
							<div class="form-group text-center">                            
							<button type="submit" class="hvr-sweep-to-right-bgcolor">Sign in</button>
							</div>	
                            <div class="col-sm-12 col-xs-12 padding_0 forget_pass">								 
							<a class="btn btn-link " href="https://ebookbazaar.com/password/reset">Forgot Your Password?</a>							
							</div>							
							</form>
							</div></div>
		</div>
</section><!--/login_panel-->



<!-- JavaScript -->
<script src="https://ebookbazaar.com/js/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://ebookbazaar.com/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="https://purtuga.github.io/jquery.stickOnScroll/src/jquery.stickOnScroll.js"></script>
<script type="text/javascript" src="https://ebookbazaar.com/js/validator.js"></script>
<script type="text/javascript" src="https://ebookbazaar.com/js/sliderjs.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>



  <script>
  </script>



<script>
function showonlyone(thechosenone) {
		 $('.step_process').each(function(index) {
			  if ($(this).attr("id") == thechosenone) {
				   $(this).show();
			  }
			  else {
				   $(this).hide();
			  }
		 });
	}
	
$(document).ready(function(){
	
	jQuery('#immeditprofile').validator();
	
	jQuery(".extra_menus").stickOnScroll({
		topOffset: jQuery(".header").outerHeight() - 30,
		setParentOnStick:   false,
		setWidthOnStick:    false
	});
	
	
	jQuery(".toggle").click(function(){
		jQuery(".header .responsive_dropdown").slideToggle("slow");
	});
	
	jQuery(".imm_click_cat").click(function(){
		jQuery("#imm_cat").val(jQuery(this).data("catid"));
		jQuery("#imm_search_form").submit();
	});
	
	
	$('.tab_section ul li').click(function() {
		$('.tab_section ul li.active').removeClass('active');
		$(this).closest('li').addClass('active');
	});
	
	jQuery(".hide_show").click(function(){
		jQuery(".right_content").toggleClass("width75");
		jQuery(".sidebar").toggleClass("sidebar_hide_show");
	});
	var minimized_elements = $('.imm_des');
	
	minimized_elements.each(function(){    
		var t = $(this).text();        
		if(t.length < 300) return;
		 
		$(this).html(
			t.slice(0,300)+'<span>... </span><a href="javascript:void(0)" class="more imm_readmore">Read More</a>'+
			'<span style="display:none;">'+ t.slice(300,t.length)+' <a href="javascript:void(0)" class="less imm_readmore">Less</a></span>'
		);
	}); 
	
	$('a.more', minimized_elements).click(function(event){
		event.preventDefault();
		$(this).hide().prev().hide();
		$(this).next().slideDown();        
	});
	
	$('a.less', minimized_elements).click(function(event){
		event.preventDefault();
		$(this).parent().hide().prev().show().prev().show();    
	});
	var minimized_elements = $('.imm_des_bio');
	minimized_elements.each(function(){    
		var t = $(this).text();        
		if(t.length < 600) return;
		 
		$(this).html(
			t.slice(0,600)+'<span>... </span><a href="javascript:void(0)" class="imm_more imm_readmore">Read More</a>'+
			'<span style="display:none;">'+ t.slice(600,t.length)+' <a href="javascript:void(0)" class="imm_less imm_readmore">Less</a></span>'
		);
		
	}); 
	
	$('a.imm_more', minimized_elements).click(function(event){
		event.preventDefault();
		$(this).hide().prev().hide();
		$(this).next().slideDown();        
	});
	
	$('a.imm_less', minimized_elements).click(function(event){
		event.preventDefault();
		$(this).parent().hide().prev().show().prev().show();    
	});
	
	var $star_rating = $('.rating .fa');

	var SetRatingStar = function() {
	  return $star_rating.each(function() {
		if (parseInt($(this).siblings('.imm_rating').val()) >= parseInt($(this).data('rating'))) {
		  return $(this).removeClass('fa-star-o').addClass('fa-star');
		} else {
		  return $(this).removeClass('fa-star').addClass('fa-star-o');
		}
	  });
	};
	
	var $star_ratings = $('.immclick.rating .fa');

	$star_ratings.on('click', function() {
	  $star_rating.siblings('.imm_rating').val($(this).data('rating'));
	  return SetRatingStar();
	});
	$(document).ready(function() {
		SetRatingStar();
	});
	$('a[href*="#"]')
	  // Remove links that don't actually link to anything
	  .not('[href="#"]')
	  .not('[href="#0"]')
	  .click(function(event) {
		// On-page links
		if (
		  location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
		  && 
		  location.hostname == this.hostname
		) {
		  // Figure out element to scroll to
		  var target = $(this.hash);
		  target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
		  // Does a scroll target exist?
		  if (target.length) {
			// Only prevent default if animation is actually gonna happen
			event.preventDefault();
			$('html, body').animate({
			  scrollTop: target.offset().top - (85+jQuery(".header").outerHeight())
			}, 1000, function() {
			  // Callback after animation
			  // Must change focus!
			  var $target = $(target);
			  $target.focus();
			  if ($target.is(":focus")) { // Checking if the target was focused
				return false;
			  } else {
				$target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
				$target.focus(); // Set focus again
			  };
			});
		  }
		}
	  });
});
$(window).scroll(function() {    
    var scroll = $(window).scrollTop();

    if (scroll >= 50) {
        $("body").addClass("slimHeader");
    } else {
        $("body").removeClass("slimHeader");
    }
});

	function sub_category_toggle_button()
	{
		$(".sidebox ul li .icon").click(function() {
		  $(this).next("ul.sub_category").slideToggle();
		  $(this).toggleClass("wk_icon");
		  $(this).parent(".sidebox ul li").toggleClass("active");
		});
	}
$(document).ready(function(){
	sub_category_toggle_button();
});
	
	
	
	
	
	/* JS for demo only */
var colors = ['1abc9c', '2c3e50', '2980b9', '7f8c8d', 'f1c40f', 'd35400', '27ae60'];

colors.each(function (color) {
  $$('.color-picker')[0].insert(
    '<div class="square" style="background: #' + color + '"></div>'
  );
});

$$('.color-picker')[0].on('click', '.square', function(event, square) {
  background = square.getStyle('background');
  $$('.custom-dropdown select').each(function (dropdown) {
    dropdown.setStyle({'background' : background});
  });
});

	
</script>
	 
<div class="a2a_kit a2a_kit_size_32 a2a_floating_style a2a_vertical_style" style="right:0px; top:150px;">
    <a class="a2a_button_facebook"></a>
    <a class="a2a_button_twitter"></a>
    <a class="a2a_button_google_plus"></a>
    <a class="a2a_button_pinterest"></a>
    <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
</div>

<script async src="https://static.addtoany.com/menu/page.js"></script>
  

	
</body>
</html>