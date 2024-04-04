<?php
include "database.php";

// Periksa apakah judul telah dikirimkan melalui metode POST
if (isset($_POST['judul'])) {
    // Ambil judul dari data POST
    $judul = $_POST['judul'];

    // Persiapkan query untuk menghapus item dari tabel keranjang
    $sql = "DELETE FROM tb_keranjang WHERE judul = '$judul'";

    // Jalankan query
    $db->query($sql);

    // Tutup koneksi database
    $db->close();
}
?>
