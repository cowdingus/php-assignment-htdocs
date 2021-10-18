<?php
include "header.php";

include "filter_kasir.php";
?>
<h2>Ayam</h2>
<div class="row">
	<?php
	include "db.php";

	$query = "SELECT * FROM produk";

	if ($stmt = $conn->prepare($query)) {
		$stmt->execute();

		if ($stmt->errno) {
			die("Failed to execute MySQLi statement ({$stmt->errno}): " . $stmt->error);
		}

		$stmt->bind_result($id, $nama, $deskripsi, $harga, $foto_produk);

		$index = 0;
		while ($stmt->fetch()) {
			$index++;
	?>

			<div class="col-md-3">
				<div class="card">
					<img src="<?= $foto_produk ?>" class="card-img-top">
					<div class="card-body">
						<h5 class="card-title"><?= $nama ?></h5>
						<p class="card-text"><?= substr($deskripsi, 0, 20) ?></p>
						<a href="beli_produk.php?id=<?= $id ?>" class="btn btn-primary">Beli</a>
					</div>
				</div>
			</div>

	<?php
		}

		$stmt->close();
	} else {
		die("Failed to prepare() statement: " . $conn->error);
	}

	$conn->close();
	?>
</div>
<?php
include "footer.php";
?>
