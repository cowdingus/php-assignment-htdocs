<?php
include "utilities.php";

session_start();

if ($_POST) {
	include "db.php";

	$query = "SELECT * FROM produk WHERE id_produk = ?";

	if ($stmt = $conn->prepare($query)) {
		$stmt->bind_param("i", $_GET["id"]);
		$stmt->execute();

		$stmt->bind_result($id_produk, $nama_produk, $deskripsi, $harga, $foto_produk);

		if ($stmt->errno) {
			die("Failed to execute prepared statement ({$stmt->errno}): {$stmt->error}");
		}

		$stmt->store_result();

		if ($stmt->num_rows() > 0) {
			$stmt->fetch();
			$_SESSION["cart"][] = array(
				'id_produk' => $id_produk,
				'nama_produk' => $nama_produk,
				'harga' => $harga,
				'qty' => $_POST["qty"]
			);
		} else {
			echo generate_alert_message("Id produk tidak valid");
			echo generate_redirect("beranda.php");
		}

		$stmt->close();
	} else {
		die("Failed to prepare mysqli statement ({$stmt->errno}): {$stmt->error}");
	}

	header('location: keranjang.php');

	$conn->close();
}
?>
