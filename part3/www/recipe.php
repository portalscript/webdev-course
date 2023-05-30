<?php
session_start();
$loggedIn = isset($_SESSION["username"]);
if (!$loggedIn) {
	header("Location: /login.php");
	exit;
} else {
	include_once("{$_SERVER['DOCUMENT_ROOT']}/includes/connect.php");
	$mysqli = openDB();
	$results = $mysqli->query("SELECT * FROM recipes WHERE owner = \"{$_SESSION["username"]}\" AND id = {$_GET["r"]};");
    $recipe = $results->fetch_assoc();
	$results = $mysqli->query("SELECT * FROM steps WHERE recipe_id = {$_GET["r"]} ORDER BY num ASC;");
    $steps = [];
    while ($row = $results->fetch_assoc()) {
        $steps[] = $row;
    }
    

	$results = $mysqli->query("SELECT * FROM ingredients WHERE recipe_id = {$_GET["r"]};");
    $ingredients = [];
    while ($row = $results->fetch_assoc()) {
        $ingredients[] = $row;
    }
    
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $recipe['name']; ?></title>
		<?php include("{$_SERVER['DOCUMENT_ROOT']}/includes/head.php") ?>
	</head>
	<body>
		<div class="full-size">
			<h1>How to make <?php echo $recipe['name']; ?>!!!</h1>
            <h2>Ingredients</h2>
            <ul>
                <?php
                foreach ($ingredients as $ingredient) {
                    echo "<li>{$ingredient['quantity']} {$ingredient['unit']} of {$ingredient['name']}</li>\n";
                }
                ?>
            </ul>
            <h2>Steps</h2>
            <ol>
                <?php
                foreach ($steps as $step) {
                    echo "<li>
                        {$step['name']}
                        <ul>
                            <li>{$step['description']}</li>
                        </ul>
                        </li>\n";
                }
                ?>                
            </ol>
		</div>
	</body>
</html>
<?php } ?>