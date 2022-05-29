<?php
session_start();
require 'function.php';
include 'include/_header.php';

if (empty(base64_decode($_GET['id']))) {
	echo "<script>location='error';</script>";
	exit();
}


$id_produk1 = base64_decode($_GET['id']);

$produk = query('SELECT * FROM produk order by rand()');
$mhs = query("SELECT * FROM produk WHERE id_produk = '$id_produk1'");



if (isset($_SESSION["LOGIN"])) {
	$email = $_SESSION["LOGIN"];
	$user = query("SELECT * FROM user WHERE email = '$email'");
}

if (isset($_POST["cart"])) {
	if (!isset($_SESSION["LOGIN"])) {
		echo "<script> alert ('silahkan login terlebih dahulu') ; </script>";
		echo "<script>location='login'; </script>";
		exit();
	}
	if (tambahcart($_POST) > 0) {
		echo "<script>alert('produk berhasil masuk keranjang');</script>";
		echo "<script>window.location ='cart';</script>";
	} else {
		echo "<script>alert('maaf kesalahan, pastikan anda inputkan dengan benar');</script>";
	}
}

?>

<!-- Main wrapper -->
<div class="wrapper" id="wrapper">
	<!-- Header -->
	<?php include 'include/navbar.php'; ?>
	<!-- //Header -->
	<!-- Start Bradcaump area -->
	<div class="ht__bradcaump__area bg-image--1">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="bradcaump__inner text-center">
						<h2 class="bradcaump-title">produk</h2>
						<nav class="bradcaump-content">
							<a class="breadcrumb_item" href="index">Home</a>
							<span class="brd-separetor">/</span>
							<span class="breadcrumb_item active">produk</span>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Bradcaump area -->
	<!-- Start main Content -->
	<div class="maincontent bg--white pt--80 pb--55">
		<?php foreach ($mhs as $row) : ?>
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="wn__single__product">
							<div class="row">
								<div class="col-lg-6 col-12">
									<div class="wn__fotorama__wrapper">
										<div class="fotorama wn__fotorama__action" data-nav="thumbs">
											<a href="1.jpg"><img src="img/<?= $row['gambar']; ?>" alt=""></a>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-12">
									<div class="product__info__main">
										<h1><?= $row['jenis_produk']; ?></h1> </a>
										<div class="product__overview">
											<?php
											$sql = "SELECT * FROM produk WHERE id_produk = '$id_produk1'";
											$ba = mysqli_query($conn, $sql);
											$ro = mysqli_fetch_array($ba);

											$jenis_produk = $ro['jenis_produk'];
											$deskripsi = $ro['deskripsi'];
											$ukuran = $ro['ukuran'];
											$gambar = $ro['gambar'];
											?>
											<div class="card">
												<div class="acc-header" role="tab" id="headingTwo">
													<h5>
														<a class="collapsed" data-toggle="collapse" href="#collapseTwo" role="button" aria-expanded="false" aria-controls="collapseTwo">
															<?php echo "Kenapa harus mencetak " . $ro['jenis_produk'] . "?"; ?> </a>
													</h5>
												</div>
												<div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
													<div class="card-body"><?php echo $ro['deskripsi']; ?></div>
												</div>
											</div>
										</div>

										<span class="mb-4">Ukuran Percetakan : <?php
																				echo $ro['ukuran'];
																				?>
										</span>
										<?php
										$bahan1 = mysqli_query($conn, "SELECT * FROM bahan where id_produk = '$id_produk1'");
										$row = mysqli_fetch_array($bahan1);
										$nama_bahan = $row['nama_bahan'];
										?>
										<?php
										$bahan = mysqli_query($conn, "SELECT * FROM bahan WHERE id_produk ='$id_produk1' ORDER BY nama_bahan ASC");
										$jsArray = "var prdName = new Array();\n";
										?>
										<div class="box-tocart d-flex">
											<div class="addtocart__actions">
												<form action="" method="POST" enctype="multipart/form-data">
													<select id="nim" name="nama_bahan" onchange="changeValue(this.value)" class="form-control col-md-6 mt-3 mt-3" required>
														<option disabled="" selected="">Pilih Bahan</option>
														<?php
														while ($row = mysqli_fetch_array($bahan)) {
															echo '<option value="' . $row['nama_bahan'] . '">' . $row['nama_bahan'] . '</option> ';
															$jsArray .= "prdName['" . $row['nama_bahan'] . "'] = {harga:'" . addslashes($row['harga_satuan']) . "'};\n";
														}
														?>
													</select>
													<span>Harga</span><br>
													<input class="form-control col-md-6" type="number" name="harga" id="harga" disabled><br>
													<span class="mb-4">upload desain anda disini :</span>
													<input type="file" name="files" id="file">
													<input type="text" name="id_produk" value="<?php echo $id_produk1 ?>" hidden>
													<input class="form-control" type="number" value="1" name="qty" id="qty" hidden>
													<button type="submit" class="tocart" name="cart" id="cart">beli sekarang</button>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</div>
<?php endforeach; ?>
</div>

<section class="wn__product__area brown--color pt--80  pb--30">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="section__title text-center">
					<h2 class="title__be--2"><span class="color--theme">produk lainnya</span></h2>
					<hr>
				</div>
			</div>
		</div>
		<!-- Start Single Tab Content -->
		<div class="furniture--4 border--round arrows_style owl-carousel owl-theme row mt--50 ">
			<!-- Start Single Product -->
			<?php foreach ($produk as $row) : ?>
				<div class="product product__style--3">
					<div class="col-lg-3 col-md-4 col-sm-6 col-12">
						<div class="product__thumb">
							<a class="first__img" href="produk?id=<?= $row['id_produk']; ?>"><img src="img/<?= $row['gambar']; ?>" width="100" alt=""></a>
							<a class="second__img animation1" href="produk.php?id=<?= $row['id_produk']; ?>"><img src="img/<?= $row['gambar']; ?>" alt="product image"></a>
							<div class="hot__box">
								<span class="hot-label">BEST SELLER</span>
							</div>
						</div>
						<div class="product__content content--center">
							<h4><a href="single-product.html"><?= $row['jenis_produk']; ?></a></h4>
							<div class="action">
								<div class="actions_inner">
									<ul class="add_to_links">
										<li><a href="produk?id=<?= base64_encode($row['id_produk']); ?>"><i class=" bi bi-search"></i></a></li>
									</ul>
								</div>
							</div>
							<div class="product__hover--content">
								<ul class="rating d-flex">
									<li class="on"><i class="fa fa-star-o"></i></li>
									<li class="on"><i class="fa fa-star-o"></i></li>
									<li class="on"><i class="fa fa-star-o"></i></li>
									<li><i class="fa fa-star-o"></i></li>
									<li><i class="fa fa-star-o"></i></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<!-- End Single Tab Content -->
	</div>
</section>
</div>
<script type="text/javascript">
	<?php echo $jsArray; ?>

	function changeValue(x) {
		document.getElementById('harga').value = prdName[x].harga;
	};
</script>

<script type="text/javascript">
	var tm_pilih = document.getElementById('pilih');
	var file = document.getElementById('file');
	tm_pilih.addEventListener('click', function() {
		file.click();
	})
	file.addEventListener('change', function() {
		gambar(this);
	})

	function gambar(a) {
		if (a.files && a.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				document.getElementById('gambar').src = e.target.result;
			}
			reader.readAsDataURL(a.files[0]);
		}

	}
</script>



<?php
include 'include/_footer.php';
?>