<?php
require 'function.php';
include '../_header.php';

$semuadata = array();
$tgl_mulai = '-';
$tgl_selesai = '-';
if (isset($_POST["proses"])) {
    $tgl_mulai = $_POST["tglm"];
    $tgl_selesai = $_POST["tgls"];
    $ambil = $conn->query("SELECT * FROM pesan pm LEFT JOIN user pl ON  pm.id_user=pl.id_user WHERE tanggal_pemesanan BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
    while ($pecah = $ambil->fetch_assoc()) {
        $semuadata[] = $pecah;
    }
}

?>

<div class="row container">
    <div class="col-lg-6 offset-3">
        <div class="card mb-4">
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-success">Pilih sesuai keinginan</h6>
            </a>
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label>tanggal mulai : </label>
                            <input type="date" class="form-control" name="tglm" value="<?= $tgl_mulai ?>">
                        </div>
                        <div class="form-group">
                            <label>tanggal selesai : </label>
                            <input type="date" class="form-control" name="tgls" value="<?= $tgl_selesai ?>">
                        </div>
                        <button class="btn btn-primary" name="proses">Proses</button>
                        <a href="pemesanan.php" class="btn btn-secondary btn-icon-split btn-sm">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-right"></i>
                            </span>
                            <span class="text">kembali</span>
                        </a>
                    </form>
                </div>
            </div>
        </div>

        <?php
        if (empty($semuadata)) {
            echo "<script> alert ('silahkan pilih tanggal lalu klik proses ') ; </script>";
            return;
        }
        ?>
    </div>

    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Laporan pemesanan : <?= $tgl_mulai ?> hingga <?= $tgl_selesai; ?></h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>user</th>
                                <th>tanggal</th>
                                <th>jumlah</th>
                                <th>status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0; ?>
                            <?php $i = 1; ?>
                            <?php foreach ($semuadata as $row) : ?>
                                <?php $total += $row["total_harga"] ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $row["nama_user"]; ?></td>
                                    <td><?= $row["tanggal_pemesanan"]; ?></td>
                                    <td>Rp. <?= number_format($row["total_harga"]); ?></td>
                                    <td><?= $row["status_pemesanan"]; ?></td>
                                </tr>
                                <?php $i++ ?>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6 col-md-6 mb-4 offset-3">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">total pesanan</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $total; ?> Pesanan</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-cart-arrow-down fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include '../_footer.php';
?>