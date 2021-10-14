<?php

if ($_GET["id"]) {
	include "utilities.php";
	include "db.php";

	$redirect_to_url = generate_redirect("tampil_petugas.php");

	$query = "DELETE FROM petugas WHERE id_petugas = ?";

	if ($stmt = $conn->prepare($query)) {
		$stmt->bind_param("i", $_GET["id"]);
		$stmt->execute();

		if ($stmt->error) {
			die("Error: " . htmlspecialchars($stmt->error) . "\n");
		}

		$stmt->close();
	} else {
		die("Failed to prepare() statement: " . $conn->error);
	}

	echo generate_alert_message("Berhasil menghapus petugas.");
	echo $redirect_to_url;

	$conn->close();
}
