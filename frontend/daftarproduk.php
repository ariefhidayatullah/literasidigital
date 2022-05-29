<?php
session_start();
require 'function.php';
include 'include/_header.php';

$user = query("SELECT * FROM user");

if (isset($_GET['submit'])) {
    $cari = $_GET['cari'];
    $query2 = "SELECT * FROM produk WHERE jenis_produk LIKE '%$cari%'";
    $bahan = mysqli_query($conn, $query2);
} else {
    $bahan = query('SELECT * FROM produk order by rand()');
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
                            <span class="breadcrumb_item active">Daftar Produk</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row pt--80  pb--30">
        <div class="col-lg-12">
            <div class="section__title text-center">
                <h2 class="title__be--2"><span class="color--theme">produk</span></h2>
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


                                <!-- start konten daftar produk -->
                                <?php foreach ($bahan as $row) : ?>
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
                                <!-- finish daftar produk  -->


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