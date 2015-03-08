<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login Page</title>

</head>
<body>

<div id="container">
	<h1>Login</h1>
	
	<?php
	
	echo form_open('main/login_validation');
	echo validation_errors();
	echo "<p>email:";
	echo form_input('email');
	echo "</p>";
	
	echo "<p>password:";
	echo form_password('password');
	echo "</p>";
	
	echo "<p>";
	echo form_submit('login_submit','login');
	echo "</p>";
	
	echo form_close();
	?>
	
	<a href='<?php echo base_url()."main/signup"?>'>Sign Up</a>
	
	
	</div>
</body>
</html>