<?php
require 'function.php';
session_start();
if (!isset($_SESSION['login'])) {
	header("Location: auth/login.php");
	exit;
}

if (isset($_POST["submit"])) {

	//cek data berhasil ditambah atau tidak
	if (tambah($_POST) > 0) {
		echo "
			<script>
				alert('data berhasil ditambah');
				document.location.href = 'databahan.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal ditambah'); 
				
			</script>
		";
	}
}

include '../_header.php';

$carikode = mysqli_query($conn, "SELECT id_bahan FROM bahan ") or die(mysqli_error($id_bahan));
// menjadikannya array
$datakode = mysqli_fetch_array($carikode);
$jumlah_data = mysqli_num_rows($carikode);
// jika $datakode
if ($datakode) {
	// membuat variabel baru untuk mengambil kode barang mulai dari 1
	$nilaikode = substr($jumlah_data[0], 1);
	// menjadikan $nilaikode ( int )
	$kode = (int) $nilaikode;
	// setiap $kode di tambah 1
	$kode = $jumlah_data + 1;
	// hasil untuk menambahkan kode
	// angka 3 untuk menambahkan tiga angka setelah B dan angka 0 angka yang berada di tengah
	// atau angka sebelum $kode
	$kode_otomatis = "B" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
	$kode_otomatis = "B001";
}


?>
<div class="container text-center">
	<div class="text-center">
		<h1 class="h4 text-gray-900 mb-4">Tambahkan Bahan!</h1>
	</div>

	<div class="row">
		<div class="col-lg-6 offset-3">
			<form class="user" method="post" action="">
				<input type="hidden" class="form-control form-control-static text-center" id="id_bahan" name="id_bahan" required value="<?= $kode_otomatis; ?>" readonly>
				<div class="form-group ">
					<div class="col mb-3 mb-sm-0">
						<label for="nama_bahan">Nama Bahan :</label>
						<input type="text" class="form-control form-control-static text-center" id="nama_bahan" name="nama_bahan" required placeholder="Masukkan Nama Bahan">
					</div>
				</div>
				<div class="form-group row">
					<div class="col mb-3 mb-sm-0">
						<label for="id_produk">nama Produk : </label>
						<select class="form-control" name="id_produk" id="id_produk">
							<option>Pilih Produk : </option>
							<?php
							$q = mysqli_query($conn, "SELECT * FROM produk");
							while ($row = mysqli_fetch_array($q)) {
								echo "<option value=$row[id_produk]>$row[jenis_produk]</option>";
							} ?>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<div class="col mb-3 mb-sm-0">
						<label for="harga_satuan">Harga :</label>
						<input type="text" class="form-control form-control-static text-center" id="harga_satuan" name="harga_satuan" required placeholder="Masukkan Jumlah Harga">
					</div>
				</div>
				<div class="pull-right text-center">
					<input class="btn btn-primary" name="submit" type="submit" value="Tambahkan!"></input>
					<a href="databahan.php" class="btn btn-secondary btn-icon-split btn-sm">
						<span class="icon text-white-50">
							<i class="fas fa-arrow-right"></i>
						</span>
						<span class="text">Kembali</span></a>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
include '../_footer.php';
?>