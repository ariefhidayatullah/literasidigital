<?php
session_start();
require 'function.php';
include 'include/_header.php';

$user = query("SELECT * FROM user");

if (empty($_GET['cari'])) {
    echo "<script>location='error';</script>";
    exit();
}

$cari = $_GET['cari'];

$semuadata = array();
$ambil = $conn->query("SELECT * FROM produk WHERE jenis_produk LIKE '%$cari%' OR deskripsi LIKE '%$cari%'");
while ($pecah = $ambil->fetch_assoc()) {
    $semuadata[] = $pecah;
}

if (mysqli_num_rows($ambil) == 0) {
    echo "<script>alert('produk yang anda cari tidak ada');</script>";
    echo "<script>window.location ='daftarproduk';</script>";
}
?>

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
                        <h2 class="bradcaump-title">Daftar Produk</h2>
                        <nav class="bradcaump-content">
                            <a class="breadcrumb_item" href="index">Home</a>
                            <span class="brd-separetor">/</span>
                            <span class="breadcrumb_item active">hasil pencarian</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row pt--80  pb--30">
        <div class="col-lg-12">
            <div class="section__title text-center">
                <h2 class="title__be--2"><span class="color--theme">hasil pencarian</span></h2>
                <h2 class="title__be--2"><?= $cari ?></h2>
                <hr>
            </div>
        </div>
    </div>
    <div class="page-shop-sidebar left--sidebar bg--white section-padding--lg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12 order-1 order-lg-2">
                    <div class="tab__container">
                        <div class="shop-grid tab-pane fade show active" id="nav-grid" role="tabpanel">
                            <div class="row">
                                <?php foreach ($semuadata as $row) : ?>
                                    <!-- Start Single Product -->
                                    <div class="product product__style--3 col-lg-3 col-md-3 col-sm-3 col-12">
                                        <div class="product__thumb">
                                            <a class="first__img"><img src="img/<?= $row['gambar']; ?>" width="100" alt=""></a>
                                            <a class="second__img animation1"><img src="img/<?= $row['gambar']; ?>" width="100" alt=""></a>
                                            <div class="hot__box">
                                                <span class="hot-label">BEST SELLER</span>
                                            </div>
                                        </div>
                                        <div class="product__content content--center">
                                            <h4><a><?= $row['jenis_produk']; ?></a></h4>
                                            <ul class="prize d-flex">
                                                <li>Rp. <?= number_format($row['harga']); ?></li>
                                            </ul>
                                            <div class="action">
                                                <div class="actions_inner">
                                                    <ul class="add_to_links">
                                                        <li><a href="produk?id=<?= base64_encode($row['id_produk']); ?>"><i class=" bi bi-search"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product__hover--content">
                                                <ul class="rating d-flex">
                                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                                    <li class="on"><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <!-- End Single Product -->
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