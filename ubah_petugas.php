<?php
include "db.php";

$query = "SELECT * FROM petugas WHERE id_petugas = ?";

if ($stmt = $conn->prepare($query)) {
	$stmt->bind_param("i", $_GET["id"]);
	$stmt->execute();

	if ($stmt->error) {
		die("Failed to execute MySQLi statement: " . $stmt->error);
	}

	$stmt->bind_result($id, $nama, $username, $password, $level);

	while ($stmt->fetch()) {
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

	<title>Ubah Petugas</title>
</head>

<body>
	<div class="container mt-5 pt-3">
		<h3 class="mb-4">Ubah Petugas</h3>

		<form action="proses_ubah_petugas.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?=$_GET["id"]?>">

			<div class="form-group mb-3">
				<label for="input-nama" class="form-label">Nama Petugas</label>
				<input type="text" class="form-control" name="nama" id="input-nama"
				value="<?=$nama?>">
			</div>
			<div class="form-group mb-3">
				<label for="input-username" class="form-label">Username</label>
				<input type="text" class="form-control" name="username" id="input-username"
				value="<?=$username?>">
			</div>
			<div class="form-group mb-3">
				<label for="input-password" class="form-label">Password</label>
				<input type="text" class="form-control" name="password" id="input-password"
				value="<?=$password?>">
			</div>
			<div class="form-group mb-3">
				<label for="input-level" class="form-label">Level</label>
				<input type="text" class="form-control" name="level" id="input-level"
				value="<?=$level?>">
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
