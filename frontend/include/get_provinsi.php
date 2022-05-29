<?php
require 'koneksi.php';
$sql = ( 'SELECT * FROM prov');
$query = $conn->query($sql);
$data = array();
while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
    $data[] = array("id_prov" => $row['id_prov'], "nama_prov" => $row['nama_prov']);
}
echo json_encode($data);
