<?php
session_start();
$loggedIn = isset($_SESSION["username"]);
if (!$loggedIn) {
	header("Location: /login.php");
	exit;
} else {
	include_once("{$_SERVER['DOCUMENT_ROOT']}/includes/connect.php");
	$mysqli = openDB();
	$results = $mysqli->query("SELECT * FROM recipes WHERE owner = \"{$_SESSION["username"]}\"");
?>

<!DOCTYPE html>
<html>
	<head>
		<title>ALL YOUR HOME ARE BELONG TO US</title>
		<?php include("{$_SERVER['DOCUMENT_ROOT']}/includes/head.php") ?>
	</head>
	<body>
		<div class="full-size">
			<h1>Recipes</h1>
			<div>
			<?php
				while($row = $results->fetch_assoc()) {

					echo "
						<div>
							<h4>{$row['name']}</h4>
							<p>{$row['description']}</p>
							<a href='/recipe.php?r={$row['id']}'>View</a>
						</div>
					";
    			}
			?>
			</div>
			<a href="logout.php">Log out</a>
		</div>
	</body>
</html>
<?php } ?>