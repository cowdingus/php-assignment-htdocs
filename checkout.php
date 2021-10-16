<?php
session_start();

include "db.php";
include "utilities.php";

$cart = $_SESSION['cart'];

if ($cart && count($cart) > 0) {
	$query = "INSERT INTO transaksi (id_pelanggan, id_petugas, tgl_transaksi) VALUES (?, ?, ?)";

	$id_transaksi = -1;

	if ($stmt = $conn->prepare($query)) {
		$id_pelanggan = $_POST["id_pelanggan"];
		$id_petugas = $_SESSION["id_petugas"];
		$tgl_transaksi = date("Y-m-d");

		$stmt->bind_param("iis", $id_pelanggan, $id_petugas, $tgl_transaksi);

		if ($stmt->errno) {
			die("Failed to execute mysqli statement ({$stmt->errno}): {$stmt->error}");
		}

		$stmt->execute();

		if ($stmt->errno) {
			die("Failed to execute mysqli statement ({$stmt->errno}): {$stmt->error}");
		}

		$id_transaksi = $stmt->insert_id;
		$stmt->close();
	} else {
		die("Failed to prepare statement ({$conn->errno}): {$conn->error}");
	}

	$query = "INSERT INTO detail_transaksi (id_transaksi, id_produk, qty, subtotal) VALUES (?, ?, ?, ?)";

	if ($stmt = $conn->prepare($query)) {
		foreach ($cart as $key => $value) {
			$subtotal = $value["qty"] * $value["harga"];
			$stmt->bind_param("iiii", $id_transaksi, $value["id_produk"], $value["qty"], $subtotal);

			if ($stmt->errno) {
				die("Failed to execute mysqli statement ({$stmt->errno}): {$stmt->error}");
			}

			$stmt->execute();

			if ($stmt->errno) {
				die("Failed to execute mysqli statement ({$stmt->errno}): {$stmt->error}");
			}
		}

		$stmt->close();
	} else {
		die("Failed to prepare statement ({$conn->errno}): {$conn->error}");
	}

	$conn->close();

	unset($_SESSION['cart']);
	echo generate_alert_message("Anda berhasil membeli ayam");
	echo generate_redirect("histori_pembelian.php");
} else {
	echo generate_alert_message("Keranjang anda kosong");
	echo generate_redirect("keranjang.php");
}
