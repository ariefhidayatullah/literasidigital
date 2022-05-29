<?php
require 'koneksi.php';
$id_prov = $_GET['id_prov'];
$sql = "SELECT * FROM kabkot WHERE `id_prov` = '$id_prov'";
$query = $conn->query($sql);
$data = array();
while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
    $data[] = array("id_kabkot" => $row['id_kabkot'], "nama_kabkot" => $row['nama_kabkot'], "jne_reg" => $row['jne_reg']);
}
echo json_encode($data);
