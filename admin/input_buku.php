<h4>Tambah Data Buku</h4>
<form method="post" action="#" class="mt-3">
    <input name="judul_buku" type="text" class="form-control mb-2" placeholder="Judul Buku" required>
    <input name="pengarang" type="text" class="form-control mb-2" placeholder="Pengarang" required>
    <input name="penerbit" type="text" class="form-control mb-2" placeholder="Penerbit" required>
    <input name="tahun_terbit" type="number" maxlength="4" class="form-control mb-2" placeholder="Tahun Terbit" required>
    <input name="stok" type="number" min="0" class="form-control mb-2" placeholder="Stok Buku" required>
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
    $query  = "INSERT INTO buku(judul_buku,pengarang,penerbit,tahun_terbit,stok,status) VALUES('$judul_buku','$pengarang','$penerbit','$tahun_terbit','$stok','$status')";
    $data   = mysqli_query( $koneksi, $query);
    if($data){
        echo "<script>alert('! Data tersimpan'); window.location.assign('?halaman=data_buku');</script>";
    }else{
        echo "<script>alert('! Data gagal tersimpan: \\n" . mysqli_error($koneksi) . "'); window.location.assign('?halaman=input_buku');</script>";
    }
}
?>  