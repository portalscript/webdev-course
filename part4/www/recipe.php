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
            <?php include("{$_SERVER['DOCUMENT_ROOT']}/includes/navbar.php") ?>
            <div class="container">
                <?php if (isset($recipe['image'])) {?>
                    <div class="mb-5">
                        <img src="<?php echo $recipe['image'] ?>" class="img-fluid" />
                    </div>
                <?php } ?>
                <a href="#ingredients"><h5 id="ingredients">Ingredients</h5></a>
                <table class="table table-hover mb-5">
                    <tbody>
                        <?php
                    foreach ($ingredients as $ingredient) {
                        echo "
                        <tr>
                        <td>{$ingredient['quantity']} {$ingredient['unit']} of {$ingredient['name']}</td>
                        </tr>
                        ";
                    }
                    ?>
                    </tbody>
                </table>
                <a href="#steps"><h5 id="steps">Steps</h5></a>
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
		</div>
	</body>
</html>
<?php } ?>