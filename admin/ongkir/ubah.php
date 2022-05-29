<?php
require 'function.php';

$id_bahan = $_GET['id'];

// var_dump($id);
//query data mahasiswa berdasarkan ID

$mhs = query("SELECT * FROM kabkot WHERE id_kabkot = '$id_bahan'");

if (isset($_POST["submit"])) {
    //cek data berhasil diubaahtau tidak
    if (ubah($_POST) > 0) {
        echo "
			<script>
				alert('data berhasil diubah');
					document.location.href = 'dataongkir.php';
			</script>
		";
    } else {
        echo "
			<script>
				alert('data gagal diubah'); 
			</script>
		";
    }
}

include '../_header.php';

?>


<!-- Begin Page Content -->
<div class="container text-center">
    <h1 class="h4 text-gray-900 mb-4">ubah data</h1>
    <?php foreach ($mhs as $row) : ?>
        <div class="row">
            <div class="col-lg-6 offset-3">
                <form class="user" action="" method="POST" enctype="multipart/form-data">
                    <input class="form-control form-control-static" type="hidden" name="id_kabkot" id="id_kabkot" required value="<?= $row['id_kabkot']; ?>" readonly>
                    <div class="form-group">
                        <div class="col mb-6 mb-sm-0">
                            <label for="nama_bahan">nama kabupaten : </label>
                            <input class="form-control form-control-static" type="text" name="nama_kabkot" required value="<?= $row['nama_kabkot']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col mb-3 mb-sm-0">
                            <label for="stok">ongkir : </label>
                            <input class="form-control form-control-static" type="text" name="jne_reg" id="stok" required value="<?= $row['jne_reg']; ?>">
                        </div>
                    </div>
                    <a href="databahan.php" class="btn btn-warning">
                        Kembali
                    </a>
                    <button class="btn btn-primary" name="submit" type="submit">
                        Ubah
                    </button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php
include '../_footer.php';
?>