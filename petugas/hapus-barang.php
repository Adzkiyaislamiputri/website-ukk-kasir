<?php
// include database connection file
include_once("../conn/koneksi.php");
 
// Get id from URL to delete that user
$id = $_GET['produk_id'];
 
// Delete user row from table based on given id
$result = mysqli_query($koneksi, "DELETE FROM produk WHERE produk_id=$id");

// After delete redirect to Home, so that latest user list will be displayed.
header("Location:index.php?page=stok");
?>