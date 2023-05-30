<?php
session_start();

// If we're logged in, go to home page
$loggedIn = isset($_SESSION["username"]);
if ($loggedIn) {
	header("Location: /");
	exit;
}

// Check if the request contains a username and password
if (isset($_POST["username"]) && isset($_POST["password"])) {
	include_once("{$_SERVER['DOCUMENT_ROOT']}/includes/connect.php");
	$mysqli = openDB();
	// We should be afraid of Little Bobby Tables...
	$result = $mysqli->query("SELECT * FROM users WHERE username = \"{$_POST["username"]}\";");
	// If no user found, show missingUsername error
	if (!$result || $result->num_rows != 1) {
		header("Location: /login.php?error=missingUsername");
		exit;
	}

	$user = $result->fetch_assoc();
	$valid_password = password_verify($_POST["password"], $user["passhash"]);
	if (!$valid_password) {
		header("Location: /login.php?error=invalidPassword");
		exit;
	}

	$_SESSION["username"] = $user["username"];

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
				<h3>Please log in</h3>
				<form method="POST" action="/login.php">
					<label class="input-group">
						Username
						<input name="username" required />
					</label>
					<label class="input-group">
						Password
						<input name="password" type="password" required />
					</label>
					
					<button type="submit">Login</button>
				</form>
				<p>Don't have an account?
					<br>
					<a href="/signup.php">Sign up here</a>
				</p>
			</div>
		</div>
	</body>
</html>
<?php } ?>