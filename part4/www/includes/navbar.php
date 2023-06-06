<nav class="navbar navbar-expand-lg bg-body-tertiary">
  	<div class="container-fluid">
		<a class="navbar-brand" href="/">Recipes</a>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<?php if (isset($recipe['name'])) { ?>
					<li class="nav-item">
						<a class="nav-link" href="#"><?php echo $recipe['name']?></a>
					</li>
				<?php } ?>
			</ul>
			<form class="d-flex" role="search" method="GET" action="/">
				<input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
				<button class="btn btn-outline-success" type="submit">Search</button>
			</form>
			<ul class="navbar-nav ms-3">
				<li class="nav-item">
					<a class="nav-link" href="/logout.php">Logout</a>
				</li>
			</ul>
		</div>
	</div>
</nav>