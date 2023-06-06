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
				<span>Clicks: <span id="num-clicks">0</span></span>
				<button onclick="doTheThing(event)">DO THE THING</button>
			</div>
		</div>
		<script src="/script.js"></script>
	</body>
</html>