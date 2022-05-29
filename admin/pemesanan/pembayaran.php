<?php
require 'function.php';
include '../_header.php';

$id_pemesanan = $_GET['id'];
$pesan = mysqli_query($conn, "SELECT * FROM pembayaran WHERE id_pesan = '$id_pemesanan'");
$detailpesan = mysqli_fetch_assoc($pesan);


?>


<div class="row container">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Data pembayaran</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <div class="text-center">
                        <h6 class="m-0 font-weight-bold text-info">struk pembayaran : </h6>
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" width="300" src="../../frontend/images/bukti_pembayaran/<?= $detailpesan['bukti']; ?>" alt="">
                    </div>
                    <p>Nama pengirim : <?= $detailpesan['nama'] ?></a><br>
                        <p>Bank : <?= $detailpesan['bank'] ?></a><br>
                            <p>Jumlah : Rp. <?= number_format($detailpesan['jumlah']) ?></a><br>
                                <p>Tanggal pengiriman : <?= $detailpesan['tanggal'] ?></a><br>
                </div>
            </div>
        </div>

    </div>
    <div class="col-lg-6">
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-success">Konfirmasi pembayaran : </h6>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label>No Resi Pengiriman : </label>
                        <input type="text" class="form-control" name="resi">
                    </div>
                    <div class="form-group">
                        <select name="status" class="form-control">
                            <option value="">pilih status</option>
                            <option value="barang sedang di proses">barang sedang di proses</option>
                            <option value="barang dikirim">barang di kirim</option>
                            <option value="batal">barang gagal di proses</option>
                        </select>
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
</div>


<?php
if (isset($_POST["proses"])) {
    $username = $_SESSION['login'];
    $result1 = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");
    $row1 = mysqli_fetch_array($result1);
    $id_admin = $row1["id_admin"];
    $resi = $_POST["resi"];
    $status = $_POST["status"];
    $conn->query("UPDATE pesan SET id_admin = '$id_admin', resi_pengiriman = '$resi', status_pemesanan = '$status' WHERE id_pesan = '$id_pemesanan'");

    echo "<script>alert('data pemesanan di proses');</script>";
    echo "<script>location='pemesanan.php';</script>";
}

?>

<?php
include '../_footer.php';
?>