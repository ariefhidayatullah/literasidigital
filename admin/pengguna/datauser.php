<?php
require 'function.php';
$bahan = query('SELECT * FROM user');
include '../_header.php';
?>
<!-- Begin Page Content -->
<div class="container-fluid text-center">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data user</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>nama user</th>
                            <th>email</th>
                            <th>no hp user</th>
                            <th>alamat</th>
                            <th>kode pos</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($bahan as $row) : ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $row['nama_user']; ?></td>
                                <td><?= $row['email']; ?></td>
                                <td><?= $row['nohp_user']; ?></td>
                                <td><?= $row['alamat']; ?></td>
                                <td><?= $row['kodepos']; ?></td>
                                <td>
                                    <a href="hapus.php?id=<?= $row['id_user']; ?>" onclick="return confirm('apakah anda yakin ? ');" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
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
<?php include '../_footer.php'; ?>