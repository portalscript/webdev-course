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
			<div class="card">
				<div class="card-body">
					<h5 class="card-title mb-3">Please log in</h5>
					<form method="POST" action="/login.php">
						<div class="mb-3">
							<label for="username" class="form-label">Username</label>
							<input type="text" class="form-control" id="username" name="username" required>
						</div>
						<div class="mb-4">
							<label for="password" class="form-label">Password</label>
							<input type="password" class="form-control" id="password" name="password" required>
						</div>
						<div class="mb-4 d-grid">
							<button type="submit" class="btn btn-primary">Login</button>
						</div>
					</form>
					<span class="card-link">Don't have an account?<br /> <a href="/signup.php" >Sign up here</a></span>
					
				</div>
			</div>
		</div>
	</body>
</html>
<?php } ?>