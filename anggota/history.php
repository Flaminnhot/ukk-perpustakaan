<h4>📚 Daftar History Peminjaman</h4>
<table class="table table-bordered">
    <tr class="fw-bold">
        <td>No</td>
        <td>Judul Buku</td>
        <td>Tanggal Pinjam</td>
        <td>Tanggal Kembali</td>
    </tr>
    <?php
    $no = 1;
    $query = "SELECT*FROM transaksi,buku WHERE buku.id_buku=transaksi.id_buku AND
                transaksi.id_anggota=$_SESSION[id_anggota] AND status_transaksi='pengembalian'";
    $data  = mysqli_query($koneksi, $query);
    foreach ($data as $peminjaman) { ?> 
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $peminjaman['judul_buku'] ?></td> 
            <td><?= $peminjaman['tgl_pinjam'] ?></td>
            <td><?= $peminjaman['tgl_kembali'] ?></td>
        </tr>
   <?php } ?>
</table>