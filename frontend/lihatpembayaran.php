<?php
session_start();
require 'function.php';
include 'include/_header.php';

$idpesan = $_GET["id"];

$ambil = $conn->query("SELECT * FROM pembayaran LEFT JOIN pesan ON pembayaran.id_pesan=pesan.id_pesan WHERE pesan.id_pesan = '$idpesan'");
$detailbayar = $ambil->fetch_assoc();

$email = $_SESSION["LOGIN"];
$ong = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
$ongk = mysqli_fetch_array($ong);
$id_user = $ongk["id_user"];


if (empty($detailbayar)) {
    echo "<script>alert(' belum ada data pembayaran !');</script>";
    echo "<script>location='riwayatpemesanan';</script>";
    exit();
}


if ($id_user !== $detailbayar["id_user"]) {
    echo "<script>location='error';</script>";
    exit();
}

?>
<!-- Main wrapper -->
<div class="wrapper" id="wrapper">
    
    <?php include 'include/navbar.php'; ?>
    

    <div class="ht__bradcaump__area bg-image--1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bradcaump__inner text-center">
                        <h2 class="bradcaump-title">pembayaran</h2>
                        <nav class="bradcaump-content">
                            <a class="breadcrumb_item" href="index">Home</a>
                            <span class="brd-separetor">/</span>
                            <span class="breadcrumb_item active">pembayaran</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt--50">
        <div class="row">
            <div class="col-lg-6 col-12">
                <div id="accordion" class="checkout_accordion" role="tablist">
                    <div class="payment">
                        <div class="che__header" role="tab" id="headingOne">
                            <a class="checkout__title" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <span>Detail pemesanan</span>
                            </a>
                        </div>
                        <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="payment-body"><strong> Nama pemesan : <?= $detailbayar["nama"] ?></strong><br>
                                bank: <?= $detailbayar["bank"] ?> <br>
                                Tanggal transfer : <?= $detailbayar["tanggal"] ?><br>
                                Jumlah : Rp.<?= number_format($detailbayar["jumlah"]); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12 mb-5">
                <div id="accordion" class="checkout_accordion" role="tablist">
                    <div class="payment">
                        <div class="che__header" role="tab" id="headingOne">
                            <a class="checkout__title" data-toggle="collapse" href="#collapseOn" aria-expanded="true" aria-controls="collapseOne">
                                <span>struk pemesanan</span>
                            </a>
                        </div>
                        <div id="collapseOn" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="payment-body"><img src="images/bukti_pembayaran/<?= $detailbayar["bukti"] ?>" alt="" class="img-responsive">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<?php
include 'include/_footer.php';
?>