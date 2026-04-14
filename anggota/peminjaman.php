<?php
include'../koneksi.php';
date_default_timezone_set("Asia/Jakarta");
$id = $_GET['id'];
$tgl = date('Y-m-d H:i:s');
// Cek apakah anggota sudah meminjam 2 buku berbeda
$cek = mysqli_query($koneksi, "SELECT COUNT(DISTINCT id_buku) as total FROM transaksi WHERE id_anggota='".$_SESSION['id_anggota']."' AND status_transaksi='peminjaman'");
$total_pinjam = mysqli_fetch_assoc($cek)['total'];
if($total_pinjam >= 2){
    echo "<script>alert('Anda hanya boleh meminjam maksimal 2 buku yang berbeda!'); window.location.assign('dashboard.php');</script>";
    exit;
}
// Cek apakah buku yang sama sudah dipinjam anggota
$cek_buku = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_anggota='".$_SESSION['id_anggota']."' AND id_buku='$id' AND status_transaksi='peminjaman'");
if(mysqli_num_rows($cek_buku) > 0){
    echo "<script>alert('Anda sudah meminjam buku ini!'); window.location.assign('dashboard.php');</script>";
    exit;
}
$query = "INSERT INTO transaksi(id_anggota,id_buku,tgl_pinjam,status_transaksi)
VALUES('$_SESSION[id_anggota]','$id','$tgl','peminjaman')";
$data = mysqli_query($koneksi, $query);
if($data){
    // Kurangi stok buku
    mysqli_query($koneksi, "UPDATE buku SET stok=stok-1 WHERE id_buku='$id'");
    // Cek stok setelah dikurangi
    $cek_stok = mysqli_query($koneksi, "SELECT stok FROM buku WHERE id_buku='$id'");
    $sisa = mysqli_fetch_assoc($cek_stok)['stok'];
    if($sisa <= 0){
        mysqli_query($koneksi, "UPDATE buku SET status='tidak' WHERE id_buku='$id'");
    }
    echo"<script>alert('🛒 Buku sudah dipinjamkan'); window.location.assign('dashboard.php');</script>";
}
?>