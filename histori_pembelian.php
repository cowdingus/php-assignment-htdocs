<?php
include "header.php";
?>

<h2>Histori Pembelian</h2>
<table class="table table-hover table-striped">
	<thead>
		<th>No</th>
		<th>Tanggal Pembelian</th>
		<th>Nama Produk</th>
		<th>Jumlah Pembelian</th>
		<th>Subtotal</th>
		<th>Nama Petugas</th>
		<th>Nama Pelanggan</th>
	</thead>
	<tbody>
		<?php
		include "db.php";

$query_result = $conn->query("SELECT * FROM transaksi, detail_transaksi, produk, petugas, pelanggan"
	. " WHERE detail_transaksi.id_transaksi = transaksi.id_transaksi"
	. " AND detail_transaksi.id_produk = produk.id_produk"
	. " AND transaksi.id_petugas = petugas.id_petugas"
	. " AND transaksi.id_pelanggan = pelanggan.id_pelanggan");

		$index = 0;
		while ($transaksi = $query_result->fetch_assoc())
		{
			$index++;
			echo "<tr>";
			echo "<td>{$index}</td>";
			echo "<td>{$transaksi["tgl_transaksi"]}</td>";
			echo "<td>{$transaksi["nama_produk"]}</td>";
			echo "<td>{$transaksi["qty"]}</td>";
			echo "<td>{$transaksi["subtotal"]}</td>";
			echo "<td>{$transaksi["nama_petugas"]}</td>";
			echo "<td>{$transaksi["nama"]}</td>";
			echo "</tr>";
		}
		?>
	</tbody>
</table>

<?php
include "footer.php";
?>
