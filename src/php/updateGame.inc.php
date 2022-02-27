<?php

use GameZone\Category;
use GameZone\Game;

$_POST['wishlisted'] = isset($_POST['wishlisted']);
$_POST['deleted'] = false;

$game = new Game();
$game->populate($_POST)->save();

if(!empty($_FILES['images']['name'][0])) {
    $game->deleteImages();
    $game->uploadImages($_FILES['images']);
}

if(!empty($_POST['categories'])){
    $game->removeCategories();
    $names = explode(', ', $_POST['categories']);
    foreach (Category::getCategoriesByNames($names) as $category){
        $game->addCategory($category);
    }
}