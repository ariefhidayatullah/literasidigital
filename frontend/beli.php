<?php
session_start();
include 'include/_header.php';
require 'function.php';
// jika sudah ada produk itu di keranjang, maka produk itu jumlahnya di tambah 1

if (isset($_POST["cart"])) {
	if (tambahcart($_POST) > 0) {
		echo "
			<script>
				alert('produk berhasil masuk keranjang');
					document.location.href = 'cart';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal masuk keranjang'); 
			</script>
		";
	}
}
