<?php
session_start();
$loggedIn = isset($_SESSION["username"]);
if (!$loggedIn) {
	header("Location: /login.php");
	exit;
} else {
?>

<!DOCTYPE html>
<html>
	<head>
		<title>ALL YOUR HOME ARE BELONG TO US</title>
		<?php include("{$_SERVER['DOCUMENT_ROOT']}/includes/head.php") ?>
	</head>
	<body>
		<div class="full-size center-contents">
			<h1>Welcome Home.</h1>
			<a href="logout.php">Log out</a>
		</div>
	</body>
</html>
<?php } ?>