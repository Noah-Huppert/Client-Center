<!DOCTYPE HTML>
<html>
	<head>
		<title>Submited</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
	</head>
	<body>
		<div id="error" style="display: none; color: #e74c3c; width: 400px; margin: auto; margin-top: 100px; font-size: 24px;">
			<strong>Please fill out all mandatory fields</strong>
			<div style="font-size: 16px; opacity: 0.5; color: #000000;">
				Marked by a red *
				<br>
				<br>
				redirecting back to form...
			</div>
			<script>
				setTimeout(function () {
					//window.history.back();
				}, 2000);
			</script>
		</div>
		<div id="complete" style="width: 400px; margin: auto; margin-top: 100px; font-size: 24px;">
			<strong>Thank you.<br>Your request has been sent. Expect a response in no more than 3 business days.</strong>
		</div>
		<?php
			if(strlen($_GET['firstName']) <= 0 || strlen($_GET['lastName']) <= 0 || strlen($_GET['email']) <= 0 || strlen($_GET['phone']) <= 0 
			|| strlen($_GET['portalPass']) <= 0 || strlen($_GET['otherStuff']) <= 0 ){
				echo "<script>$('#error').show();$('#complete').hide();</script>";
			} else{
				global $message;
				$getVariables = $_GET;
				$counter = 0;
				foreach($getVariables as $key => $arrayValue){
					$message .= $key . ": " . $arrayValue . PHP_EOL;
				}
				//mail('noahhuppert@gmail.com', 'New Client: ' . $_GET['firstName'] . " " . $_GET['lastName'], $message);
				echo "<script>window.history.back();</script>";
			}
		?>
	</body>
</html>