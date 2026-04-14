<?php
include'../koneksi.php';
$anggota    = mysqli_query($koneksi, "SELECT*FROM anggota");
$buku       = mysqli_query($koneksi, "SELECT*FROM buku WHERE status='tersedia'");
?>
<h4>Tambah Peminjaman</h4>
<form method="post" action="#" class="mt-3">
    <select name="id_anggota" class="form-control mb-2" required>
        <option value="">Pilih Anggota</option>
        <?php
        foreach($anggota as $data){
            echo"<option value='$data[id_anggota]'>$data[nama_anggota]</option>";
        }
        ?>
    </select>
    <select name="id_buku" class="form-control mb-2" required>
        <option value="">Pilih Buku</option>
         <?php
        foreach($buku as $data){
            echo"<option value='$data[id_buku]'>$data[judul_buku]</option>";
        }
        ?>
    </select>
    <input name="tgl_pinjam" type="datetime-local" class="form-control mb-2">
    <button name="tombol" type="submit" class="btn btn-primary">Simpan</button>
</form>
<?php
if(isset($_POST['tombol'])){
    $id_anggota             = $_POST['id_anggota'];
    $id_buku                = $_POST['id_buku'];
    $tgl_pinjam             = $_POST['tgl_pinjam'];
    $status_transaksi       = "peminjaman";
    // Cek apakah anggota sudah meminjam 2 buku berbeda
    $cek = mysqli_query($koneksi, "SELECT COUNT(DISTINCT id_buku) as total FROM transaksi WHERE id_anggota='$id_anggota' AND status_transaksi='peminjaman'");
    $total_pinjam = mysqli_fetch_assoc($cek)['total'];
    if($total_pinjam >= 2){
        echo "<script>alert('Anggota ini sudah meminjam maksimal 2 buku yang berbeda!'); window.location.assign('?halaman=input_peminjaman');</script>";
        exit;
    }
    // Cek apakah buku yang sama sudah dipinjam anggota
    $cek_buku = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_anggota='$id_anggota' AND id_buku='$id_buku' AND status_transaksi='peminjaman'");
    if(mysqli_num_rows($cek_buku) > 0){
        echo "<script>alert('Anggota ini sudah meminjam buku ini!'); window.location.assign('?halaman=input_peminjaman');</script>";
        exit;
    }
    include'../koneksi.php';
    $query  = "INSERT INTO transaksi(id_anggota,id_buku,tgl_pinjam,status_transaksi) VALUES('$id_anggota','$id_buku','$tgl_pinjam','$status_transaksi')";
    $data   = mysqli_query( $koneksi, $query);
    if($data){
        mysqli_query($koneksi, "UPDATE buku SET stok=stok-1 WHERE id_buku='$id_buku'");
        // Cek stok setelah dikurangi
        $cek_stok = mysqli_query($koneksi, "SELECT stok FROM buku WHERE id_buku='$id_buku'");
        $sisa = mysqli_fetch_assoc($cek_stok)['stok'];
        if($sisa <= 0){
            mysqli_query($koneksi, "UPDATE buku SET status='tidak' WHERE id_buku='$id_buku'");
        }
        echo "<script>alert('! Data peminjaman tersimpan'); window.location.assign('?halaman=data_peminjaman');</script>";
    }else{
        echo"<script>alert('! Data gagal tersimpan'); window.location.assign('?halaman=input_peminjaman');</script>";
    }
}
?>  