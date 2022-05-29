<?php
session_start();
require 'function.php';
$id_cart = $_GET['id_cart'];

mysqli_query($conn, "DELETE FROM keranjang WHERE id_cart = '$id_cart'");
echo "<script>alert('produk telah dihapus dari keranjang');</script>";
echo "<script>window.location ='cart.php';</script>";

?>
