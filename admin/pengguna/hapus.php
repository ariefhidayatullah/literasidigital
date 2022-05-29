<?php
require 'function.php';

mysqli_query($conn, "DELETE FROM user WHERE id_user = '$_GET[id]'") or die(mysqli_error($conn));
echo "<script>window.location ='datauser.php';</script>";
