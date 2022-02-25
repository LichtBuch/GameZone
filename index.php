<?php

const SRC = __DIR__ . '/src/';
const TPL = SRC .'tpl/';
const PHP = SRC . 'php/';

require_once __DIR__ . '/vendor/autoload.php';
include_once PHP . 'controller.inc.php';

//$game = new Game();
//$game
//	->setDeleted(false)
//	->setFavored(true)
//	->setDescription('Cooles Spiel')
//	->setGameName('Portal')
//	->setPrice(10.99)
//	->setPurchaseDate(time())
//	->setReleaseDate(time())
//	->setReview(5)
//	->setWishlisted(true)
//	->save();


require_once TPL . 'head.tpl.php';

include TPL . 'maintable.tpl.php';