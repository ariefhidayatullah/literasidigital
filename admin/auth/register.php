<?php
require 'function.php';

include '../_header.php';

if (isset($_POST["register"])) {
  if (registrasi($_POST) > 0) {
    echo "<script> alert('user baru berhasil ditambahkan!');</script>";
  } else {
    echo mysqli_error($conn);
  }
}

$carikode = mysqli_query($conn, "SELECT id_admin FROM admin ") or die(mysqli_error($id_admin));
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
  $kode_otomatis = "ADM" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
  $kode_otomatis = "ADM001";
}


?>

<div class="container">

  <div class="text-center">
    <h1 class="h4 text-gray-900 mb-4">tambahkan akun!</h1>
  </div>
  <div class="row">
    <div class="col-lg-6 offset-3">
      <form class="user" method="post" action="">
        <div class="form-group row">
          <div class="col mb-3 mb-sm-0">
            <input type="hidden" class="form-control form-control-static" id="id_admin" name="id_admin" value="<?= $kode_otomatis; ?>" readonly>
          </div>
        </div>
        <div class="form-group row">
          <div class="col mb-3 mb-sm-0">
            <input type="text" class="form-control form-control-static" id="nama_admin" name="nama_admin" placeholder="masukkan nama admin....">
          </div>
        </div>
        <div class="form-group row">
          <div class="col mb-3 mb-sm-0">
            <input type="text" class="form-control form-control-static" id="username" name="username" placeholder="masukkan username...">
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <input type="password" class="form-control form-control-static" id="password" name="password" placeholder="Password">
          </div>
          <div class="col-sm-6">
            <input type="password" class="form-control form-control-static" id="password2" name="password2" placeholder="Repeat Password">
          </div>
        </div>
        <div class="form-group row">
          <div class="col mb-3 mb-sm-0">
            <input type="email" class="form-control form-control-static" id="email" name="email" placeholder="masukkan email...">
          </div>
        </div>
        <div class="form-group row">
          <div class="col mb-3 mb-sm-0">
            <input type="text" class="form-control form-control-static" id="nohp" name="nohp" placeholder="masukkan no hp...">
          </div>
        </div>
        <div class="text-center">
          <input class="btn btn-primary" name="register" type="submit" value="tambahkan!">
          </input>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
include '../_footer.php';
?>