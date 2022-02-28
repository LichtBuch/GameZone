<script src="/src/js/csv.js"></script>
<div class="container">
	<div class="d-flex justify-content-between h-100 w-100">
		<button class="btn btn-outline-info my-auto" onclick="openFile()">
			<i class="fa-solid fa-file-import h-auto w-auto" style="max-height: 100%;max-width: 100%"></i>
			<h1>Import</h1>
		</button>
		<button class="btn btn-outline-info my-auto" onclick="window.location.href='/export.php'">
			<i class="fa-solid fa-file-export h-auto w-auto" style="max-height: 100%;max-width: 100%"></i>
			<h1>Export</h1>
		</button>
	</div>
</div>

<form method="post" id="importForm" enctype="multipart/form-data" hidden>
	<input type="file" name="GameFile" id="GameFile" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" onchange="fileChanged(this)">
	<input type="text" name="action" id="action" value="importCSV" readonly>
</form>