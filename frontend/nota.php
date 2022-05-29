<?php
session_start();
include 'include/_header.php';
require 'function.php';

if (!isset($_SESSION["LOGIN"])) {
    echo "<script> alert ('silahkan login terlebih dahulu') ; </script>";
    echo "<script>location='login'; </script>";
    exit();
}

$lama = 1;

$query = "UPDATE pesan SET status_pemesanan = 'pemesanan di batalkan'
          WHERE DATEDIFF(CURDATE(), tanggal_pemesanan) > $lama";
$hasil = mysqli_query($conn, $query);

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
                        <h2 class="bradcaump-title">nota</h2>
                        <nav class="bradcaump-content">
                            <a class="breadcrumb_item" href="index">Home</a>
                            <span class="brd-separetor">/</span>
                            <span class="breadcrumb_item active">nota</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wn_contact_area section-padding--lg bg--white">
        <?php
        if (empty($_GET['id'])) {
            echo "<script>location='error';</script>";
            exit();
        }
        $ambil = $conn->query("SELECT * FROM pesan JOIN user ON pesan.id_user=user.id_user WHERE pesan.id_pesan='$_GET[id]'");
        $detail = $ambil->fetch_assoc();
        $id_kabkot = $detail['nama_kabkot'];
        $alamat = $detail['alamat'];

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
        <?php $value = $conn->query("SELECT * FROM kabkot WHERE nama_kabkot = '$id_kabkot'");
        $row2 = $value->fetch_assoc();
        $nama_kabkot = $row2['nama_kabkot'];
        $jne_reg = $row2['jne_reg'];
        ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12 md-mt-40 sm-mt-40">
                    <div class="container">
                        <div class="table-content wnro__table table-responsive">
                            <div class="wn__order__box">
                                <h3 class="onder__title">Pesanan anda</h3>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>no</th>
                                            <th>produk</th>
                                            <th>bahan</th>
                                            <th>Harga</th>
                                            <th>jumlah</th>
                                            <th>subharga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $nomor = 1; ?>
                                        <?php
                                        $ambil1 = $conn->query("SELECT * FROM detail_pemesanan WHERE id_pesan = '$_GET[id]'");
                                        ?>
                                        <?php while ($pecah = $ambil1->fetch_assoc()) { ?>
                                            <?php
                                            $produk = $pecah["id_produk"];
                                            $bahan = $pecah["id_bahan"];
                                            $gambar = $pecah["desain"];
                                            $ress = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = '$produk'");
                                            $arra = mysqli_fetch_array($ress);

                                            $res = mysqli_query($conn, "SELECT * FROM bahan WHERE id_bahan = '$bahan'");
                                            $arr = mysqli_fetch_array($res);
                                            ?>
                                            <tr>
                                                <td><img src="images/desainuser/<?= $gambar; ?>" width="100"></td>
                                                <td><?= $arra["jenis_produk"]; ?></td>
                                                <td><?= $arr["nama_bahan"]; ?></td>
                                                <td>Rp. <?= number_format($pecah["harga_satuan"]); ?></td>
                                                <td><?= $pecah["qty"]; ?></td>
                                                <td><?= $pecah['harga_satuan'] * $pecah['qty']; ?></td>
                                            </tr>
                                            <?php $nomor++; ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <ul class="total__amount">
                                    <li>Order Total <span>Rp . <?= number_format($detail['total_harga']); ?></span></li>
                                </ul>
                            </div>
                        </div>
                        <div id="accordion" class="checkout_accordion mt--30" role="tablist">
                            <div class="payment">
                                <div class="che__header" role="tab" id="headingOne">
                                    <a class="checkout__title" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <span>cek pembayaran</span>
                                    </a>
                                </div>
                                <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="payment-body">
                                        <p>
                                            silahkan melakukan pembayaran Rp . <?= number_format($detail['total_harga']); ?> ke <br>
                                            <strong>BANK MANDIRI 137-001088-3276 . Mohammad Arief Hidayatullah</strong>
                                        </p>
                                    </div>
                                    <div class="contact-form-wrap">
                                        <div class="contact-btn">
                                            <button type="submit" onclick="window.print()">Cetak nota</button>
                                            <a href="riwayatpemesanan"><button>riwayat pemesanan</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 md-mt-40 sm-mt-40">
                    <div id="accordion" class="checkout_accordion" role="tablist">
                        <div class="payment">
                            <div class="che__header" role="tab" id="headingOne">
                                <a class="checkout__title" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <span>Detail pemesanan</span>
                                </a>
                            </div>
                            <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="payment-body"><strong> no. pemesanan : <?= $detail['id_pesan']; ?></strong><br>
                                    tanggal: <?= $detail['tanggal_pemesanan']; ?> <br>
                                    Total : Rp. <?= number_format($detail['total_harga']); ?></div>
                            </div>
                        </div>
                    </div>
                    <div id="accordion" class="checkout_accordion mt--30" role="tablist">
                        <div class="payment">
                            <div class="che__header" role="tab" id="headingOne">
                                <a class="checkout__title" data-toggle="collapse" href="#collapseO" aria-expanded="true" aria-controls="collapseOne">
                                    <span>Detail pelanggan</span>
                                </a>
                            </div>
                            <div id="collapseO" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="payment-body"><strong><?= $detail['nama_user']; ?></strong>
                                    <p>
                                        <?= $detail['nohp_user']; ?> <br>
                                        <?= $detail['email']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="accordion" class="checkout_accordion mt--30" role="tablist">
                        <div class="payment">
                            <div class="che__header" role="tab" id="headingOne">
                                <a class="checkout__title" data-toggle="collapse" href="#collapseOn" aria-expanded="true" aria-controls="collapseOne">
                                    <span>Detail pengiriman</span>
                                </a>
                            </div>
                            <div id="collapseOn" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="payment-body"><strong><?= $nama_kabkot ?></strong><br>
                                    Ongkos kirim : Rp. <?= number_format($row2['jne_reg']); ?><br>
                                    Alamat : <?= $alamat; ?>
                                </div>
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