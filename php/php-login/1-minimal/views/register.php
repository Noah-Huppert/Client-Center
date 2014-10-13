 <!-- errors & messages --->
<?php

// show negative messages
if ($registration->errors) {
    foreach ($registration->errors as $error) {
        echo $error;    
    }
}

// show positive messages
if ($registration->messages) {
    foreach ($registration->messages as $message) {
        echo $message;
    }
}

?>
<!-- errors & messages --->

<!-- register form -->
<form method="post" action="./php/php-login/1-minimal/register.php" name="registerform">   
    
    <label>Project Name</label>  
    <div class="input-group">  
    	<input id="projectName" class="form-control" type="text" name="project_name" required />
    </div>
    
    <!-- the user name input field uses a HTML5 pattern check -->
    <label for="login_input_username">Username</label>
    <div class="input-group">
    	<input id="login_input_username" class="login_input form-control" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required />
    	<span class="input-group-addon">
			<span style="cursor: pointer;" id="webDevButton" class="glyphicon glyphicon-question-sign" data-help="usernameHelp"></span>
		</span>
    </div>
    <div class="help" id="usernameHelp">
    	Only letters and numbers, 2 to 64 characters
    </div>
    
    <!-- the email input field uses a HTML5 email type check -->
    <label for="login_input_email">User's email</label>  
    <div class="input-group">  
    	<input id="login_input_email" class="login_input form-control" type="email" name="user_email" required />
    </div>
    
    <label for="login_input_password_new">Password</label>
    <div class="input-group">
    	<input id="login_input_password_new" class="login_input form-control" type="text" name="user_password_new" pattern=".{6,}" required autocomplete="off" />
    	<span class="input-group-addon">
			<span style="cursor: pointer;" id="webDevButton" class="glyphicon glyphicon-question-sign" data-help="passwordHelp"></span>
		</span>
    </div>
     <div class="help" id="passwordHelp">
    	Min. 6 characters
    </div>
    
  	<label for="login_input_password_new">Repeat Password</label>
    <div class="input-group">
    	<input id="login_input_password_repeat" class="login_input form-control" type="text" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
    </div>
    
   <!-- <label for="login_input_password_repeat">Repeat password</label>
    <input id="login_input_password_repeat" class="login_input" type="text" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />   -->     
    <input id="submit" type="submit"  name="register" value="Register" />
    
</form>

<script>
	$('.glyphicon-question-sign').click(function(){
		$('#' + $(this).attr('data-help')).toggle('slide');
	});
</script>