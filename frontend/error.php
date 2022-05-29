<?php
session_start();
require 'function.php';
include 'include/_header.php';


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
                        <h2 class="bradcaump-title">404</h2>
                        <nav class="bradcaump-content">
                            <a class="breadcrumb_item" href="index">Home</a>
                            <span class="brd-separetor">/</span>
                            <span class="breadcrumb_item active">404</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="page_error section-padding--lg bg--white">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="error__inner text-center">
                        <div class="error__logo">
                            <a href="#"><img src="images/404.png" alt="error images"></a>
                        </div>
                        <div class="error__content">
                            <h2>kesalahan - tidak Ditemukan</h2>
                            <p>Sepertinya kamu tersesat! Coba cari di sini</p>
                            <div class="search_form_wrapper">
                                <form action="pencarian.php" method="get">
                                    <div class="form__box">
                                        <input type="text" name="cari" placeholder="cari disini...">
                                        <button><i class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>


<?php
include 'include/_footer.php';
?>