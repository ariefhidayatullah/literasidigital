<?php
session_start();
require 'function.php';
include 'include/_header.php';


if (!isset($_SESSION["LOGIN"])) {
    echo "<script> alert ('silahkan login terlebih dahulu') ; </script>";
    echo "<script>location='login'; </script>";
}
$email = $_SESSION["LOGIN"];
$query = mysqli_query($conn, "SELECT * FROM keranjang WHERE email = '$email'");
$user = query("SELECT * FROM user WHERE email = '$email'");

?>


<div class="wrapper" id="wrapper">


    <?php include 'include/navbar.php'; ?>


    <div class="ht__bradcaump__area bg-image--1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bradcaump__inner text-center">
                        <h2 class="bradcaump-title">chekout</h2>
                        <nav class="bradcaump-content">
                            <a class="breadcrumb_item" href="index">Home</a>
                            <span class="brd-separetor">/</span>
                            <span class="breadcrumb_item active">chekout</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="wn__checkout__area section-padding--lg bg__white">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="wn_checkout_wrap">
                        <div class="checkout_info">
                            <span>Have a coupon? </span>
                            <a class="showcoupon" href="#">Click here to enter your code</a>
                        </div>
                        <div class="checkout_coupon">
                            <form action="#">
                                <div class="form__coupon">
                                    <input type="text" placeholder="Coupon code">
                                    <button>Apply coupon</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-12">
                    <?php foreach ($user as $row) : ?>
                        <div class="customer_details">
                            <h3>detail pengguna</h3>
                            <form action="" method="POST">
                                <div class="customar__field">
                                    <div class="input_box">
                                        <label>Nama <span>*</span></label>
                                        <input type="hidden" id="id_pesan" name="id_pesan" required value="" readonly>
                                        <?php
                                        $user1 = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
                                        $nama = mysqli_fetch_array($user1);
                                        ?>
                                        <input type="text" name="nama_user" id="nama_user" required value="<?= $row['nama_user']; ?>">
                                    </div>
                                    <div class="input_box">
                                        <label>No Hp <span>*</span></label>
                                        <input type="text" name="nohp_user" id="nohp_user" required value="<?= $row['nohp_user']; ?>">
                                    </div>
                                    <div class="input_box">
                                        <label>Alamat <span>*</span></label>
                                        <input type="text" name="alamat" id="alamat" required value="<?= $row['alamat']; ?>">
                                    </div>
                                    <div class="input_box">
                                        <label>Pesan <span>*</span></label>
                                        <input type="text" name="pesan" id="pesan" required placeholder="Isi pesan anda disini...">
                                    </div>
                                    <div class="input_box">
                                        <label>Kode pos <span>*</span></label>
                                        <input type="text" name="kodepos" id="kodepos" required value="<?= $row['kodepos']; ?>">
                                    </div>
                                    <div class="contact-form-wrap">
                                        <div class="contact-btn">
                                            <button type="submit" name="chekout">konfirmasi pembayaran</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>


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

                        $ambil = $conn->query("SELECT * FROM kec WHERE id_kec = '$kec'");
                        $detailbayar = $ambil->fetch_assoc();
                        $nama_kecamatan = $detailbayar["nama_kec"];

                        ?>
                        <div class="row">
                            <div class="col-lg-12 mt-3">
                                <div class="wn_checkout_wrap">
                                    <div class="checkout_info">
                                        <span>ganti alamat pengiriman ? </span>
                                        <a class="showcoupon" href="#">klik disini untuk ganti</a>
                                    </div>
                                    <div class="checkout_coupon">
                                        <form action="" method="POST">
                                            <div class="form__coupon">
                                                <div class="input_box">
                                                    <label>Provinsi <span>*</span></label><select name="provinsi" id="provinsi" class="select__option" required>
                                                        <option value="<?= $row['provinsi']; ?>"><?= $nama_provinsi ?></option>
                                                    </select>
                                                </div>
                                                <div class="form__coupon">
                                                    <div class="input_box mt-4">
                                                        <label>Kabupaten <span>*</span></label><select class="select__option" id="kabupaten" name="kabupaten" required>
                                                            <option value="<?= $row['kabupaten']; ?>"><?= $nama_kabupaten ?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form__coupon">
                                                    <div class="input_box mt-4 mb-4">
                                                        <label>Kecamatan <span>*</span></label><select class="select__option" id="kecamatan" name="kecamatan" required>
                                                            <option value="<?= $row['kecamatan']; ?>"><?= $nama_kecamatan ?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <button type="submit" name="ubah">ganti alamat</button>
                                            </div>
                                        </form>
                                    </div>
                                    <?php
                                    if (isset($_POST['ubah'])) {
                                        $provinsi = $_POST['provinsi'];
                                        $kabupaten = $_POST['kabupaten'];
                                        $kecamatan = $_POST['kecamatan'];

                                        mysqli_query($conn, "UPDATE user SET provinsi = '$provinsi', kabupaten = '$kabupaten', kecamatan = '$kecamatan' WHERE email = '$email'");

                                        echo "<script>alert('alamat berhasil di ganti !');</script>";
                                        echo "<script>location='chekout';</script>";
                                    }

                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="cart-main-area section-padding--lg bg--white">
                        <div class="container">
                            <div class="row">
                                <div class="table-content wnro__table table-responsive">
                                    <div class="wn__order__box">
                                        <h3 class="onder__title">pesanan kamu</h3>
                                        <table>
                                            <thead>
                                                <tr class="title-top">
                                                    <th>desain</th>
                                                    <th>produk</th>
                                                    <th>bahan</th>
                                                    <th>Harga</th>
                                                    <th>jumlah</th>
                                                    <th>total harga</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $nomor = 1;
                                                $total = 0; ?>
                                                <?php
                                                while ($data = mysqli_fetch_array($query)) {
                                                    $id_cart = $data['id_cart'];
                                                    $id_produk = $data['id_produk'];
                                                    $id_bahan = $data['id_bahan'];
                                                    $harga_satuan = $data['harga_satuan'];
                                                    $qty = $data['qty'];
                                                    $gambar = $data['gambar'];

                                                    $quer = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = '$id_produk'");
                                                    $b = mysqli_fetch_array($quer);

                                                    $query_bahan = mysqli_query($conn, "SELECT * FROM bahan WHERE id_bahan = '$id_bahan'");
                                                    $bahan = mysqli_fetch_array($query_bahan);
                                                ?>
                                                    <tr>
                                                        <td><img src="images/desainuser/<?= $gambar; ?>" width="100"></td>
                                                        <td class="product-name"><a href=""><?= $b['jenis_produk']; ?></a></td>
                                                        <td class="product-name"><a href=""><?= $bahan['nama_bahan']; ?></a></td>
                                                        <td class="product-price"><span class="amount">Rp. <?= $harga_satuan ?></span></td>
                                                        <td class="product-quantity">
                                                            <input type="text" name="id_cart" value="<?= $id_cart; ?>" hidden>
                                                            <input type="number" min="1" max="100" name="qty" placeholder="<?= $qty; ?>" readonly>

                                                        </td>
                                                        <td><?php $subtotal = $harga_satuan * $qty; ?>
                                                            <?= $subtotal; ?></td>
                                                    </tr>
                                                    <?php $nomor++; ?>
                                                    <?php
                                                    $total = $total + $subtotal;
                                                    ?>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <ul class="shipping__method">
                                            <li>Cart Subtotal <span>Rp. <?= $total; ?></span></li>
                                            <?php
                                            $result1 = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
                                            $row1 = mysqli_fetch_array($result1);
                                            $id_kabkot = $row1['kabupaten'];

                                            $ong = mysqli_query($conn, "SELECT * FROM kabkot WHERE id_kabkot = '$id_kabkot'");
                                            $ongk = mysqli_fetch_array($ong);
                                            $ongkir = $ongk['jne_reg'];

                                            $ordertotal = $total + $ongkir;

                                            ?>
                                            <li>ongkos kirim <span>Rp.<?= $ongkir ?></span>
                                            </li>
                                        </ul>
                                        <ul class="total__amount">
                                            <li>Order Total <span>Rp. <?= $ordertotal ?></span></li>
                                        </ul>
                                        <?php
                                        if (isset($_POST['chekout'])) {
                                            $id_pesan = $_POST['id_pesan'];
                                            $id_pelanggan = $nama['id_user'];
                                            $nama_user = $_POST['nama_user'];
                                            $email = $_SESSION["LOGIN"];
                                            $alamat = $_POST['alamat'];
                                            $pesan = $_POST['pesan'];
                                            $nohp_user = $_POST['nohp_user'];
                                            $id_kabkot = $ongk['nama_kabkot'];
                                            $tanggal_pembelian = date("Y-m-d");
                                            $now = strtotime(date("Y-m-d"));
                                            $date = date('Y-m-j', strtotime('+1 day', $now));

                                            mysqli_query($conn, "INSERT INTO pesan VALUES ('$id_pesan',' ', '$id_pelanggan', '$nama_user','$email','$nohp_user','$id_kabkot','$alamat', '$pesan', '$tanggal_pembelian', '$ordertotal', 'pending', '' )");

                                            $id_pesan_barusan = $conn->insert_id;

                                            $donal = mysqli_query($conn, "SELECT * FROM keranjang WHERE email = '$email'");

                                            foreach ($donal as $fetch) {
                                                $id_cart = $fetch['id_cart'];
                                                $id_produk = $fetch['id_produk'];
                                                $id_bahan = $fetch['id_bahan'];
                                                $harga_satuan = $fetch['harga_satuan'];
                                                $qty = $fetch['qty'];
                                                $desain = $fetch['gambar'];


                                                mysqli_query($conn, "INSERT INTO detail_pemesanan VALUES ('','$id_pesan_barusan','$id_produk','$id_bahan','1','$qty', '$harga_satuan', '$desain' )");

                                                mysqli_query($conn, "DELETE FROM keranjang WHERE id_cart = '$id_cart'");
                                            }

                                            echo "<script>alert('Pembelian Berhasil !');</script>";
                                            echo "<script>location='nota?id=$id_pesan_barusan';</script>";
                                        }

                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    $(document).ready(function() {
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
                $("#harga").append('<input value="' + result[i].id_kabkot + '"></input>');
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
?>