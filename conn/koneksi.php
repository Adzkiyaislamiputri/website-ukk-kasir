<?php
$server = "localhost";
$user = "root";
$password = "";
$database = "kasir 2";

$koneksi = new mysqli ($server, $user, $password, $database);

if(!$koneksi) {
    die("<script>alert('Tidak terhubung dengan database')</script>");

}
?>