<?php
include'../koneksi.php';
date_default_timezone_set("Asia/Jakarta");
$id = $_GET['id'];
$buku = $_GET['buku'];
$tgl = date('Y-m-d H:i:s');
$query = "UPDATE transaksi SET tgl_kembali='$tgl',status_transaksi='pengembalian' WHERE id_transaksi='$id'";
$data = mysqli_query($koneksi, $query);
if($data){
    // Tambah stok buku
    mysqli_query($koneksi, "UPDATE buku SET stok=stok+1 WHERE id_buku='$buku'");
    // Update status jika stok > 0
    $cek_stok = mysqli_query($koneksi, "SELECT stok FROM buku WHERE id_buku='$buku'");
    $sisa = mysqli_fetch_assoc($cek_stok)['stok'];
    if($sisa > 0){
        mysqli_query($koneksi, "UPDATE buku SET status='tersedia' WHERE id_buku='$buku'");
    }
    echo"<script>alert('✅ Buku sudah dikembalikan'); window.location.assign('?halaman=hisstory');</script>";
}
?>