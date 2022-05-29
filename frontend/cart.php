<?php
session_start();
include 'include/_header.php';
require 'function.php';
if (!isset($_SESSION["LOGIN"])) {
	echo "<script> alert ('silahkan login terlebih dahulu') ; </script>";
	echo "<script>location='login'; </script>";
	exit();
}

$email = $_SESSION["LOGIN"];
$query = mysqli_query($conn, "SELECT * FROM keranjang WHERE email = '$email'");
if (mysqli_num_rows($query) == 0) {
	echo "<script>alert('keranjang kosong, silakan berbelanja terlebih dahulu');</script>";
	echo "<script>window.location ='daftarproduk';</script>";
}

?>

<div class="wrapper" id="wrapper">


	<?php include 'include/navbar.php'; ?>


	<div class="ht__bradcaump__area bg-image--1">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="bradcaump__inner text-center">
						<h2 class="bradcaump-title">Keranjang Belanja</h2>
						<nav class="bradcaump-content">
							<a class="breadcrumb_item" href="index">Home</a>
							<span class="brd-separetor">/</span>
							<span class="breadcrumb_item active">Keranjang Belanja</span>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- start tabel area -->
	<div class="cart-main-area section-padding--lg bg--white">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 ol-lg-12">
					<div class="table-content wnro__table table-responsive">
						<table>
							<thead>
								<tr class="title-top">
									<th>desain</th>
									<th>produk</th>
									<th>bahan</th>
									<th>Harga</th>
									<th>jumlah</th>
									<th>total harga</th>
									<th>pilihan</th>
								</tr>
							</thead>
							<tbody>
								<?php $nomor = 1;
								$total = 0; ?>
								<?php
								while ($data = mysqli_fetch_array($query)) {
									$id_cart = $data['id_cart'];
									$id_produk = $data['id_produk'];
									$id_bahan = $data['id_bahan'];
									$harga_satuan = $data['harga_satuan'];
									$qty = $data['qty'];
									$gambar = $data['gambar'];

									$quer = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = '$id_produk'");
									$b = mysqli_fetch_array($quer);

									$query_bahan = mysqli_query($conn, "SELECT * FROM bahan WHERE id_bahan = '$id_bahan'");
									$pecah_bahan = mysqli_fetch_array($query_bahan);
								?>
									<tr>
										<td><img src="images/desainuser/<?= $gambar; ?>" width="100"></td>
										<td class="product-name"><a href=""><?= $b['jenis_produk']; ?></a></td>
										<td class="product-name"><a href=""><?= $pecah_bahan['nama_bahan']; ?></a></td>
										<td class="product-price"><span class="amount">Rp. <?= number_format($harga_satuan) ?></span></td>
										<td class="product-quantity">
											<form action="updatecart.php" method="get">
												<input type="text" name="id_cart" value="<?= $id_cart; ?>" hidden>
												<input type="number" min="1" max="100" name="qty" placeholder="<?= $qty; ?>">
												<button class="btn btn-warning btn-sm" type="submit" name="sub" value="sub" hidden>OK</button>
											</form>
										</td>
										<td><?php $subtotal = $harga_satuan * $qty; ?>
											<?= $subtotal; ?></td>
										<td class="product-remove"><a href=" hapuskeranjang?id_cart=<?= $id_cart; ?>" onclick="return confirm('apakah anda yakin ? ');">X</a></td>
									</tr>
									<?php $nomor++; ?>
									<?php
									$total = $total + $subtotal;
									?>
								<?php } ?>
							</tbody>
						</table>
						<input type="hidden" name="update">
						<div class="cartbox__btn">
							<ul class="cart__btn__list d-flex flex-wrap flex-md-nowrap flex-lg-nowrap justify-content-between">
								<li><a href="daftarproduk">Lanjutkan belanja</a></li>
								<li><a href="chekout">chekout</a></li>
							</ul>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-12">
							<div class="cartbox__total__area">
								<div id="accordion" class="wn_accordion" role="tablist">
									<div class="card">
										<div class="acc-header" role="tab" id="headingOne">
											<h5>
												<a data-toggle="collapse" href="#collapseOne" role="button" aria-expanded="false" aria-controls="collapseOne">bagaimana konfirmasi pembayaran .?</a>
											</h5>
										</div>
										<div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
											<div class="card-body">dengan klik checkout untuk ke transaksi selanjutnya dan anda bisa mengatur alamat pengiriman barang yang akan di kirim setelah di proses</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-12">
							<div class="cartbox__total__area">
								<div class="cartbox-total d-flex justify-content-between">
									<ul class="cart__total__list">
										<li>Cart total</li>
									</ul>
									<ul class="cart__total__tk">
										<li>Rp. <?= $total; ?></li>
									</ul>
								</div>
								<div class="cart__total__amount">
									<span>Grand Total</span>
									<span>Rp. <?= $total; ?></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- finish table area -->


</div>

<?php
include 'include/_footer.php';
?>