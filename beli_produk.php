<?php
include "header.php";
include "db.php";
include "utilities.php";

$query = "SELECT * FROM produk WHERE id_produk = ?";

$id = $_GET["id"];

if ($stmt = $conn->prepare($query)) {
	$stmt->bind_param("i", $id);
	$stmt->execute();

	$stmt->bind_result($id_produk, $nama_produk, $deskripsi, $harga, $foto_produk);

	if ($stmt->errno) {
		die("Failed to execute mysqli statement ({$stmt->errno}): {$stmt->error}");
	}

	$stmt->store_result();

	if ($stmt->num_rows() > 0) {
		$stmt->fetch();
?>

		<h2>Beli Produk</h2>
		<div class="row">
			<div class="col-md-4">
				<img src="<?= $foto_produk ?>" alt="" class="card-img-top">
			</div>
			<div class="col-md-8">
				<form action="tambah_ke_keranjang.php?id=<?= $id ?>" method="post">
					<table class="table table-hover table-striped">
						<thead>
							<tr>
								<td>Nama Produk</td>
								<td>
									<?= $nama_produk ?>
								</td>
							</tr>
							<tr>
								<td>Deskripsi</td>
								<td>
									<?= $deskripsi ?>
								</td>
							</tr>
							<tr>
								<td>Jumlah Pinjam</td>
								<td><input type="number" name="qty" value="1"></td>
							</tr>
							<tr>
								<td colspan="2"><input class="btn btn-success" type="submit" value="Tambahkan Ke Keranjang">
								</td>
							</tr>
						</thead>
					</table>
				</form>
			</div>
		</div>

<?php
	} else {
		echo generate_alert_message("Id produk tidak valid.");
		echo generate_redirect("beranda.php");
	}
} else {
	die("Failed to prepare statement ($conn->errno): {$conn->error}");
}

include "footer.php";
?>
