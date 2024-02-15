<?php
include_once("conn/koneksi.php");
$id = $_GET['id'];
$sql = $koneksi->query("DELETE FROM detail penjualan WHERE penjualan_id=$id");
echo "<script>
        alert('Data berhasil dihapus');
        window.location.href = 'daftar-transaksi.php';
    </script>";
?>