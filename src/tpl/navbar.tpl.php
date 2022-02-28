<nav class="navbar navbar-expand-lg navbar-dark">
	<a class="navbar-brand" href="?">GameZone</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="px-1 nav-item
            <?php if(empty($_GET)):?>
                active
            <?php endif;?>
            ">
				<a class="nav-link" href="?">Game List</a>
			</li>
			<li class="px-1 nav-item
            <?php if(isset($_GET['action']) && $_GET['action'] === 'categories'):?>
                active
            <?php endif;?>
            ">
				<a class="nav-link" href="?action=categories">Categories</a>
			</li>
			<li class="px-1 nav-item
            <?php if(isset($_GET['action']) && $_GET['action'] === 'wishlist'):?>
                active
            <?php endif;?>
            ">
				<a class="nav-link" href="?action=wishlist">Wishlist</a>
			</li>
			<li class="px-1 nav-item
            <?php if(isset($_GET['action']) && $_GET['action'] === 'csv'):?>
                active
            <?php endif;?>
            ">
				<a class="nav-link" href="?action=csv">Import/Export</a>
			</li>
		</ul>
	</div>
</nav>