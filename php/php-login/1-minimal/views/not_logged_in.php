<!-- errors & messages --->
<?php

// show negative messages
if ($login->errors) {
    foreach ($login->errors as $error) {
        echo $error;    
    }
}

// show positive messages
if ($login->messages) {
    foreach ($login->messages as $message) {
        echo $message;
    }
}

?>
<!-- errors & messages --->

<!-- login form box -->
<div id="loginForm">
	<div id="formTitle">
		Client Portal Login
	</div>
	<form method="post" action="portal.php" name="loginform">
	
		<div class="input-group">
	   		<label for="login_input_username">Username:</label>
	    	<input id="login_input_username" class="login_input form-control" type="text" name="user_name" required />
	    </div>
	
		<div class="input-group">
		    <label for="login_input_password">Password:</label>
		    <input id="login_input_password" class="login_input form-control" type="password" name="user_password" autocomplete="off" required />
	    </div>
	
	    <input id="login" type="submit"  name="login" value="Log in" />
	
	</form>
</div>