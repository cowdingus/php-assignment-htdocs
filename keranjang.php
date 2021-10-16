<?php
include "header.php";
?>
<h2>Keranjang</h2>
<table class="table table-hover striped">
	<thead>
		<th>No</th>
		<th>Nama Produk</th>
		<th>Jumlah</th>
		<th>Aksi</th>
	</thead>
	<tbody>
		<?php foreach (@$_SESSION["cart"] as $key => $val) : ?>
			<tr>
				<td><?= ($key + 1) ?></td>
				<td><?= $val["nama_produk"] ?></td>
				<td><?= $val["qty"] ?></td>
				<td><a href="hapus_dari_keranjang.php?id=<?= $key ?>" class="btn btn-danger"><strong>X</strong></a></td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>
<form action="checkout.php" method="post">
	<div class="form-group row">
		<label class="col-lg-1 col-sm-2 col-form-label px-0 px-sm-3" for="pelanggan">Pembeli</label>
		<div class="col-lg-9 col-sm-7 px-0 px-sm-3">
			<select class="form-control mb-2 mb-sm-0" id="pelanggan" name="id_pelanggan">
				<?php
				include "db.php";

				$query_result = $conn->query("SELECT * FROM pelanggan");

				while ($pelanggan = $query_result->fetch_assoc()) {
				?>
					<option value="<?= $pelanggan["id_pelanggan"] ?>"><?= $pelanggan["nama"] ?></option>
				<?php
				}
				?>
			</select>
		</div>
		<button type="submit" class="btn btn-primary col-lg-2 col-sm-3">Check out</button>
	</div>
</form>
<?php
include "footer.php";
?>
