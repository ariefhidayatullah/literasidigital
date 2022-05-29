<?php
session_start();
include 'include/_header.php';
require 'function.php';

$id_user = $_SESSION["LOGIN"];

if (!isset($_SESSION["LOGIN"])) {
    echo "<script> alert ('silahkan login terlebih dahulu') ; </script>";
    echo "<script>location='login'; </script>";
    exit();
}


?>
<!-- Main wrapper -->
<div class="wrapper" id="wrapper">

    <!-- Header -->
    <?php include 'include/navbar.php'; ?>
    <!-- //Header -->
    <!-- Start Search Popup -->
    <div class="ht__bradcaump__area bg-image--1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bradcaump__inner text-center">
                        <h2 class="bradcaump-title">Riwayat pemesanan</h2>
                        <nav class="bradcaump-content">
                            <a class="breadcrumb_item" href="index">Home</a>
                            <span class="brd-separetor">/</span>
                            <span class="breadcrumb_item active">Riwayat pemesanan</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="cart-main-area section-padding--lg bg--white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 ol-lg-12">
                    <div class="table-content wnro__table table-responsive">
                        <table>
                            <thead>
                                <tr class="title-top">
                                    <th>no</th>
                                    <th>tanggal</th>
                                    <th>status</th>
                                    <th>total</th>
                                    <th>opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nomor = 1;
                                // mendapatkan id pelanggan yang login
                                $id_pelanggan = $_SESSION["LOGIN"];

                                $ong = mysqli_query($conn, "SELECT * FROM user WHERE email = '$id_pelanggan'");
                                $ongk = mysqli_fetch_array($ong);

                                $id_user = $ongk["id_user"];

                                $ambil = $conn->query("SELECT * FROM pesan WHERE id_user = '$id_user'");
                                while ($pecah = $ambil->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td class="product-name"><?= $nomor; ?></td>
                                        <td class="product-name"><?= $pecah["tanggal_pemesanan"] ?></td>
                                        <td class="product-name"><?= $pecah["status_pemesanan"] ?><br>
                                            <?php if (!empty($pecah["resi_pengiriman"])) : ?>
                                                Resi : <?= $pecah["resi_pengiriman"]; ?>
                                            <?php endif ?>
                                        </td>
                                        <td class="product-price">Rp. <?= number_format($pecah["total_harga"]) ?></td>
                                        <td>
                                            <div class="blog__btn">
                                                <a href="nota?id=<?= $pecah["id_pesan"] ?>">Nota</a> ||
                                                <?php if ($pecah['status_pemesanan'] == "pending") : ?>
                                                    <a href="pembayaran?id=<?= $pecah["id_pesan"] ?>">input Pembayaran</a>
                                                <?php else : ?>
                                                    <a href="lihatpembayaran?id=<?= $pecah["id_pesan"] ?>">lihat Pembayaran</a>
                                                <?php endif ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $nomor++; ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'include/_footer.php';
?>