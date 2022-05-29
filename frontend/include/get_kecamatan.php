<?php
include('koneksi.php');
$id_kabkot = $_GET['id_kabkot'];
$sql = "SELECT * FROM kec WHERE `id_kabkot` = '$id_kabkot'";
$query = $conn->query($sql);
$data = array();
while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
    $data[] = array("id_kec" => $row['id_kec'], "nama_kec" => $row['nama_kec'],);
}
echo json_encode($data);
