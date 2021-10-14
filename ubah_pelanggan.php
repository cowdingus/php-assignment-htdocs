<?php
include "db.php";

$query = "SELECT * FROM pelanggan WHERE id_pelanggan = ?";

if ($stmt = $conn->prepare($query)) {
	$stmt->bind_param("i", $_GET["id"]);
	$stmt->execute();

	if ($stmt->error) {
		die("Failed to execute MySQLi statement: " . $stmt->error);
	}

	$stmt->bind_result($id, $nama, $alamat, $telepon);

	while ($stmt->fetch()) {
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

	<title>Ubah Pelanggan</title>
</head>

<body>
	<div class="container mt-5 pt-3">
		<h3 class="mb-4">Ubah Pelanggan</h3>

		<form action="proses_ubah_pelanggan.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?=$_GET["id"]?>">

			<div class="form-group mb-3">
				<label for="input-nama" class="form-label">Nama Pelanggan</label>
				<input type="text" class="form-control" name="nama" id="input-nama"
				value="<?=$nama?>">
			</div>
			<div class="form-group mb-3">
				<label for="input-alamat" class="form-label">Alamat</label>
				<textarea class="form-control" name="alamat" id="input-alamat" rows="3"><?=$alamat?>
				</textarea>
			</div>
			<div class="form-group mb-3">
				<label for="input-telepon" class="form-label">Nomor Telepon</label>
				<input type="text" class="form-control" name="telp" id="input-telepon"
				value="<?=$telepon?>">
			</div>
			<button type="submit" class="btn btn-primary">Ubah</button>
		</form>
	</div>
</body>

</html>

<?php
	}

	$stmt->close();
} else {
	die("Failed to prepare() statement: " . $conn->error);
}

$conn->close();
?>
