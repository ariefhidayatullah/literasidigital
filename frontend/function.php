<?php
//untuk koneksi
$conn = mysqli_connect('localhost', 'u5445042_kelompok6bws', 'kelompok6bws', 'u5445042_kelompok06bws');

//membuat function agar jadi satu, supaya jadi efektif dan efisien
function query($query)
{
	//untuk memasukkan variabel $conn karena kalau langsung tidak bisa, grgr scope
	global $conn;
	//membuat array kosong untuk menampung data
	$result = mysqli_query($conn, $query);
	//untuk mengambil data dari database
	$rows = [];

	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

function tambah($data)
{
	global $conn;
	//ambil data dari tiap elemen dalam form
	$id_produk = $data['id_produk'];
	$jenis_produk = $data['jenis_produk'];

	//upload Gambar

	$gambar = upload();
	if ($gambar == false) {
		return false;
	}

	//query insert data
	$query = "INSERT INTO produk VALUES ('$id_produk', '$jenis_produk', '$gambar')";
	mysqli_query($conn, $query);
	return  mysqli_affected_rows($conn);
}

function cari($key)
{
	$query = "SELECT * FROM produk WHERE nama LIKE '%$key%'";
	return query($query);
}

function upload()
{
	$namaFile = $_FILES['files']['name'];
	$ukuranFile = $_FILES['files']['size'];
	$error = $_FILES['files']['error'];
	$tmpName = $_FILES['files']['tmp_name'];

	//jika gambar tidak di upload

	if ($error === 4) {
		echo "<script>alert('Masukkan Gambar!!');</script>";
		return false;
		exit;
	}

	//jika yg di upload bukan gambar

	$valid = ['jpg', 'jpeg', 'png', 'jfif'];

	//explode untuk mengubah string menjadi array(memecah)
	// '.' yang mau di pecah selanjutnya
	$ekstensiGambar = explode('.', $namaFile);
	//mengambil array yang paling akhir (end)
	//menjadikan huruf kecil semua (strtolower())
	$ekstensiGambar = strtolower(end($ekstensiGambar));

	if (!in_array($ekstensiGambar, $valid)) {
		echo "<script>alert('yang anda Upload bukan Gambar!');</script>";
		return false;
	}

	//cek ukurannya terlalu besar

	if ($ukuranFile > 1000000) {
		echo "<script>
					alert('Gambar terlalu besar!');
			</script>";
		return false;
	}

	//membuat nama file baru

	$namaFileBaru = uniqid() . '.' . $ekstensiGambar;

	//jika lolos dari seleksi

	move_uploaded_file($tmpName, 'images/desainuser/' . $namaFileBaru);

	return $namaFileBaru;
}


function registrasi($data)
{
	global $conn;

	$nama_user = strtolower(stripcslashes($data["nama_user"]));
	$email = strtolower(stripcslashes($data["email"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);
	$nohp_user = strtolower(stripcslashes($data["nohp_user"]));
	$alamat = strtolower(stripcslashes($data["alamat"]));
	$kodepos = strtolower(stripcslashes($data["kodepos"]));
	$jenis_kelamin = strtolower(stripcslashes($data["jenis_kelamin"]));
	$provinsi = strtolower(stripcslashes($data["provinsi"]));
	$kabupaten = strtolower(stripcslashes($data["kabupaten"]));
	$kecamatan = strtolower(stripcslashes($data["kecamatan"]));

	$result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
	if (mysqli_fetch_assoc($result)) {
		echo "
            <script>
            alert ('mohon maaf email sudah terdaftar!');
            </script>";
		return false;
	}

	// cek konfirmasi password
	if ($password !== $password2) {
		echo "<script>
    alert('konfirmasi password tidak sesuai!');
	</script>";
		return false;
	}

	$uppercase = preg_match('@[A-Z]@', $password);
	$lowercase = preg_match('@[a-z]@', $password);
	$number    = preg_match('@[0-9]@', $password);

	if (!$uppercase || !$lowercase || !$number || strlen($password) <= 8) {
		echo "<script>
		alert('password harus lebih dari 6 karakter, mengandung huruf BESAR, huruf kecil dan angka');
		</script>";
		return false;
	}

	// tambahkan user baru ke database
	mysqli_query($conn, "INSERT INTO user VALUES ('', '$nama_user', '$email', '$password', '$jenis_kelamin', '$nohp_user', '$provinsi', '$kabupaten', '$kecamatan', '$alamat', '$kodepos')");
	echo "<script>
    alert('selamat datang anda sudah terdaftar, silakan lengkapi data anda!');
	</script>";
	$result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
	$roww = mysqli_fetch_array($result);
	$id_user = $roww['id_user'];
	$_SESSION["LOGIN"] = $roww['email'];
?>
	<meta http-equiv="refresh" content="0; URL=login.php?id=<?= $id_user ?>">
<?php
}

function tambahcart($data)
{
	global $conn;
	//ambil data dari tiap elemen dalam form
	$id_produk = $data['id_produk'];
	if (empty($data['nama_bahan'])) {
		echo "<script>
		alert('pilih bahan terlebih dahulu');
		</script>";
		echo "<script>location='produk?id=$_GET[id]'; </script>";
		exit;
	}
	$nama_bahan = $data['nama_bahan'];
	$bhn = mysqli_query($conn, "SELECT * FROM bahan WHERE nama_bahan = '$nama_bahan'");
	$req = mysqli_fetch_array($bhn);
	$id_bahan = $req['id_bahan'];
	$harga = $req['harga_satuan'];
	$qty = $data['qty'];
	$email = $_SESSION["LOGIN"];

	$gambar = upload();
	if ($gambar == false) {
		return false;
	}


	$cek_barang = "SELECT * FROM keranjang WHERE id_bahan = '$id_bahan'";
	$hasil_barang = mysqli_query($conn, $cek_barang);
	$hasil = mysqli_fetch_array($hasil_barang);

	if (mysqli_num_rows($hasil_barang) > 0) {
		$reesult = mysqli_query($conn, "SELECT * FROM keranjang WHERE email='$email'");
		if (mysqli_num_rows($reesult) == 1) {

			$insert = "INSERT INTO keranjang (id_cart, email, id_produk, id_bahan, harga_satuan, qty, gambar)
																		VALUES ('', '$email', '$id_produk', '$id_bahan', '$harga', '$qty', '$gambar')";
			mysqli_query($conn, $insert);
			return  mysqli_affected_rows($conn);
		} else {
			$totalstok = $qty + $hasil['qty'];
			$update = "UPDATE keranjang SET qty = '$totalstok' WHERE id_produk = '$id_produk' AND id_bahan = '$id_bahan'";
			mysqli_query($conn, $update);
			return  mysqli_affected_rows($conn);
		}
	} else {
		$update = "INSERT INTO keranjang (id_cart, email, id_produk, id_bahan, harga_satuan, qty, gambar)
					VALUES ('', '$email', '$id_produk', '$id_bahan', '$harga', '$qty', '$gambar')";
		mysqli_query($conn, $update);
		return  mysqli_affected_rows($conn);
	}
}

function ubahprofil($data)
{
	global $conn;
	// ambil data dari tiap elemen
	$id_user = $data['id_user'];
	$nama_user = $data['nama_user'];
	$email = $data['email'];
	$password = $data['password'];
	$jenis_kelamin = $data['jenis_kelamin'];
	$nohp_user = $data['nohp_user'];
	$provinsi = $data['provinsi'];
	$kabupaten = $data['kabupaten'];
	$kecamatan = $data['kecamatan'];
	$alamat = $data['alamat'];
	$kodepos = $data['kodepos'];

	//cek

	// if ($gambar == false) {
	// 	return false;
	// }

	//query insert data
	$query = "UPDATE user SET
			nama_user = '$nama_user' ,
			email = '$email',
			password = '$password',
			jenis_kelamin = '$jenis_kelamin',
			nohp_user = '$nohp_user',
			provinsi = '$provinsi',
			kabupaten = '$kabupaten',
			kecamatan = '$kecamatan',
			alamat = '$alamat',
			kodepos = '$kodepos'
			WHERE id_user = '$id_user'
			";
	mysqli_query($conn, $query);
	return  mysqli_affected_rows($conn);
}
