<?php
require 'function.php';

include '../_header.php';
$bahan = query('SELECT * FROM bahan');
$produk = query('SELECT * FROM produk where id_produk');


if (isset($_POST["submit"])) {

  //cek data berhasil ditambah atau tidak
  if (tambah($_POST) > 0) {
    echo "
      <script>
        alert('data berhasil ditambah');
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

<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid text-center">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Data Bahan</h1>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nama Bahan</th>
              <th>Nama Produk</th>
              <th>Harga</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php
            $query = mysqli_query($conn, "SELECT * FROM bahan");
            while ($data = mysqli_fetch_array($query)) {
              $id_bahan    = $data['id_bahan'];
              $nama_bahan  = $data['nama_bahan'];
              $id_produk   = $data['id_produk'];
              $harga_satuan = $data['harga_satuan'];
            ?>
              <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $nama_bahan; ?></td>
                <td><?php
                    $ba = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = '$id_produk'");
                    $ba1 = mysqli_fetch_array($ba);
                    echo $ba1['jenis_produk'];
                    ?></td>
                <td><?php echo $harga_satuan; ?></td>
                <td>
                  <button hidden data-toggle="modal" data-id="<?= $id_bahan; ?>" data-target="#myModal" class="btn btn-warning btn-sm">Edit</button></a>
                  <a href="ubah.php?id=<?= $id_bahan; ?>" class="btn btn-info btn-circle btn-sm"><i class="fas fa-info-circle"></i></a>
                  <a href="hapus.php?id=<?= $id_bahan; ?>" onclick="return confirm('apakah anda yakin ? ');" class="btn btn-danger btn-circle btn-sm">
                    <i class="fas fa-trash"></i></a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        <a href="tambah.php" class="btn btn-primary text-right" role="button">Tambah data</a>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

<?php
include '../_footer.php';
?>