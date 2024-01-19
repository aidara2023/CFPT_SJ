<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<meta name="description" content="Responsive Admin Template" />
	<meta name="author" content="RedstarHospital" />
	<title>CFPT digital</title>
    @vite('resources/js/app.js')
	<!-- google font -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
		type="text/css" />
	<!-- icons -->
	<link rel="stylesheet" href="/assets/plugins/iconic/css/material-design-iconic-font.min.css">
    <!-- Jquery Toast css -->
	<link rel="stylesheet" href="/assets/plugins/jquery-toast/dist/jquery.toast.min.css">
	<!-- bootstrap -->
	<link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<!-- Theme Styles -->
	<link href="/assets/css/theme/light/theme_style.css" rel="stylesheet" id="rt_style_components" type="text/css" />
	<!-- style -->
	<link rel="stylesheet" href="/assets/css/pages/login.css">
	<!-- favicon -->
	<link rel="shortcut icon" href="/assets/img/logoCFPT--clr" />
</head>

<body>
	<div class="main" id="app">
		<!-- Sing in  Form -->
		<section class="sign-in">
			<div class="container">
				<div class="signin-content">
					<div class="signin-image">
						<figure><img src="/assets/img/pages/signin.jpg" alt="sing up image"></figure>
						<a href="sign_up.html" class="signup-image-link">Create an account</a>
					</div>
					<div class="signin-form">
						<h2 class="form-title">Connexion</h2>
						<user-login></user-login>
						<div class="social-login">
							<span class="social-label">Or login with</span>
							<ul class="socials">
								<li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
								<li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
								<li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

	<!-- start js include path -->
	<script src="/assets/plugins/jquery/jquery.min.js"></script>
	<!-- bootstrap -->
	<script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!-- end js include path -->
    <!-- notifications -->
	<script src="/assets/plugins/jquery-toast/dist/jquery.toast.min.js"></script>
	<script src="/assets/plugins/jquery-toast/dist/toast.js"></script>
</body>

</html>