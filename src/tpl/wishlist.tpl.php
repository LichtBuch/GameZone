<?php

use GameZone\DatabaseObject;
use GameZone\Game;
use GameZone\Image;

$games = Game::getWishlist();
?>
<script src="/src/js/mainTable.js"></script>
<script>
	$(document).ready(function () {
		$(".dataTable").DataTable();
	})
</script>
<div class="container py-5">

    <button class="btn btn-outline-primary my-5" type="button" data-toggle="modal" data-target="#gameModal" onclick="window.location.href='/print.php'">
        <i class="fa-solid fa-print"></i>
    </button>

    <table class="table dataTable">
        <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Realease Date</th>
            <th>Price</th>
            <th>Categories</th>
            <th>Review</th>
            <th>Wishlisted</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($games as $key => $game):?>
            <tr>
                <?php if(empty($game->getImages())):?>
                    <th id="image<?=$key?>" data-name="<?=$game->getGameName()?>"><i class="fas fa-spinner fa-spin"></i></th>
                <?php else:?>
                    <th><img src="<?=Image::WEB_PATH?><?=$game->getImages()[0]->getImageName()?>" alt="<?=$game->getGameName()?>" width="52" height="72"></th>
                <?php endif;?>
                <th><?=$game->getGameName()?></th>
                <th><?=DatabaseObject::formatTime($game->getReleaseDate())?></th>
                <th><?=$game->getPriceFormatted()?> €</th>
                <th>
                    <?php foreach ($game->getCategories() as $category):?>
                        <span class="badge badge-pill badge-info m-1" onclick="search('<?=$category->getCategoryName()?>')">
                            <?=$category->getCategoryName()?>
                        </span>
                    <?php endforeach;?>
                </th>
				<th>
					<div class="d-flex">
						<span hidden><?=$game->getReview()?></span>
						<?php for ($i = 0;$i < $game->getReview();$i++):?>
							<i class="fa-solid fa-star"></i>
						<?php endfor;?>
						<?php for(;$i < 5;$i++):?>
							<i class="fa-regular fa-star"></i>
						<?php endfor;?>
					</div>
				</th>
                <th>
                    <button type="button" class="btn btn-outline-danger" id="favorButton<?=$game->getGameID()?>" onclick="switchFavorite(<?=$game->getGameID()?>)">
						<i class="fa-solid fa-heart"></i>
                    </button>
                </th>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>