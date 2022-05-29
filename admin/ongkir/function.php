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

function ubah($data)
{
    global $conn;

    $id_kabkot = $data['id_kabkot'];
    $nama_kabkot = $data['nama_kabkot'];
    $jne_reg = $data['jne_reg'];

    //query insert data
    $query = "UPDATE kabkot SET 
			nama_kabkot = '$nama_kabkot',
			jne_reg = '$jne_reg'
			WHERE id_kabkot = '$id_kabkot'
			";
    mysqli_query($conn, $query);
    return  mysqli_affected_rows($conn);
}
