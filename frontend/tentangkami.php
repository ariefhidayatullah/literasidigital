 <?php
    session_start();
    require 'function.php';
    include 'include/_header.php';

    $produk = query('SELECT * FROM produk order by rand()');

    ?>
 <div class="wrapper" id="wrapper">

     <?php include 'include/navbar.php'; ?>
     <div class="ht__bradcaump__area bg-image--1">
         <div class="container">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="bradcaump__inner text-center">
                         <h2 class="bradcaump-title">Tentang Kami</h2>
                         <nav class="bradcaump-content">
                             <a class="breadcrumb_item" href="index">Home</a>
                             <span class="brd-separetor">/</span>
                             <span class="breadcrumb_item active">Tentang kami</span>
                         </nav>
                     </div>
                 </div>
             </div>
         </div>
     </div>



     <section class="wn__team__area section-padding--lg bg--white">
         <div class="container">
             <div class="row">
                 <div class="col-lg-8 mt-5">
                     <img src="images/king.jpg" class="mt-4">
                 </div>
                 <div class="col-lg-4 md-mt-40 sm-mt-40">
                     <div class="wn__address">
                         <div class="text-center">
                             <h2 class="contact__title">Tentang Kami</h2>
                             <p>The King Advertising adalah sebuah tempat usaha percetakan di Bondowoso yang berdiri sejak tahun 2011. The King Printing melayani berbagai macam percetakan mulai. </p>
                             <p>The King Advertising telah beroperasi sejak tahun 2011 yang masih melayani percetakan unuk beberapa produk saja. Saat ini usaha ini telah berkembang pesat seperti yang telah diketahui bukan hanya melakukan percetakan saja namun dapat juga melayani jasa desain.</p>
                         </div>
                         <div class="wn__addres__wreapper">

                             <div class="single__address">
                                 <i class="icon-location-pin icons"></i>
                                 <div class="content">
                                     <span>Alamat :</span>
                                     <p>Jalan K.I.S Mangunsarkoro, kampung templek, Kelurahan Dabasah, Kecamatan Bondowoso, Kabupaten Bondowoso.</p>
                                 </div>
                             </div>

                             <div class="single__address">
                                 <i class="icon-phone icons"></i>
                                 <div class="content">
                                     <span>No Telepon :</span>
                                     <p>(+62)823 3111 6981 </p>
                                 </div>
                             </div>

                             <div class="single__address">
                                 <i class="icon-envelope icons"></i>
                                 <div class="content">
                                     <span>Alamat Email:</span>
                                     <p>digitaltheking@gmail.com</p>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-lg-4">
                     <div class="wn__team text-center">
                         <img src="images/bima.jpg" width="250">
                         <div class="content">
                             <h4>BIMA BAGASKARA</h4>
                             <p>PO (Product owner)</p>
                             <i class="fa fa-instagram"></i> <a href="https://www.instagram.com/bimabgskr_/">.bimabgskr_</a> </p>
                         </div>
                     </div>
                 </div>
                 <div class="col-lg-4 ">
                     <div class="wn__team text-center">
                         <img src="images/rizal.png" width="300">
                         <div class="content">
                             <h4>FABRYZAL PRAMUDYA</h4>
                             <p>Scrum master - Dev Team</p>
                             <i class="fa fa-instagram"></i> <a href="https://www.instagram.com/here_with_virgo/">.here_with_virgo</a>
                         </div>
                     </div>
                 </div>
                 <div class="col-lg-4">
                     <div class="wn__team text-center">
                         <img src="images/gw.jpg" width="250">
                         <div class="content">
                             <h4>MOHAMMAD ARIEF HIDAYATULLAH</h4>
                             <p>Designer - Dev Team - Programmer</p>
                             <i class="fa fa-instagram"></i> <a href="https://www.instagram.com/arfhdytllh_/">.arfhdytllh_</a>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>
 </div>
 </div>

 <?php
    include 'include/_footer.php';
    ?>