<head>
    <script src="/src/js/jquery-3.6.0.min.js"></script>
    <script src="/src/js/bootstrap.bundle.min.js"></script>
    <script src="/src/js/jquery.dataTables.min.js"></script>
    <script src="/src/js/dataTables.bootstrap4.min.js"></script>
    <script src="/src/js/all.min.js"></script>
	<script src="/src/js/Category.js"></script>
	<script src="/src/js/Game.js"></script>
	<script src="/src/js/RequestData.js"></script>
	<script src="/src/js/custom.js"></script>

    <link href="/src/css/bootstrap.min.css" rel="stylesheet">
    <link href="/src/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/src/css/custom.css" rel="stylesheet">

	<title></title>

</head>


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
        </ul>
    </div>
    <?php if(isset($_GET['action']) && $_GET['action'] === 'game'):?>
        <div class="ml-auto">
            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#gameModal" onclick="getGame(<?=$_GET['id']?>)">
                <i class="far fa-edit w-100 h-auto"></i>
            </button>
        </div>
    <?php endif;?>
</nav>