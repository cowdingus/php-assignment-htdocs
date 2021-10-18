<?php
include "filter_admin.php";
?>
<!DOCTYPE html>
<html>

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

	<title> Tampil Produk - Toko Online </title>
</head>

<body>
	<div class="container mt-5 pt-3">
		<h3 class="mb-4"> Tampil Produk </h3>
		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>Deskripsi</th>
					<th>Harga</th>
					<th>Foto Produk</th>
				</tr>
			</thead>
			<tbody>
				<?php
				include "db.php";

				$query = "SELECT * FROM produk";

				if ($stmt = $conn->prepare($query)) {
					$stmt->execute();

					if ($stmt->error) {
						die("Failed to execute MySQLi statement: " . $stmt->error);
					}

					$stmt->bind_result($id, $nama, $deskripsi, $harga, $foto_produk);

					$index = 0;
					while ($stmt->fetch()) {
						$index++;
						echo "<tr>";
						echo "<td>{$index}</td>";
						echo "<td>{$nama}</td>";
						echo "<td>{$deskripsi}</td>";
						echo "<td>{$harga}</td>";
						echo "<td><img src={$foto_produk}></td>";
						echo "<td><a href=\"ubah_produk.php?id={$id}\" class=\"btn btn-success\">Ubah</a> | ";
						echo "<a href=\"hapus_produk.php?id={$id}\" class=\"btn btn-danger\">Hapus</a></td>";
						echo "</tr>";
					}

					$stmt->close();
				} else {
					die("Failed to prepare() statement: " . $conn->error);
				}

				$conn->close();
				?>
			</tbody>
		</table>
	</div>
</body>

</html>
