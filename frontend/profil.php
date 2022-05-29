<?php
session_start();
require 'function.php';
include 'include/_header.php';

if (!isset($_SESSION["LOGIN"])) {
    echo "<script> alert ('silahkan login terlebih dahulu') ; </script>";
    echo "<script>location='login'; </script>";
    exit();
}

if (empty($_GET['id'])) {
    echo "<script>location='error';</script>";
    exit();
}

$id_user = $_GET['id'];
$user = query("SELECT * FROM user WHERE id_user = '$id_user'");

if (isset($_POST["submit"])) {
    //cek data berhasil diubah atau tidak
    if (ubahprofil($_POST) > 0) {
        echo "
			<script>
				alert('data berhasil diubah');
			</script>
        ";
?>
<?php
    } else {
        echo "
			<script>
				alert('data gagal diubah'); 
			</script>
		";
    }
}

?>
<!-- Main wrapper -->
<div class="wrapper" id="wrapper">
    <!-- Header -->
    <?php include 'include/navbar.php'; ?>
    <!-- //Header -->
    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area bg-image--4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bradcaump__inner text-center">
                        <h2 class="bradcaump-title">Ubah Profil</h2>
                        <nav class="bradcaump-content">
                            <a class="breadcrumb_item" href="index">Home</a>
                            <span class="brd-separetor">/</span>
                            <span class="breadcrumb_item active">ubah Profil</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="wn_contact_area bg--white pt--80 pb--80">
        <?php

        $id_userr = $_SESSION['LOGIN'];

        $ong = mysqli_query($conn, "SELECT * FROM user WHERE email = '$id_userr'");
        $ongk = mysqli_fetch_array($ong);

        $id_userlogin = $ongk['id_user'];

        if ($id_user !== $id_userlogin) {
            echo "<script>alert(' anda tidak berhak !');</script>";
            echo "<script>location='index';</script>";
            exit();
        }
        ?>
        <div class="container">
            <div class="row">
                <?php foreach ($user as $row) : ?>
                    <?php
                    $prov = $row["provinsi"];
                    $kabkot = $row["kabupaten"];
                    $kec = $row["kecamatan"];

                    $provinsi = mysqli_query($conn, "SELECT * FROM prov WHERE id_prov = '$prov'");
                    $query_provinsi = mysqli_fetch_array($provinsi);
                    $nama_provinsi = $query_provinsi["nama_prov"];

                    $kabupaten = mysqli_query($conn, "SELECT * FROM kabkot WHERE id_kabkot = '$kabkot'");
                    $query_kabupaten = mysqli_fetch_array($kabupaten);
                    $nama_kabupaten = $query_kabupaten["nama_kabkot"];

                    $kecamatan = mysqli_query($conn, "SELECT * FROM kec WHERE id_kec = '$kec'");
                    $query_kecamatan = mysqli_fetch_array($kecamatan);
                    $nama_kecamatan = $query_kecamatan["nama_kec"];


                    var_dump($kec);
                    ?>
                    <div class="col-lg-10 col-12 offset-1">
                        <div class="customer_details">
                            <h3>detail pengguna</h3>
                            <form action="" method="POST">
                                <div class="customar__field">
                                    <div class="margin_between">
                                        <div class="input_box space_between">
                                            <label>Nama <span>*</span></label>
                                            <input type="hidden" id="id_user" name="id_user" required value="<?= $row['id_user']; ?>" readonly>
                                            <input class="input__box" name="nama_user" id="nama_user" required value="<?= $row['nama_user']; ?>">
                                        </div>
                                        <div class="input_box space_between">
                                            <label>Email <span>*</span></label>
                                            <input class="input__box" name="email" id="email" required value="<?= $row['email']; ?>">
                                        </div>
                                    </div>
                                    <div class="margin_between">
                                        <div class="input_box space_between">
                                            <label>Password <span>*</span></label>
                                            <input class="input__box" type="password" name="password" id="password" required value="<?= $row['password']; ?>">
                                        </div>
                                        <div class="input_box space_between">
                                            <label>Jenis kelamin <span>*</span></label>
                                            <input class="input__box" name="jenis_kelamin" id="jenis_kelamin" required value="<?= $row['jenis_kelamin']; ?>">
                                        </div>
                                    </div>
                                    <div class="margin_between">
                                        <div class="input_box space_between">
                                            <label>No hp <span>*</span></label>
                                            <input class="input__box" name="nohp_user" id="nohp_user" required value="<?= $row['nohp_user']; ?>">
                                        </div>
                                        <div class="input_box space_between">
                                            <label>Alamat <span>*</span></label>
                                            <input class="input__box" name="alamat" id="alamat" required value="<?= $row['alamat']; ?>">
                                        </div>
                                    </div>
                                    <div class="margin_between">
                                        <div class="input_box space_between">
                                            <label>Provinsi <span>*</span></label><select name="provinsi" id="provinsi" class="select__option" required>
                                                <option value="<?= $row['provinsi']; ?>"><?= $nama_provinsi ?></option>
                                            </select>
                                        </div>
                                        <div class="input_box space_between">
                                            <label>Kabupaten <span>*</span></label><select class="select__option" id="kabupaten" name="kabupaten" required>
                                                <option value="<?= $row['kabupaten']; ?>"><?= $nama_kabupaten ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="margin_between">
                                        <div class="input_box space_between">
                                            <label>Kecamatan <span>*</span></label><select class="select__option" id="kecamatan" name="kecamatan" required>
                                                <option value="<?= $row['kecamatan']; ?>"><?= $nama_kecamatan ?></option>
                                            </select>
                                        </div>
                                        <div class="input_box space_between">
                                            <label>Kode pos <span>*</span></label>
                                            <input class="input__box" name="kodepos" id="kodepos" required value="<?= $row['kodepos']; ?>">
                                        </div>
                                    </div>
                                    <div class="contact-form-wrap">
                                        <div class="contact-btn">
                                            <button name="submit" type="submit" id="submit">update profil</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function() {

        // Validasi Nama Lengkap
        $('#nama_user').on('keyup', function() {
            var regex = /^[a-z A-Z]+$/;
            if (regex.test(this.value) !== true) {
                this.value = this.value.replace(/[^a-zA-Z]+/, '');
            } else if ($(this).val().length < 5) {
                $('.nama_user').text('Anda Yakin Nama Anda Terdiri Dari ' + $(this).val().length + ' Huruf?');
            } else {
                $('.nama_user').text('');
            }
            if ($(this).val().length == 0) {
                $('.nama_user').text('Nama Harus Di isi!');
            }
        });


        // validasi email
        $('#email').on('keyup', function() {
            var valid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!this.value.match(valid)) {
                $('.email').text('Isi Email dengan Benar!');
            } else {
                $('.email').text('');
            }
        });


        // validasi nohp
        $('#nohp_user').on('keyup', function() {
            var regex = /^[0-9]+$/;
            if (regex.test(this.value) !== true) {
                this.value = this.value.replace(/[^0-9]+/, '');
            } else {
                $('.nohp_user').text('');
            }

            if ($(this).val().length < 12) {
                $('.nohp_user').text('maksimal 12 angka!');
            } else {
                $('.nohp_user').text('');
            }

        });


        // validasi kode pos
        $('#kodepos').on('keyup', function() {
            var regex = /^[0-9]+$/;
            if (regex.test(this.value) !== true) {
                this.value = this.value.replace(/[^0-9]+/, '');
            } else {
                $('.kodepos').text('');
            }

            if ($(this).val().length < 5) {
                $('.kodepos').text('minimal 5 angka!');
            } else {
                $('.kodepos').text('');
            }

        });


        // Validasi jenis kelamin
        $('#jenis_kelamin').on('keyup', function() {
            var regex = /^[L  P l  p]+$/;
            if (regex.test(this.value) !== true) {
                this.value = this.value.replace(/[^L P]+/, '');
            } else {
                $('.jenis_kelamin').text('');
            }
            if ($(this).val().length == 0) {
                $('.jenis_kelamin').text('laki laki (L) atau perempuan (P)!');
            }
        });





        url = 'include/get_provinsi.php';
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(result) {
                for (var i = 0; i < result.length; i++)
                    $("#provinsi").append('<option value="' + result[i].id_prov + '">' + result[
                        i].nama_prov + '</option>');
            }
        });
    });
    $("#provinsi").change(function() {
        var id_prov = $("#provinsi").val();
        var url = 'include/get_kabupaten.php?id_prov=' + id_prov;
        $("#kabupaten").html('');
        $("#kecamatan").html('');
        $("#kabupaten").append('<option value="">Pilih</option>');
        $("#kecamatan").append('<option value="">Pilih</option>');
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(result) {
                for (var i = 0; i < result.length; i++)
                    $("#kabupaten").append('<option value="' + result[i].id_kabkot + '">' + result[
                        i].nama_kabkot + '</option>');
            }
        });
    });
    $("#kabupaten").change(function() {
        var id_kabkot = $("#kabupaten").val();
        var url = 'include/get_kecamatan.php?id_kabkot=' + id_kabkot;
        $("#kecamatan").html('');
        $("#kecamatan").append('<option value="">Pilih</option>');
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(result) {
                for (var i = 0; i < result.length; i++)
                    $("#kecamatan").append('<option value="' + result[i].id_kec + '">' + result[
                        i].nama_kec + '</option>');
            }
        });


    });
</script>

<?php
include 'include/_footer.php';
