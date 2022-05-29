<?php
$conn = new mysqli('localhost', 'u5445042_kelompok6bws', 'kelompok6bws', 'u5445042_kelompok06bws'); //sesuaikan dengan konfigurasi database kamu ya
if (mysqli_connect_error()) { 
die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
}
?>