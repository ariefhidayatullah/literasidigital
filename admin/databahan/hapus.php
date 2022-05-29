<?php
require 'function.php';

mysqli_query($conn, "DELETE FROM bahan WHERE id_bahan = '$_GET[id]'") or die(mysqli_error($conn));
echo "<script>window.location ='databahan.php';</script>";
