<?php
include "utilities.php";

if ($_POST) {
	$id = trim($_POST["id"]);
	$nama = trim($_POST["nama"]);
	$username = trim($_POST["username"]);
	$password = trim($_POST["password"]);
	$level = trim($_POST["level"]);

	$redirect_to_url = generate_redirect("tampil_petugas.php");

	if (empty($id)) {
		echo generate_alert_message("Id petugas tidak boleh kosong");
		echo $redirect_to_url;
	} elseif (empty($nama)) {
		echo generate_alert_message("Nama petugas tidak boleh kosong");
		echo $redirect_to_url;
	} elseif (empty($username)) {
		echo generate_alert_message("Username petugas tidak boleh kosong");
		echo $redirect_to_url;
	} elseif (empty($password)) {
		echo generate_alert_message("Password petugas tidak boleh kosong");
		echo $redirect_to_url;
	} elseif (empty($level)) {
		echo generate_alert_message("Level petugas tidak boleh kosong");
		echo $redirect_to_url;
	} else {
		include "db.php";

		move_uploaded_file($path_foto_produk, $upload_path . $nama_foto_produk);
		$path_foto_produk = $upload_path . $nama_foto_produk;

		$query = "UPDATE petugas SET nama_petugas=?, username=?, password=?, level=? WHERE id_petugas=?";

		if ($stmt = $conn->prepare($query)) {
			$stmt->bind_param("ssssi", $nama, $username, $password, $level, $id);
			$stmt->execute();

			if ($stmt->error) {
				die("Error: " . htmlspecialchars($stmt->error) . "\n");
			}

			$stmt->close();
		} else {
			die("Failed to prepare() statement: " . $conn->error);
		}

		echo generate_alert_message("Berhasil mengubah petugas.");
		echo $redirect_to_url;

		$conn->close();
	}
}
