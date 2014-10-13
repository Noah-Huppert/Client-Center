<html>
	<head>
		<title>Client Portal</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/portal.css" />
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-theme.min.css">
		<link href='http://fonts.googleapis.com/css?family=Sonsie+One|PT+Sans|Roboto+Condensed:700|Doppio+One' rel='stylesheet' type='text/css'>

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
		<script src="js/bootstrap/bootstrap.min.js"></script>
		<script src='js/transit/jquery.transit.min.js'></script>
		<script src="js/OAuth/jsOAuth-1.3.6.min.js" type="text/javascript"></script>
		<script src="js/evernote/evernote-sdk-minified.js" type="text/javascript"></script>

	</head>
	<body onload="load();">
		<?php
		header('Access-Control-Allow-Origin: *');
		// include the configs
		require_once ("./php/php-login/1-minimal/config/db.php");

		// load the login class
		require_once ("./php/php-login/1-minimal/classes/Login.php");

		// create a login object.
		$login = new Login();

		// ... ask if we are logged in here:
		if ($login -> isUserLoggedIn() == true) {
			// the user is logged in...
			include ("./php/php-login/1-minimal/views/logged_in.php");
			echo "<script>loggedLoad();</script>";
		} else {
			// the user is not logged in...
			include ("./php/php-login/1-minimal/views/not_logged_in.php");
		}
		?>
		<script>
			function load() {
				$('#loginForm').css({
					'margin-top' : ($(window).height() - $('#loginForm').height()) / 3
				});
			}
		</script>
		<?php
		include "/footer.html";
		?>
	</body>
</html>