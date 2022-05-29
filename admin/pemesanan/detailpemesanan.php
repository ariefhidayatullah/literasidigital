<?php
require 'function.php';
$id = $_GET['id'];
$bahan = query("SELECT * FROM detail_pemesanan WHERE id_pesan = '$id'");

$bayar = mysqli_query($conn, "SELECT * FROM pembayaran WHERE id_pesan = '$id'");
$pembayaran = mysqli_fetch_array($bayar);

$pesan = mysqli_query($conn, "SELECT * FROM pesan WHERE id_pesan = '$id'");
$detailpesan = mysqli_fetch_array($pesan);
$nama_kabkot = $detailpesan['nama_kabkot'];
$status_pesan = $detailpesan['status_pemesanan'];

$ongkir = mysqli_query($conn, "SELECT * FROM kabkot WHERE nama_kabkot = '$nama_kabkot'");
$detailongkir = mysqli_fetch_array($ongkir);

include '../_header.php';
?>



<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800 text-center">DETAIL PESANAN</h1>
    <div class="row">
        <div class="col-md-4">
            <h3>Pemesanan</h3>
            <p>
                Tanggal : <?= $detailpesan['tanggal_pemesanan']; ?><br>
                Total pemesanan : <?= $detailpesan['total_harga']; ?><br>
                Status : <?= $detailpesan['status_pemesanan']; ?><br>
            </p>
        </div>
        <div class="col-md-4">
            <h3>pelanggan</h3>
            <strong><?= $detailpesan['nama_user']; ?></strong>
            <p>
                no hp : <?= $detailpesan['nohp_user']; ?><br>
                email : <?= $detailpesan['email']; ?><br>
            </p>
        </div>
        <div class="col-md-4">
            <h3>pengiriman</h3>
            <strong><?= $nama_kabkot ?></strong>
            <p>
                tarif :Rp. <?= number_format($detailongkir['jne_reg']); ?><br>
                alamat : <?= $detailpesan['alamat']; ?><br>
            </p>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>desain</th>
                            <th>nama produk</th>
                            <th>nama bahan</th>
                            <th>harga</th>
                            <th>jumlah</th>
                            <th>subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($bahan as $row) : ?>
                            <?php
                            $produk = $row['id_produk'];
                            $bahan = $row['id_bahan'];

                            $p = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = '$produk'");
                            $pp = mysqli_fetch_array($p);

                            $b = mysqli_query($conn, "SELECT * FROM bahan WHERE id_bahan = '$bahan'");
                            $bb = mysqli_fetch_array($b);
                            ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><img src="../../frontend/images/desainuser/<?= $row['desain']; ?>" width="100"></td>
                                <td><?= $pp['jenis_produk']; ?></td>
                                <td><?= $bb['nama_bahan']; ?></td>
                                <td><?= $row['harga_satuan']; ?></td>
                                <td><?= $row['qty']; ?></td>
                                <td><?= $row['harga_satuan'] * $row['qty']; ?></td>
                            </tr>
                            <?php $i++ ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="text-center">
                    <?php if ($status_pesan !== "pending") : ?>
                        <a href="pembayaran.php?id=<?= $row['id_pesan']; ?>" class="btn btn-success btn-sm"><i class="fas fa-check"></i> masukkan no resi</a>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php
include '../_footer.php';
?>