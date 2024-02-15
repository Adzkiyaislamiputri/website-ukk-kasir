<?php 
include "../conn/koneksi.php";
error_reporting(0);
session_start();

if (isset($_POST['submit'])) {
    $namaUser = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM user WHERE username='$namaUser' AND password='$password'";
    $result = mysqli_query($koneksi, $sql);

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);

        $level = $row['level'];
        $_SESSION['level'] = $level;
        
        $_SESSION['username'] = $row['username'];


        header("Location: index.php");        
        echo "<script>alert('Berhasil Masuk!')</script>";
    } else {
        echo "<script>alert('Username atau password Anda salah. Silahkan coba lagi!')</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>

    <link rel="stylesheet" href="../bootstrap-5.3.2-dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
        <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Login</h3>
</div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3 mt-3">
                            <label form="" class="form-label">Nama</label>
                            <input type="text" name="username" class="form-control" required>
                            <div class="mb-3 mt-3">
                            <label form="" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
</div>
<button name="submit"class="btn btn-primary">Login</button>
</form>
</div>
</div>
</div>
</div>

<script src="../bootstrap-5.3.2-dist/bootstrap.min.js"></script>
<script src="../bootstrap-5.3.2-dist/jquery.min.js"></script>
</body>
</html>