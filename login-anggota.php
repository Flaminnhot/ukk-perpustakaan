<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Anggota - Aplikasi Perpustakaan Digital Sekolah</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="vh-100 row justify-content-center align-items-center">
        <form method="post" action="#" class="col-md-3 border p-4 bg-white rounded-4">
            <h4 class="text-center">Login Anggota</h4>
            <h5 class="text-center mb-3">Aplikasi Perpustakaan Digital Sekolah</h5>
            <input name="username" class="form-control mb-3" placeholder="Username">
            <input name="password" type="password" class="form-control mb-3" placeholder="Password">
            <button type="submit" name="tombol" class="btn btn-success w-100 mb-25">Login</button>
            <a href="login-admin.php" class="text-decoration-none">Login Sebagai admin Perpustakaan..?</a><br>
            <a href="pendaftaran-anggota.php" class="text-decoration-none">Daftar menjadi anggota Perpustakaan..?</a>
        </form>
    </div>
</body>
</html>
<?php
if(isset($_POST['tombol'])){
    include'koneksi.php';
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $query = "SELECT*FROM anggota WHERE username='$user' AND password='$pass'";
    $data = mysqli_query($koneksi, $query);
    if(mysqli_num_rows($data)>0){
        $data = mysqli_fetch_array($data);
        session_start();
        $_SESSION['id_anggota']     =$data['id_anggota'];
        $_SESSION['username']       =$data['username'];
        $_SESSION['nama_anggota']   =$data['nama_anggota'];
        header("Location:anggota/dashboard.php");
    }else{
        echo"<script>alert('Login Gagal, Username / Password Salah'); window.location.assign('login-anggota.php');</script>";
    }
}
?>