<?php
session_start();
require 'function.php';
include 'include/_header.php';

if (!isset($_SESSION["LOGIN"])) {
    echo "<script> alert ('silahkan login terlebih dahulu') ; </script>";
    echo "<script>location='login'; </script>";
    exit();
}

$idpesan = $_GET["id"];
$ambil = $conn->query("SELECT * FROM pesan WHERE id_pesan = '$idpesan'");
$detail = $ambil->fetch_assoc();

$id_user = $detail['id_user'];

$id_userr = $_SESSION['LOGIN'];

$ong = mysqli_query($conn, "SELECT * FROM user WHERE email = '$id_userr'");
$ongk = mysqli_fetch_array($ong);

$id_userlogin = $ongk['id_user'];

if ($id_user !== $id_userlogin) {
    echo "<script>location='error';</script>";
    exit();
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
                        <h2 class="bradcaump-title">pembayaran</h2>
                        <nav class="bradcaump-content">
                            <a class="breadcrumb_item" href="index">Home</a>
                            <span class="brd-separetor">/</span>
                            <span class="breadcrumb_item active">input pembayaran</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="wn_contact_area bg--white pt--80 pb--80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="contact-form-wrap">
                        <h2 class="contact__title">Konfirmasi Pembayaran</h2>
                        <p>kirim bukti pembayaran anda disini . </p>
                        <div class="alert alert-info text-center">total tagihan anda <strong><?= number_format($detail['total_harga']); ?></strong></div>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="single-contact-form space-between">
                                <input type="nama" name="nama" placeholder="Nama Penyetor*">
                                <input type="text" name="bank" placeholder="Bank*">
                            </div>
                            <div class="single-contact-form space-between">
                                <input type="number" name="jumlah" min="1" placeholder="jumlah*">
                                <input type="file" name="bukti">
                            </div>
                            <div class="contact-btn">
                                <button type="submit" name="kirim">Kirim</button>
                            </div>
                        </form>
                    </div>
                    <?php
                    if (isset($_POST["kirim"])) {
                        // upload dulu foto bukti pembayaran
                        $namabukti = $_FILES["bukti"]["name"];
                        $lokasibukti = $_FILES["bukti"]["tmp_name"];
                        $namafiks = date("YmdHis") . $namabukti;
                        move_uploaded_file($lokasibukti, "images/bukti_pembayaran/$namafiks");

                        $nama = $_POST["nama"];
                        $bank = $_POST["bank"];
                        $jumlah = $_POST["jumlah"];
                        $tanggal = date("Y-m-d");

                        $conn->query("INSERT INTO pembayaran VALUES ('', '$idpesan', '$nama', '$bank', '$jumlah', '$tanggal', '$namafiks')");

                        $conn->query("UPDATE pesan SET status_pemesanan = 'pembayaran berhasil (menunggu pengiriman dari admin)' WHERE id_pesan ='$idpesan'");

                        echo "<script>alert('terima kasih telah melakukan pembayaran');</script>";
                        echo "<script>location='riwayatpemesanan';</script>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
</div>


<?php
include 'include/_footer.php';
?>