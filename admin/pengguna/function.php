<?php
$conn = mysqli_connect('localhost', 'u5445042_kelompok6bws', 'kelompok6bws', 'u5445042_kelompok06bws');

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
