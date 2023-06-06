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
			<div class="card">
				<div class="card-body">
					<h5 class="card-title mb-3">Please sign up</h5>
					<form method="POST" action="/signup.php">
						<div class="mb-3">
							<label for="firstname" class="form-label">First Name</label>
							<input type="text" class="form-control" id="firstname" name="firstname" required>
						</div>
						<div class="mb-3">
							<label for="lastname" class="form-label">Last Name</label>
							<input type="text" class="form-control" id="lastname" name="lastname" required>
						</div>
						<div class="mb-3">
							<label for="username" class="form-label">Username</label>
							<input type="text" class="form-control" id="username" name="username" required>
						</div>
						<div class="mb-4">
							<label for="password" class="form-label">Password</label>
							<input type="password" class="form-control" id="password" name="password" required>
						</div>
						<div class="mb-4">
							<label for="password-confirmation" class="form-label">Confirm Password</label>
							<input type="password" class="form-control" id="password-confirmation" name="password-confirmation" required>
						</div>
						<div class="mb-4 d-grid">
							<button type="submit" class="btn btn-primary">Signup</button>
						</div>
					</form>
					<span class="card-link">Already have an account?<br /> <a href="/login.php" >Log in here</a></span>
					
				</div>
			</div>
		</div>
	</body>
</html>
<?php } ?>