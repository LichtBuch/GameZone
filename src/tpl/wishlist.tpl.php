<?php

use GameZone\DatabaseObject;
use GameZone\Game;
use GameZone\Image;

$games=Game::getWishlist();
?>
<script src="/src/js/mainTable.js"></script>
<script>
	$(document).ready(function () {
		getImages([
			<?php foreach ($games as $game):?>
			<?php if(empty($game->getImages())):?>
			<?=$game->getGameID()?>,
			<?php endif;?>
			<?php endforeach;?>
		]);
	});
</script>
<div class="container py-5">

	<button class="btn btn-outline-info my-5" onclick="window.location.href='/print.php'">
		<i class="fa-solid fa-print"></i>
	</button>

	<table class="table dataTable">
		<thead>
		<tr>
			<th data-orderable="false">Image</th>
			<th>Name</th>
			<th>Realease Date</th>
			<th>Price</th>
			<th>Categories</th>
			<th>Review</th>
			<th>Wishlisted</th>
			<th data-orderable="false">Options</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($games as $game): ?>
			<tr>
				<?php if (empty($game->getImages())): ?>
					<th class="text-center" id="image<?= $game->getGameID() ?>" data-name="<?= $game->getGameName() ?>">
						<i class="fas fa-spinner fa-spin"></i></th>
				<?php else: ?>
					<th class="text-center">
						<img src="<?= Image::WEB_PATH ?><?= $game->getImages()[0]->getImageName() ?>" alt="<?= $game->getGameName() ?>" height="72" class="w-auto">
					</th>
				<?php endif; ?>
				<th><?= $game->getGameName() ?></th>
				<th>
					<span hidden><?= date('Y-m-d', $game->getReleaseDate()) ?></span>
					<?= DatabaseObject::formatTime($game->getReleaseDate()) ?>
				</th>
				<th><?= $game->getPriceFormatted() ?> €</th>
				<th>
					<?php foreach ($game->getCategories() as $category): ?>
						<span class="badge badge-pill badge-info m-1" onclick="search('<?= addslashes($category->getCategoryName()) ?>')">
                            <?= $category->getCategoryName() ?>
                        </span>
					<?php endforeach; ?>
				</th>
				<th>
					<div class="d-flex">
						<span hidden><?= $game->getReview() ?></span>
						<?php for ($i=0; $i<$game->getReview(); $i++): ?>
							<i class="fa-solid fa-star"></i>
						<?php endfor; ?>
						<?php for (; $i<5; $i++): ?>
							<i class="fa-regular fa-star"></i>
						<?php endfor; ?>
					</div>
				</th>
				<th>
					<button type="button" class="btn btn-outline-danger" id="favorButton<?= $game->getGameID() ?>" onclick="switchFavorite(<?= $game->getGameID() ?>)">
						<i class="fa-solid fa-heart"></i>
					</button>
				</th>
				<th>
					<button type="button" class="btn btn-outline-info" onclick="location.href='?action=game&id=<?= $game->getGameID() ?>'">
						<i class="fa-solid fa-circle-info"></i>
					</button>
				</th>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>