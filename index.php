
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Awaiken Theme">
    <meta name='robots' content='noindex,nofollow' />
	<!-- Page Title -->
	<title>Ghazi1984 - Under Maintenance</title>
	<!-- Google Fonts css-->
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700" rel="stylesheet">
	<!-- Bootstrap css -->
	<link href="https://demo.awaikenthemes.com/html-preview/launch-under-maintenance-html-template/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<!-- Font Awesome icon css-->
	<link href="https://demo.awaikenthemes.com/html-preview/launch-under-maintenance-html-template/css/font-awesome.min.css" rel="stylesheet" media="screen">
	<!-- Main custom css -->
	<link href="css/custom.css" rel="stylesheet" media="screen">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	
	<!-- Coming Soon Wrapper starts -->
	<div class="comming-soon">
		
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="coming-soon-box">
						<!-- Logo Start -->
						<div class="logo">
						    <img src="ghazi.jpg" width="80px" />
						
						</div>
						<!-- Logo end -->
						
						<!-- Types Information start -->
						<div class="coming-text">
							<p>Keep calm, we are</p>
							<h2><span class="typed-title">Under Maintaince </span></h2>
							<div class="typing-title">
								<p>Under Maintaince</p>
								<p>Awesome is Coming Soon</p>
							</div>
						</div>
						<!-- Types Information end -->
						
						<!-- Countdown start -->
						<div class="countdown-timer-wrapper">
							<div class="timer" id="countdown"></div>
						</div>
						<!-- Countdown end -->
						
						<!-- Newsletter Form start -->
						<div class="newsletter">
							<p>The future has a way of arriving unannounced.</p>
							
							<div class="newsletter-form">
								<form action="#" method="post">
									<input type="text" class="new-text" placeholder="Enter your email address...." required />
									<button type="submit" class="new-btn">Notify Me</button>
								</form>
							</div>
						</div>
						<!-- Newsletter Form end -->
						
						<!-- Social Media start -->
						<div class="social-link">
							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-twitter"></i></a>
							<a href="#"><i class="fa fa-linkedin"></i></a>
							<a href="#"><i class="fa fa-pinterest"></i></a>
							<a href="#"><i class="fa fa-instagram"></i></a>
						</div>
						<!-- Social Media end -->	
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Coming Soon Wrapper end -->
	
    <!-- Jquery Library File -->
	<script src="https://demo.awaikenthemes.com/html-preview/launch-under-maintenance-html-template/js/jquery-1.12.4.min.js"></script>
	<!-- Timer counter js file -->
	<script src="https://demo.awaikenthemes.com/html-preview/launch-under-maintenance-html-template/js/countdown-timer.js"></script>
	<!-- Typed js file -->
	<script src="https://demo.awaikenthemes.com/html-preview/launch-under-maintenance-html-template/js/typed.js"></script>
	<!-- SmoothScroll -->
	<script src="https://demo.awaikenthemes.com/html-preview/launch-under-maintenance-html-template/js/SmoothScroll.js"></script>
    <!-- Bootstrap js file -->
	<script src="https://demo.awaikenthemes.com/html-preview/launch-under-maintenance-html-template/js/bootstrap.min.js"></script>
    <!-- Main Custom js file -->
	<script src="https://demo.awaikenthemes.com/html-preview/launch-under-maintenance-html-template/js/function.js"></script>
	<!-- Timer counter start -->
	<script>
        $(document).ready(function (){
			//var myDate = new Date("08/04/2019");
			var myDate = new Date();
			myDate.setDate(myDate.getDate() + 2);
            $("#countdown").countdown(myDate, function (event) {
                $(this).html(
                    event.strftime(
                        '<div class="timer-wrapper"><div class="time">%D</div><span class="text">Days</span></div><div class="timer-wrapper"><div class="time">%H</div><span class="text">Hours</span></div><div class="timer-wrapper"><div class="time">%M</div><span class="text">Minutes</span></div><div class="timer-wrapper"><div class="time">%S</div><span class="text">Seconds</span></div>'
                    )
                );
            });

        });
    </script>
	<!-- Timer counter end -->
	 <!-- GetButton.io widget -->
<script type="text/javascript">
    (function () {
        var options = {
            whatsapp: "+923099026655", // WhatsApp number
            call_to_action: "Message us", // Call to action
            position: "left", // Position may be 'right' or 'left'
        };
        var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
<!-- /GetButton.io widget -->
	
	
</body>
</html>