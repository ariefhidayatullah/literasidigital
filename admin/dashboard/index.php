<?php
require_once "../dataproduk/function.php";

include '../_header.php';
?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>
  <p><?= $_SESSION['login']; ?>, Selamat datang di dashboard The King </p>

  <!-- Content Row -->
  <div class="row">
    <?php $pen = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(total_harga) as tot FROM pesan WHERE status_pemesanan ='pending' ")); ?>
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2 text-center">
              <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Pendapatan (pending)</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?php if ($pen['tot'] == NULL) {
                                                                        echo "0";
                                                                      } else {
                                                                        echo (number_format($pen['tot']));
                                                                      } ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php $pen = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(total_harga) as tot FROM pesan WHERE status_pemesanan ='barang dikirim' ")); ?>
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2 text-center">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pendapatan (barang telah dikirim ke pengguna)</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?php if ($pen['tot'] == NULL) {
                                                                        echo "0";
                                                                      } else {
                                                                        echo (number_format($pen['tot']));
                                                                      } ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php  ?>
    <?php $penn = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(total_harga) as tott FROM pesan WHERE status_pemesanan = 'pembayaran berhasil (menunggu pengiriman dari admin)' ")); ?>
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2 text-center">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pendapatan (sementara)</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?php if ($penn['tott'] == NULL) {
                                                                        echo "0";
                                                                      } else {
                                                                        echo (number_format($penn['tott']));
                                                                      } ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php $user = mysqli_num_rows(mysqli_query($conn, "SELECT * from user")); ?>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">user(pengguna)</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $user; ?> pengguna</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>


    <?php $produk = mysqli_num_rows(mysqli_query($conn, "SELECT * from produk")); ?>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Data Produk</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $produk; ?> Produk</div>
            </div>
            <div class="col-auto">
              <i class="fas  fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php $bahan = mysqli_num_rows(mysqli_query($conn, "SELECT * from bahan")); ?>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Data Bahan</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $bahan; ?> Bahan</div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php $admin = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM admin")); ?>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Admin</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $admin; ?> Admin</div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user-astronaut fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php $keranjang = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM keranjang")); ?>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">keranjang belanja</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $keranjang; ?> keranjang</div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-cart-plus fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php $pemesanan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pesan WHERE status_pemesanan = 'pembayaran berhasil (menunggu pengiriman dari admin)'")); ?>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pesanan (pembayaran berhasil)</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $pemesanan; ?> Pesanan</div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-cart-arrow-down fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php $pending = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pesan WHERE status_pemesanan = 'pending'")); ?>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pesanan (pending)</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $pending; ?> Pesanan</div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-cart-arrow-down fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
<!-- /.container-fluid -->

<?php include '../_footer.php'; ?>