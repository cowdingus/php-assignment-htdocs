<?php

if ($_GET["id"]) {
	include "utilities.php";
	include "db.php";

	$redirect_to_url = generate_redirect("tampil_produk.php");

	$query = "DELETE FROM produk WHERE id_produk = ?";

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

	echo generate_alert_message("Berhasil menghapus produk.");
	echo $redirect_to_url;

	$conn->close();
}
