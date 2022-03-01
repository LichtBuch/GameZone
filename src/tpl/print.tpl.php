<?php
/**
 * @var Game $game
 */

use GameZone\DatabaseObject;
use GameZone\Game;
use GameZone\Image;

?>
<div>
	<h1>
		<?=$game->getGameName()?>
	</h1>
	<h4>
		<?=$game->getReview()?> Stars
	</h4>
</div>

<hr>

<div>
	<h4>Release Date: <?=DatabaseObject::formatTime($game->getReleaseDate())?></h4>
	<h4>Price: <?=$game->getPriceFormatted()?> €</h4>
	<h4>Summary:</h4>
	<h6><?=nl2br($game->getDescription())?></h6>
	<h4>Categories:</h4>
	<div>
		<?php foreach ($game->getCategories() as $category):?>
			<span>
				<?=$category->getCategoryName()?>
			</span>
		<?php endforeach;?>
	</div>
</div>
<table>
	<tr>
		<th></th>
		<th align="center"><img src="<?=Image::WEB_PATH?><?=$game->getImages()[0]->getImageName()?>" height="400"></th>
		<th></th>
	</tr>
</table>