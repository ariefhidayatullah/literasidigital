<?php
if (isset($_SESSION["LOGIN"])) {
    $email = $_SESSION["LOGIN"];
    $user = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
    $navbar = mysqli_query($conn, "SELECT * FROM keranjang WHERE email = '$email'");
    $keranjang = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM keranjang WHERE email = '$email'"));
}
$daftarproduk = query('SELECT * FROM produk order by rand()');


?>
<header id="wn__header" class="header__area header-menu header__absolute">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-6 col-lg-2">
                <div class="logo">
                    <a href="index">
                        <img src="images/logo/logo.png" alt="">
                    </a>
                </div>
            </div>
            <div class="col d-none d-lg-block">
                <nav class="mainmenu__nav">
                    <ul class="meninmenu d-flex">
                        <li class="drop"><a href="#">daftar produk</a>
                            <div class="megamenu mega02">
                                <ul class="item item01">
                                    <?php foreach ($daftarproduk as $row) : ?>
                                        <li><a href="produk?id=<?= base64_encode($row['id_produk']); ?>"><?= $row['jenis_produk']; ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </li>
                        <li class="drop"><a href="tentangkami">Tentang kami</a></li>
                        <li class="drop"><a class="search__active" href="#">cari produk</a></li>
                    </ul>
                </nav>
            </div>

            <div class="col-md-6 col-sm-6 col-6 col-lg-2">
                <ul class="header__sidebar__right d-flex justify-content-end align-items-center">
                    <li></li><?php if (isset($_SESSION["LOGIN"])) : ?>
                        <?php foreach ($user as $row) : ?>
                            <li class="shopcart"><a class="cartbox_active" href="#"><span class="product_qun"><?= $keranjang; ?></span></a>
                                <!-- Start Shopping Cart -->
                                <div class="block-minicart minicart__active">
                                    <div class="minicart-content-wrapper">
                                        <div class="micart__close">
                                            <span>tutup</span>
                                        </div>
                                        <div class="total_amount text-right">
                                            <span><?= $keranjang; ?> Pesanan dalam keranjang</span>
                                        </div>
                                        <? if ($keranjang == 0) {
                                           
                                        } ?>
                                        <div class="mini_action checkout">
                                            <a class="checkout__btn" href="chekout">Checkout Sekarang</a>
                                        </div>
                                        <div class="single__items">
                                            <?php $nomor = 1;
                                            $total1 = 0; ?>
                                            <?php
                                            while ($bb = mysqli_fetch_array($navbar)) {
                                                $id_cart = $bb['id_cart'];
                                                $id_produk = $bb['id_produk'];
                                                $id_bahan = $bb['id_bahan'];
                                                $harga_satuan = $bb['harga_satuan'];
                                                $qty = $bb['qty'];
                                                $gambar = $bb['gambar'];

                                                $subtotal = $harga_satuan * $qty;

                                                $quer = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = '$id_produk'");
                                                $b = mysqli_fetch_array($quer);
                                            ?>
                                                <div class="miniproduct">
                                                    <div class="item01 d-flex mt--20">
                                                        <div class="thumb">
                                                            <a><img src="images/desainuser/<?= $gambar ?>" alt="product images"></a>
                                                        </div>
                                                        <div class="content">
                                                            <h6><a href="product-details.html"><?= $b['jenis_produk']; ?></a></h6>
                                                            <span class="prize">Rp. <?= $harga_satuan; ?></span>
                                                            <div class="product_prize d-flex justify-content-between">
                                                                <span class="qun">jumlah : <?= $qty; ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php $nomor++; ?>
                                                <?php
                                                $total1 = $total1 + $subtotal;
                                                ?>
                                            <?php } ?>
                                        </div>
                                        <div class="total_amount text-right">
                                            <span>Keranjang Total : Rp. <?= $total1; ?></span>
                                        </div>
                                        <div class="mini_action cart">
                                            <a class="cart__btn" href="cart">Lihat dan edit keranjang</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="setting__bar__icon"><a class="setting__active" href="#"></a>
                                <div class="searchbar__content setting__block">
                                    <div class="content-inner">
                                        <div class="switcher-currency">
                                            <strong class="label switcher-label">
                                                <span>My Account</span>
                                            </strong>
                                            <div class="switcher-options">
                                                <div class="switcher-currency-trigger">
                                                    <div class="setting__menu">
                                                        <span><a href="profil?id=<?= $row['id_user']; ?>" type="hidden">profil</a></span>
                                                        <span><a href="riwayatpemesanan">riwayat pemesanan</a></span>
                                                        <span><a href="logout">Keluar</a></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <li class="drop"><a href="login">login / registrasi</a></li>
                    <?php endif ?>
                </ul>
            </div>
            <!-- </div> -->
        </div>
    </div>
<div class="brown--color box-search-content search_active block-bg close__top">
        <form id="search_mini_form" class="minisearch" action="pencarian.php" method="get">
            <div class="field__search">
                <input type="text" name="cari" id="cari" placeholder="cari produk anda disini...">
                <div class="action">
                    <input type="submit" value="Cari">
                </div>
            </div>
        </form>
        <div class="close__wrap">
            <span>close</span>
        </div>
    </div>
    
</header>