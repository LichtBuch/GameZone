<?php

use GameZone\Game;

$_POST['wishlisted'] = isset($_POST['wishlisted']);
$_POST['deleted'] = false;

$game = new Game();
$game->populate($_POST);
$game->save();