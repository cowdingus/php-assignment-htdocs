<?php
include "utilities.php";

if ($_POST) {
	$nama = trim($_POST["nama"]);
	$alamat = trim($_POST["alamat"]);
	$no_telepon = trim($_POST["telp"]);

	if (empty($nama)) {
		echo generate_alert_message("Nama pelanggan tidak boleh kosong");
		echo generate_redirect("tambah_pelanggan.html");
	} elseif (empty($alamat)) {
		echo generate_alert_message("Alamat pelanggan tidak boleh kosong");
		echo generate_redirect("tambah_pelanggan.html");
	} elseif (empty($no_telepon)) {
		echo generate_alert_message("Nomor telepon tidak boleh kosong");
		echo generate_redirect("tambah_pelanggan.html");
	} else {
		include "db.php";

		$query = "INSERT INTO pelanggan (nama, alamat, telp) VALUES (?, ?, ?)";

		if ($stmt = $conn->prepare($query)) {
			$stmt->bind_param("sss", $nama, $alamat, $no_telepon);
			$stmt->execute();

			if ($stmt->error) {
				die("Error: ".htmlspecialchars($stmt->error)."\n");
			}

			$stmt->close();
		} else {
			die("Failed to prepare() statement: ".$conn->error);
		}

		echo generate_alert_message("Berhasil menambahkan pelanggan.");
		echo generate_redirect("tambah_pelanggan.html");

		$conn->close();
	}
}
?>
