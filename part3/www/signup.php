<?php
session_start();

// If we're logged in, go to home page
$loggedIn = isset($_SESSION["username"]);
if ($loggedIn) {
	header("Location: /");
	exit;
}

// Check if the request contains a username and password
if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["password-confirmation"])) {
	include_once("{$_SERVER['DOCUMENT_ROOT']}/includes/connect.php");
	$mysqli = openDB();
	// We should be afraid of Little Bobby Tables...
	$query = "SELECT * FROM users WHERE username = \"{$_POST["username"]}\";";
	$result = $mysqli->query($query);
	// If no user found, show error
	if ($result && $result->num_rows != 0) {
		header("Location: /signup.php?error=usernameExists");
		exit;
	}

	// If password doesn't match password confirmation, show error
	if ($_POST["password"] != $_POST["password-confirmation"]) {
		header("Location: /signup.php?error=passwordsDoNotMatch");
		exit;
	}

	
	$username = $_POST["username"];
	$passHash = password_hash($_POST["password"], PASSWORD_DEFAULT);
	$firstName = $_POST["firstname"];
	$lastName = $_POST["lastname"];
	
	$insertQuery = "INSERT INTO users (username, passhash, first_name, last_name) VALUES(\"$username\", \"$passHash\", \"$firstName\", \"$lastName\");";
	$mysqli->execute_query($insertQuery);

	$_SESSION["username"] = $username;

	header("Location: /");

} else {
?>
<!DOCTYPE html>
<html>
	<head>
		<title>LOGIN PAGE</title>
		<?php include("{$_SERVER['DOCUMENT_ROOT']}/includes/head.php") ?>
	</head>
	<body>
		<div class="full-size center-contents">
			<div class="login-container">
				<h3>Please sign up</h3>
				<form method="POST" action="/signup.php">
					<label class="input-group">
						First Name
						<input name="firstname" required />
					</label>
					<label class="input-group">
						Last Name
						<input name="lastname" required />
					</label>
					<label class="input-group">
						Username
						<input name="username" required />
					</label>
					<label class="input-group">
						Password
						<input name="password" type="password" required />
					</label>
					<label class="input-group">
						Confirm Password
						<input name="password-confirmation" type="password" required />
					</label>
					
					<button type="submit">Login</button>
				</form>
				<p>Already have an account?
					<br>
					<a href="/login.php">Log in here</a>
				</p>
			</div>
		</div>
	</body>
</html>
<?php } ?>