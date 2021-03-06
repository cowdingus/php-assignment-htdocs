<?php
include "utilities.php";

include "filter_admin.php";

if ($_POST) {
	$nama = trim($_POST["nama_petugas"]);
	$username = trim($_POST["username"]);
	$password = trim($_POST["password"]);
	$level = trim($_POST["level"]);

	$password = md5($password);

	$redirect_to_url = generate_redirect("tambah_petugas.html");

	if (empty($nama)) {
		echo generate_alert_message("Nama petugas tidak boleh kosong");
		echo $redirect_to_url;
	} elseif (empty($username)) {
		echo generate_alert_message("Username petugas tidak boleh kosong");
		echo $redirect_to_url;
	} elseif (empty($password)) {
		echo generate_alert_message("Pasword petugas tidak boleh kosong");
		echo $redirect_to_url;
	} elseif (empty($level)) {
		echo generate_alert_message("Level petugas tidak boleh kosong");
		echo $redirect_to_url;
	} else {
		include "db.php";

		$query = "INSERT INTO petugas (nama_petugas, username, password, level) VALUES (?, ?, ?, ?)";

		if ($stmt = $conn->prepare($query)) {
			$stmt->bind_param("ssss", $nama, $username, $password, $level);
			$stmt->execute();

			if ($stmt->error) {
				die("Error: ".htmlspecialchars($stmt->error)."\n");
			}

			$stmt->close();
		} else {
			die("Failed to prepare() statement: ".$conn->error);
		}

		echo generate_alert_message("Berhasil menambahkan petugas.");
		echo $redirect_to_url;

		$conn->close();
	}
}
?>
