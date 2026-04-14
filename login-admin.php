<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login admin - Aplikasi perpustakaan digital </title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="vh-100 row justify-content-center align-items-center">
        <div class="col-4">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="text-center mb-4">Login Admin</h3>
                    <form action="#" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <button type="submit" name="tombol" class="btn btn-primary w-100">Login</button>
                        login sebagai anggota? <a href="login-anggota.php">klik disini</a>  
                    </form>
                </div>
            </div>
        </div>

    </div>

    
    
</body>
</html>



<?php
session_start();
if (isset($_POST["tombol"])) {
    include 'koneksi.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $data = mysqli_query($koneksi, $query);
    if (mysqli_num_rows($data) > 0) {
        $data = mysqli_fetch_array($data);
        $_SESSION["id_admin"] = $data["id_admin"];
        $_SESSION["username"] = $data["username"];
        $_SESSION["nama_admin"] = $data["nama_admin"];
        header("Location: admin/dashboard.php");
        exit;
    } else {
        echo "<script>alert('Login Gagal, pastikan username dan password benar!');</script>";
    }
}

    