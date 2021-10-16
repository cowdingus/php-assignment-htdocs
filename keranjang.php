<?php
include "header.php";
?>
<h2>Keranjang</h2>
<table class="table table-hover striped">
	<thead>
		<th>No</th><th>Nama Produk</th><th>Jumlah</th><th>Aksi</th>
	</thead>
	<tbody>
		<?php foreach (@$_SESSION["cart"] as $key => $val): ?>
		<tr>
			<td><?= ($key + 1) ?></td>
			<td><?= $val["nama_produk"] ?></td>
			<td><?= $val["qty"] ?></td>
			<td><a href="hapus_cart.php?id=<?= $key ?>" class="btn btn-danger"><strong>X</strong></a></td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>
<a href="checkout.php" class="btn btn-primary">Check Out</a>
<?php
include "footer.php";
?>
