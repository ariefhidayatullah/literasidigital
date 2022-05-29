<?php
require 'function.php';

mysqli_query($conn, "DELETE FROM produk WHERE id_produk = '$_GET[id]'") or die(mysqli_error($conn));
echo "<script>window.location ='dataproduk.php';</script>";
