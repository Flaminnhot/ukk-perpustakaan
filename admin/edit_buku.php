<?php
include'../koneksi.php';
$id = $_GET['id'];
$query_buku = mysqli_query($koneksi, "SELECT*FROM buku WHERE id_buku='$id'");
$data_buku  = mysqli_fetch_array($query_buku);
?>
<h4>Tambah Data Buku</h4>
<form method="post" action="#" class="mt-3">
    <input value="<?= $data_buku['judul_buku'] ?>" name="judul_buku" type="text" class="form-control mb-2" placeholder="Judul Buku" required>
    <input value="<?= $data_buku['pengarang'] ?>" name="pengarang" type="text" class="form-control mb-2" placeholder="Pengarang" required>
    <input value="<?= $data_buku['penerbit'] ?>" name="penerbit" type="text" class="form-control mb-2" placeholder="Penerbit" required>
    <input value="<?= $data_buku['tahun_terbit'] ?>" name="tahun_terbit" type="number" maxlength="4" class="form-control mb-2" placeholder="Tahun Terbit" required>
    <input value="<?= $data_buku['stok'] ?>" name="stok" type="number" min="0" class="form-control mb-2" placeholder="Stok Buku" required>
    <button name="tombol" type="submit" class="btn btn-primary">Simpan</button>
</form>
<?php
if(isset($_POST['tombol'])){
    $judul_buku   = $_POST['judul_buku'];
    $pengarang    = $_POST['pengarang'];
    $penerbit     = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $stok         = $_POST['stok'];
    $status       = "tersedia";
    include'../koneksi.php';
    $query  = "UPDATE buku SET 
        judul_buku='$judul_buku',
        pengarang='$pengarang',
        penerbit='$penerbit',
        tahun_terbit='$tahun_terbit',
        stok='$stok',
        status='$status' 
        WHERE id_buku='$id'";
    $data   = mysqli_query( $koneksi, $query);
    if($data){
        echo "<script>alert('! Data tersimpan'); window.location.assign('?halaman=data_buku');</script>";
    }else{
        echo"<script>alert('! Data gagal tersimpan'); window.location.assign('?halaman=input_buku');</script>";
    }
}
?>  