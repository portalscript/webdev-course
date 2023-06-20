<!DOCTYPE html>
<html>
	<head>
		<title>ALL YOUR HOME ARE BELONG TO US</title>
		<?php include("{$_SERVER['DOCUMENT_ROOT']}/includes/head.php") ?>
	</head>
	<body>
		<div class="full-size">
			<?php include("{$_SERVER['DOCUMENT_ROOT']}/includes/navbar.php") ?>

			<div id="button-holder" class="container">
				<div class="mt-4">					
					<span>Clicks: <span id="num-clicks">0</span></span>
					<button class="btn btn-danger">DO THE THING</button>
				</div>
				<div class="mt-4">
					<span>Clicks: <span id="num-clicks">0</span></span>
					<button class="btn btn-danger">DO THE THING</button>
				</div>
				<div class="mt-4">
					<span>Clicks: <span id="num-clicks">0</span></span>
					<button class="btn btn-danger">DO THE THING</button>
				</div>
			</div>
		</div>
		<script src="/script.js"></script>
	</body>
</html>