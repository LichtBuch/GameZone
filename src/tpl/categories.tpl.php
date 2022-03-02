<?php

use GameZone\Category;

?>
	<script>
		$(document).ready(function () {
			$(".dataTable").DataTable();
		});
	</script>
	<script src="/src/js/categories.js"></script>
	<div class="container py-5">

		<button type="button" class="btn btn-outline-primary my-5" data-toggle="modal" data-target="#categoryModal" onclick="document.getElementById('categoryForm').reset()">
			<i class="fa-solid fa-plus"></i>
		</button>

		<table class="table dataTable">
			<thead>
			<tr>
				<th>Name</th>
				<th data-orderable="false">Options</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach (Category::getAll() as $category): ?>
				<tr>
					<th><?= $category->getCategoryName() ?></th>
					<th>
						<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#categoryModal" onclick="getCategory(<?= $category->getCategoryID() ?>)">
							<i class="fa-solid fa-pen-to-square"></i>
						</button>
						<button type="button" class="btn btn-outline-warning" id="deleteButton<?= $category->getCategoryID() ?>" onclick="deleteCategory(<?= $category->getCategoryID() ?>)">
							<i class="fa-regular fa-trash-can"></i>
						</button>
					</th>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
<?php include TPL.'categoryModal.tpl.php'; ?>