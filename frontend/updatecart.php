<?php 
session_start();
require 'function.php';
if (isset($_GET["sub"])) {
	$qt = $_GET['qty'];
	$id = $_GET['id_cart'];
	$sql = "UPDATE keranjang SET qty = '$qt' WHERE id_cart = '$id'";
	mysqli_query($conn, $sql);
	echo "<script>window.location ='cart.php';</script>";
}else{
	echo "<script>alert('ada yang salah');</script>";
} ?>