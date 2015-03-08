<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Sign up Page</title>

</head>
<body>

<div id="container">
	<h1>Sign up</h1>
	
	<?php
	echo form_open('main/signup_validation');
	echo validation_errors();
	echo "<p>email:";
	echo form_input('email');
	echo "</p>";
	
	echo "<p>password:";
	echo form_password('password');
	echo "</p>";
	
	echo "<p>Confirm password:";
	echo form_password('cpassword');
	echo "</p>";
	
	echo "<p>";
	echo form_submit('signup_submit','Sign Up');
	echo "</p>";
	
	echo form_close();
	?>
	
	
	
	</div>
</body>
</html>
</html>