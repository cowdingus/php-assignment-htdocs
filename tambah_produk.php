<?php
include "utilities.php";

if ($_POST) {
	$nama = $_POST["nama_produk"];
	$deskripsi = $_POST["deskripsi"];
	$harga = $_POST["harga"];

	$upload_path = "uploads/";

	$file_foto_produk = $_FILES["foto_produk"];
	$nama_foto_produk = $file_foto_produk["name"];
	$ukuran_foto_produk = $file_foto_produk["size"];
	$path_foto_produk = $file_foto_produk["tmp_name"];

	$redirect_to_url = generate_redirect("tambah_produk.html");

	if (empty($nama)) {
		echo generate_alert_message("Nama produk tidak boleh kosong");
		echo $redirect_to_url;
	} elseif (empty($deskripsi)) {
		echo generate_alert_message("Deskripsi produk tidak boleh kosong");
		echo $redirect_to_url;
	} elseif (empty($harga)) {
		echo generate_alert_message("Harga produk tidak boleh kosong");
		echo $redirect_to_url;
	} elseif (empty($file_foto_produk)) {
		echo generate_alert_message("Foto produk tidak boleh kosong");
		echo $redirect_to_url;
	} else {
		include "db.php";

		move_uploaded_file($path_foto_produk, $upload_path . $nama_foto_produk);
		$path_foto_produk = $upload_path . $nama_foto_produk;

		$query = "INSERT INTO produk (nama_produk, deskripsi, harga, foto_produk) VALUES (?, ?, ?, ?)";

		if ($stmt = $conn->prepare($query)) {
			$stmt->bind_param("ssis", $nama, $deskripsi, $harga, $path_foto_produk);
			$stmt->execute();

			if ($stmt->error) {
				die("Error: " . htmlspecialchars($stmt->error) . "\n");
			}

			$stmt->close();
		} else {
			die("Failed to prepare() statement: " . $conn->error);
		}

		echo generate_alert_message("Berhasil menambahkan produk.");
		echo $redirect_to_url;

		$conn->close();
	}
}
