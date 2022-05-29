<footer id="wn__footer" class="footer__area bg__cat--8 brown--color">
    <div class="footer-static-top">
        <div class="container">
            <div class="row">
                <div class="wn__address col-lg-6">
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
                <div class="col-lg-6">
                    <div class="footer__widget footer__menu">
                        <div class="ft__logo">
                            <a href="index">
                                <img src="images/logo/3.png" alt="logo">
                            </a>
                            <p>JL Ki S. Mngunsarkoro, No 52, Kampung Templek Kec. Bondowoso, Kabupaten Bondowoso, Jawa Timur 68211 </p>
                        </div>
                        <div class="footer__content">
                            <ul class="social__net social__net--2 d-flex justify-content-center">
                                <li><a href="#"><i class="bi bi-facebook"></i></a></li>
                                <li><a href="#"><i class="bi bi-google"></i></a></li>
                                <li><a href="#"><i class="bi bi-twitter"></i></a></li>
                                <li><a href="#"><i class="bi bi-linkedin"></i></a></li>
                                <li><a href="#"><i class="bi bi-youtube"></i></a></li>
                            </ul>
                            <ul class="mainmenu d-flex justify-content-center">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright__wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="copyright">
                        <div class="copy__right__inner text-left">
                            <p>Copyright <i class="fa fa-instagram"></i> <a href="https://www.instagram.com/arfhdytllh_/">.arfhdytllh_</a> </p>
                            <p>Copyright <i class="fa fa-instagram"></i> <a href="https://www.instagram.com/bimabgskr_/">.bimabgskr_</a> </p>
                        </div>
                    </div>
                </div>
<?php if (isset($_SESSION["LOGIN"])) : ?>
                    <?php foreach ($user as $row) : ?>
                        <script type="text/javascript">
                            var _smartsupp = _smartsupp || {};
                            _smartsupp.key = '535088b9b191a116a7e929a012c155e8aaa797c3';
                            window.smartsupp || (function(d) {
                                var s, c, o = smartsupp = function() {
                                    o._.push(arguments)
                                };
                                o._ = [];
                                s = d.getElementsByTagName('script')[0];
                                c = d.createElement('script');
                                c.type = 'text/javascript';
                                c.charset = 'utf-8';
                                c.async = true;
                                c.src = 'https://www.smartsuppchat.com/loader.js?';
                                s.parentNode.insertBefore(c, s);
                            })(document);
                        </script>
                    <?php endforeach; ?>
                <?php else : ?>
                <?php endif ?>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="payment text-right">
                        <img src="images/icons/payment.png" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script>
    $(document).ready(function() {

        // validasi nohp
        $('#cari').on('keyup', function() {
            var regex = /^[a-z]+$/;
            if (regex.test(this.value) !== true) {
                this.value = this.value.replace(/[^a-z]+/, '');
            } else {

            }

        });

    });
</script>
<script src="js/vendor/jquery-3.2.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/active.js"></script>

</body>

</html>