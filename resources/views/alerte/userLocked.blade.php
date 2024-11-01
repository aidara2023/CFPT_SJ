<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<meta name="description" content="Responsive Admin Template" />
	<meta name="author" content="RedstarHospital" />
	<title>Smart University | Bootstrap Responsive Admin Template</title>
	<!-- google font -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
		type="text/css" />
	<!-- icons -->
	<link rel="stylesheet" href="/assets/plugins/iconic/css/material-design-iconic-font.min.css">
	<!-- bootstrap -->
	<link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<!-- Theme Styles -->
	<link href="/assets/css/theme/light/theme_style.css" rel="stylesheet" id="rt_style_components" type="text/css" />
	<!-- style -->
	<link rel="stylesheet" href="/assets/css/pages/login.css">
	<!-- favicon -->
	<link rel="shortcut icon" href="/assets/img/favicon.ico" />
</head>

<body>
	<div class="main">
		<!-- Sing in  Form -->
		<section class="sign-in">
			<div class="container">
				<div class="signin-content pb-5">
					<div class="signin-image">
						<figure><img src="{{ asset('/storage/' . Auth::user()->photo) }}" alt="sing up image"></figure>
					</div>
					<div class="signin-form">
						<h2 class="form-title">Compte {{ Auth::user()->nom }}  {{ Auth::user()->prenom }} Bloquer</h2>
						<p>Votre Compte à été bloqué veuillez vous approcher au près de l'administration pour avoir plus de détail.</p><br>
						<form class="register-form" id="login-form">
							<div class="form-group form-button">
								<a href="{{ route('logout') }}" class="btn btn-round btn-primary" name="home" id="home">Cliquer ici pour quitter</a>
							</div>
						</form>
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
</body>

</html>