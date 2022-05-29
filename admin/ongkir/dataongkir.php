<?php
require 'function.php';
$bahan = query('SELECT * FROM kabkot');

include '../_header.php';

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

?>

<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid text-center">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data ongkir</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>nama provinsi</th>
                            <th>Nama kabupaten</th>
                            <th>ongkir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM kabkot");
                        while ($data = mysqli_fetch_array($query)) {
                            $id_kabkot  = $data['id_kabkot'];
                            $nama_kabkot  = $data['nama_kabkot'];
                            $jne_reg   = $data['jne_reg'];
                            $id_prov = $data['id_prov'];

                            $quer = mysqli_query($conn, "SELECT * FROM prov WHERE id_prov = '$id_prov'");
                            $b = mysqli_fetch_array($quer);
                            $provinsi = $b["nama_prov"];
                        ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $provinsi ?></td>
                                <td><?= $nama_kabkot; ?></td>
                                <td><?= $jne_reg; ?></td>
                                <td>
                                    <a href="ubah.php?id=<?= $id_kabkot; ?>" class="btn btn-info btn-circle btn-sm"><i class="fas fa-info-circle"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <a href="tambah.php" class="btn btn-primary text-right" role="button"> Tambah data </a>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php
include '../_footer.php';
?>