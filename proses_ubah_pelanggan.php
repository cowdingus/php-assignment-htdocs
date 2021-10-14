<?php
include "utilities.php";

if ($_POST) {
	$id = $_POST["id"];
	$nama = $_POST["nama"];
	$alamat = $_POST["alamat"];
	$telepon = $_POST["telp"];

	$redirect_to_url = generate_redirect("tampil_pelanggan.php");

	if (empty($id)) {
		echo generate_alert_message("Id pelanggan tidak boleh kosong");
		echo $redirect_to_url;
	} elseif (empty($nama)) {
		echo generate_alert_message("Nama pelanggan tidak boleh kosong");
		echo $redirect_to_url;
	} elseif (empty($alamat)) {
		echo generate_alert_message("Alamat pelanggan tidak boleh kosong");
		echo $redirect_to_url;
	} elseif (empty($telepon)) {
		echo generate_alert_message("Telepon pelanggan tidak boleh kosong");
		echo $redirect_to_url;
	} else {
		include "db.php";

		$query = "UPDATE pelanggan SET nama=?, alamat=?, telp=? WHERE id_pelanggan=?";

		if ($stmt = $conn->prepare($query)) {
			$stmt->bind_param("sssi", $nama, $alamat, $telepon, $id);
			$stmt->execute();

			if ($stmt->error) {
				die("Error: " . htmlspecialchars($stmt->error) . "\n");
			}

			$stmt->close();
		} else {
			die("Failed to prepare() statement: " . $conn->error);
		}

		echo generate_alert_message("Berhasil mengubah pelanggan.");
		echo $redirect_to_url;

		$conn->close();
	}
}
