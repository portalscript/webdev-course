<?php
session_start();
$loggedIn = isset($_SESSION["username"]);
if (!$loggedIn) {
	header("Location: /login.php");
	exit;
} else {
	include_once("{$_SERVER['DOCUMENT_ROOT']}/includes/connect.php");
	$mysqli = openDB();
	$query = "SELECT * FROM recipes WHERE owner = \"{$_SESSION["username"]}\";";
	if (isset($_GET['search'])) {
		$query = "SELECT * FROM recipes WHERE owner = \"{$_SESSION["username"]}\" AND MATCH(name, description) AGAINST ('{$_GET['search']}' IN NATURAL LANGUAGE MODE);";
	}
	$results = $mysqli->query($query);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>ALL YOUR HOME ARE BELONG TO US</title>
		<?php include("{$_SERVER['DOCUMENT_ROOT']}/includes/head.php") ?>
	</head>
	<body>
		<div class="full-size">
			<?php include("{$_SERVER['DOCUMENT_ROOT']}/includes/navbar.php") ?>

			<div class="container">
			<?php
				while($row = $results->fetch_assoc()) {

					echo "
					<div class='card mt-4'>
					" . (isset($row["image"]) ? "<img src='{$row["image"]}' class='card-img-top'>" : "") . "
						<div class='card-body'>
							<h5 class='card-title'>{$row['name']}</h5>
							<p class='card-text'>{$row['description']}</p>
							<a href='/recipe.php?r={$row['id']}' class='btn btn-primary'>View</a>
						</div>
					</div>
					";
    			}
			?>
			</div>
		</div>
	</body>
</html>
<?php } ?>