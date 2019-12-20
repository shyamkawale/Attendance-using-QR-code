
<?php
session_start();

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'attendance');

// variable declaration
$full_name = "";
$username = "";
$roll_no   = "";
$email    = "";
$mob_no   = "";
$errors   = array();

// call the register() function if register_btn is clicked
if (isset($_POST['register_btn'])) {
	register();
}

// REGISTER USER
function register(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $full_name, $username,$roll_no, $email, $mob_no;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$full_name   =  e($_POST['full_name']);
	$username    =  e($_POST['username']);
	$roll_no     =  e($_POST['roll_no']);
	$email       =  e($_POST['email']);
	$mob_no      =  e($_POST['mob_no']);
	$password_1  =  e($_POST['password_1']);
	$password_2  =  e($_POST['password_2']);

	// form validation: ensure that the form is correctly filled
	if (empty($full_name)) {
		array_push($errors, "fullname is required");
	}
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($roll_no)) {
		array_push($errors, "roll number is required");
	}
	if (empty($email)) {
		array_push($errors, "Email is required");
	}
	if (empty($mob_no)) {
		array_push($errors, "mobile number is required");
	}
	if (empty($password_1)) {
		array_push($errors, "Password is required");
	}
	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = md5($password_1);//encrypt the password before saving in the database

		if (isset($_POST['usertype'])) {
			$usertype = e($_POST['usertype']);
      //$query = "INSERT INTO `multi_login`(`username`, `email`, `usertype`, `password`)
      //    VALUES ('$username', '$email', '$user_type', '$password')";
			$query = "INSERT INTO `attendance`(`full_name`, `username`, `roll_no`, `email`, `mob_no`, `usertype`, `password`)
			       VALUES ('$full_name','$username','$roll_no','$email','mob_no', '$usertype','$password')";
			mysqli_query($db, $query);
			$_SESSION['success']  = "New user successfully created!!";
			header('location: login.php');
		}
		else{
      //$query = "INSERT INTO `multi_login`(`username`, `email`, `user_type`, `password`)
        //    VALUES ('$username', '$email', 'user', '$password')";
				$query = "INSERT INTO `attendance`(`full_name`, `username`, `roll_no`, `email`, `mob_no`, `usertype`, `password`)
				       VALUES ('$full_name','$username','$roll_no','$email','$mob_no', '$usertype','$password')";
			mysqli_query($db, $query);

			// get id of the created user
			$logged_in_user_id = mysqli_insert_id($db);

			$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
			$_SESSION['success']  = "You are now logged in";
			header('location: index1.php');
		}
	}
}

// return user array from their id
function getUserById($id){
	global $db;
	$query = "SELECT * FROM `attendance` WHERE id=" . $id;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}

// escape string
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}

function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}

// log user out if logout button clicked
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.php");
}
if (isset($_POST['login_btn'])) {
	login();
}

// LOGIN USER
function login(){
	global $db, $username, $errors;

	// grap form values
	$username = e($_POST['username']);
	$password = e($_POST['password']);

	// make sure form is filled properly
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT * FROM `attendance` WHERE username='$username' AND password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) { // user found
			// check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);
			if ($logged_in_user['usertype'] == 'admin') {

				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";
				header('location: home.php');
			}
			else{
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";

				header('location: index1.php');
			}
		}
		else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}

function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['usertype'] == 'admin' ) {
		return true;
	}else{
		return false;
	}
}


?>
