<?php
require 'function.php';
$bahan = query('SELECT * FROM pesan ORDER BY tanggal_pemesanan DESC');
include '../_header.php';
?>



<!-- Begin Page Content -->
<div class="container-fluid text-center">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">DATA PEMESANAN</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>nama user</th>
                            <th>tanggal pesan</th>
                            <th>status pemesanan</th>
                            <th>total harga</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($bahan as $row) : ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $row['nama_user']; ?></td>
                                <td><?= $row['tanggal_pemesanan']; ?></td>
                                <td><?= $row['status_pemesanan']; ?></td>
                                <td><?= $row['total_harga']; ?></td>
                                <td>
                                    <a href="detailpemesanan.php?id=<?= $row['id_pesan']; ?>" class="btn btn-info btn-circle btn-sm"><i class="fas fa-info-circle"></i></a>
                                    <?php
                                    if ($row['status_pemesanan'] !== "pending") : ?>
                                        <a href="pembayaran.php?id=<?= $row['id_pesan']; ?>" class="btn btn-success btn-circle btn-sm"><i class="fas fa-check"></i></a>
                                    <?php endif ?>
                                </td>
                            </tr>
                            <?php $i++ ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php
include '../_footer.php';
?>