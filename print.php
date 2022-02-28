<?php

use GameZone\Game;
use GameZone\PDF;

require_once __DIR__ . '/vendor/autoload.php';

$pdf = new PDF();

if(isset($_GET['id'])){
	$games = [Game::getGame($_GET['id'])];
}else{
	$games = Game::getWishlist();
}

$pdf->writeTemplate(__DIR__ . '/src/tpl/print.tpl.php');
$pdf->Output('wishlist.pdf', PDF::INLINE);