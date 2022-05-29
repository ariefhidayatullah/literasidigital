<?php
require 'function.php';
include '../_header.php';

if (isset($_POST["submit"])) {

	//cek data berhasil ditambah atau tidak
	if (tambah($_POST) > 0) {
		echo "
			<script>
				alert('data berhasil ditambah');
					document.location.href = 'dataproduk.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal ditambah'); 
				document.location.href = 'dataproduk.php';
			</script>
		";
	}
}

'../_header.php';

?>

<div class="container text-center">
	<div class="text-center">
		<h1 class="h4 text-gray-900">Tambahkan Produk !</h1>
	</div>
	<div class="row">
		<div class="col-lg-6 offset-3">
			<form class="user" method="post" action="" enctype="multipart/form-data">
				<input type="hidden" class="form-control form-control-static text-center" id="id_produk" name="id_produk" value="" readonly>
				<div class="col mt-3 mb-sm-0">
					<label for="jenis_produk">Masukkan Jenis Produk : </label>
					<input type="text" class="form-control form-control-static text-center" id="jenis_produk" name="jenis_produk" required placeholder="Masukkan jenis produk">
				</div>
				<div class="col mt-3 mb-sm-0">
					<label for="deskripsi">Tambahkan Deskripsi : </label>
					<input type="text" class="form-control form-control-static text-center" id="deskripsi" name="deskripsi" required placeholder="Tambahkan Deskripsi">
				</div>
				<div class="col mt-3 mb-sm-0">
					<label for="deskripsi">Tambahkan ukuran : </label>
					<input type="text" class="form-control form-control-static text-center" id="ukuran" name="ukuran" required placeholder="Tambahkan ukuran">
				</div>
				<div class="col mt-3 mb-sm-0">
					<label for="deskripsi">Tambahkan harga awal : </label>
					<input type="text" class="form-control form-control-static text-center" id="harga" name="harga" required placeholder="Tambahkan harga">
				</div>
				<div class="col mt-3 mb-sm-0">
					<input type="file" id="gambar" name="gambar">
				</div>
				<div class="pull-right text-center mb-5">
					<a href="dataproduk.php" class="btn btn-secondary btn-icon-split btn-sm">
						<span class="icon text-white-50">
							<i class="fas fa-arrow-right"></i>
						</span>
						<span class="text">kembali</span></a>
					<input class="btn btn-primary" name="submit" type="submit" value="Tambahkan"></input>
				</div>
			</form>
		</div>
	</div>
</div>


<? include '../_footer.php'; ?>