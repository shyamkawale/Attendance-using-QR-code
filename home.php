<?php
include('functions.php');


if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.php");
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style>
	.header {
		background: #003366;
	}
	button[name=register_btn] {
		background: #003366;
	}
	</style>
</head>
<body>
  <h3>home</h3>
	<div class="header">
		<h2>Admin - Home Page</h2>
	</div>
	<div class="content">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php
						echo $_SESSION['success'];
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>

		<!-- logged in user information -->
		<div class="profile_info">
			<img src="user_pic.png"  >

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['usertype']); ?>)</i>
						<br>
						<a href="index.php?logout='1'" style="color: red;">logout</a>
                       &nbsp; <a href="create_user.php"> + add user</a>
					</small>

				<?php endif ?>
			</div>
		</div>
	</div>
</body>

<br>
<form action="home.php" method="post">
<h2>Select Subject </h2>
<br>
<select name="Color">
<option value="maths">maths</option>
<option value="science">science</option>
</select>
<input type="submit" name="submit" value="SET ATTENDANCE" />
</form>
<?php

if(isset($_POST['submit'])){
$selected_val = $_POST['Color'];  // Storing Selected Value In Variable

if($selected_val=="maths"){
	//$query="UPDATE `attendance` SET maths_total = maths_total + 1";
	$query = "UPDATE attendance SET maths_total=maths_total+1";
	mysqli_query($db,$query);
}
else {
	echo "hi science";
	$query = "UPDATE attendance SET science_total=science_total+1";
	mysqli_query($db,$query);

}
echo "<br>";
echo "You have selected :" .$selected_val;  // Displaying Selected Value
}
?>


<br>
<br>
<h4>Click here to generate QR code: <a href="QR_code.php">QR Code</a> </h4>
</form>

</html>
