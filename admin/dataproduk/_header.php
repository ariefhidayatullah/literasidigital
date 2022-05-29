  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
          <div class="sidebar-brand-icon rotate-n-15">
              <i class="fas fa-laugh-wink"></i>
          </div>
          <div class="sidebar-brand-text mx-3">The King <sup>2</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
          <a class="nav-link" href="../dashboard/index.php">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>Dashboard</span></a>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
              <i class="fas fa-fw fa-folder"></i>
              <span>Daftar Akun</span>
          </a>
          <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">login Admin / User</h6>
                  <a class="collapse-item" href="../auth/register.php">tambah akun admin</a>
                  <a class="collapse-item" href="../pengguna/datauser.php">list user / pengguna</a>
              </div>
          </div>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item active">
          <a class="nav-link" href="../dataproduk/dataproduk.php">
              <i class="fas fa-fw fa-table"></i>
              <span>Data Produk</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
          <a class="nav-link" href="../databahan/databahan.php">
              <i class="fas fa-fw fa-table"></i>
              <span>Data Bahan</span></a>
      </li>

      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagess" aria-expanded="true" aria-controls="collapsePages">
              <i class="fas fa-fw fa-folder"></i>
              <span>transaksi</span>
          </a>
          <div id="collapsePagess" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">detail pemesanan</h6>
                  <a class="collapse-item" href="../transaksi/pembayaran/pembayaran.php">pembayaran</a>
                  <a class="collapse-item" href="../transaksi/pemesanan/pemesanan.php">pemesanan</a>
              </div>
          </div>
      </li>

      <li class="nav-item">
          <a class="nav-link" href="../auth/logout.php">
              <i class="fas fa-fw fa-power-off"></i>
              <span>Logout</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

  </ul>
  <!-- End of Sidebar -->