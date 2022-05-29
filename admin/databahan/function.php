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
	$id_bahan = $data['id_bahan'];
	$nama_bahan = htmlspecialchars($data['nama_bahan']);
	$id_produk = $data['id_produk'];
	$harga_satuan = $data['harga_satuan'];


	//query insert data
	$query = "INSERT INTO bahan VALUES ('$id_bahan', '$nama_bahan', '$id_produk', '$harga_satuan')";
	mysqli_query($conn, $query);
	return  mysqli_affected_rows($conn);
}


// function hapus($id_produk)
// {
// 	global $conn;
// 	mysqli_query($conn, "DELETE FROM produk WHERE id_produk = $id_produk");
// 	return mysqli_affected_rows($conn);
// }

function ubah($data)
{
	global $conn;

	$id_bahan = $data['id_bahan'];
	$nama_bahan = $data['nama_bahan'];
	$id_produk = $data['id_produk'];
	$harga_satuan = $data['harga_satuan'];


	//query insert data
	$query = "UPDATE bahan SET 
			nama_bahan = '$nama_bahan',
			id_produk = '$id_produk',
			harga_satuan = '$harga_satuan'
			WHERE id_bahan = '$id_bahan'
			";
	mysqli_query($conn, $query);
	return  mysqli_affected_rows($conn);
}

function cari($key)
{
	$query = "SELECT * FROM produk WHERE nama LIKE '%$key%'";
	return query($query);
}

function registrasi($data)
{
	global $conn;

	$username = strtolower(stripcslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);

	// cek konfirmasi password
	if ($password !== $password2) {
		echo "<script>
    alert('konfirmasi password tidak sesuai!');
	</script>";
		return false;
	}
}
