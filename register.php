<?php
  include('functions.php')
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h3>registration</h3>
<div class="header">
  <h1>Register</h1>
  <img src="regp.jpg">
</div>
<form method="post" action="register.php">
  <?php echo display_error(); ?>
  <div class="input-group">
		<label>full_name</label>
		<input type="text" name="full_name" value="<?php echo $full_name; ?>">
	</div>
	<div class="input-group">
		<label>username</label>
		<input type="text" name="username" value="<?php echo $username; ?>">
	</div>
  <div class="input-group">
		<label>roll_no</label>
		<input type="text" name="roll_no" value="<?php echo $roll_no; ?>">
	</div>
	<div class="input-group">
		<label>email</label>
		<input type="email" name="email" value="<?php echo $email; ?>">
	</div>
  <div class="input-group">
		<label>mob_no</label>
		<input type="text" name="mob_no" value="<?php echo $mob_no; ?>">
	</div>
	<div class="input-group">
		<label>password</label>
		<input type="password" name="password_1">
	</div>
	<div class="input-group">
		<label>Confirm password</label>
		<input type="password" name="password_2">
	</div>
  <div class="input-group">
		<label>user type</label>
		<input type="usertype" name="usertype">
	</div>
	<div class="input-group">
		<button type="submit" class="btn" name="register_btn">Register</button>
	</div>
	<p>
		Already a member? <a href="login.php">Sign in</a>
	</p>
</form>
</body>
</html>
