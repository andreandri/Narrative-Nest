<?php
include "database.php";

if (isset($_POST['kirim'])) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $halaman = $_POST['halaman'];
    $tahunterbit = $_POST['tahunterbit'];
    $isbn = $_POST['isbn'];
    $bahasa = $_POST['bahasa'];
    $penerbit = $_POST['penerbit'];
    $berat = $_POST['berat'];
    $lebar = $_POST['lebar'];
    $panjang = $_POST['panjang'];
    $harga = $_POST['harga'];

    $targetFolder = "foto/"; // Sesuaikan dengan folder penyimpanan gambar
    $targetPath = $targetFolder . basename($_FILES['sampul']['name']);

    if (move_uploaded_file($_FILES['sampul']['tmp_name'], $targetPath)) {
        $sql = "INSERT INTO tb_novel (judul_novel, sampul_novel, deskripsi, jumlah_halaman, penerbit, tahun_terbit, isbn, bahasa, berat, lebar, panjang, harga)
                VALUES ('$judul', '$targetPath', '$deskripsi', '$halaman', '$penerbit', '$tahunterbit', '$isbn', '$bahasa', '$berat', '$lebar', '$panjang', '$harga')";
                echo '<script type="text/javascript"> window.onload = function () { alert("Penambahan Berhasil"); } </script>'; 
        $db->query($sql);
    } else {
        echo '<script type="text/javascript"> window.onload = function () { alert("Penambahan Gagal"); } </script>'; 
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    <?php include "webadmin.css"?>
    </style>
</head>

<body>
    <ul class="navigasi">
        <li class="administrator"> ADMINISTRATOR </li>
        <div class="menu0">
            <a href="tambah.php">
                <li class="menu"> Tambah Novel </li>
            </a>
            <a href="hapus.php">
                <li class="menu"> Hapus Novel </li>
            </a>
            <a href="edit.php">
                <li class="menu"> Edit Novel </li>
            </a>
            <a href="loginadmin.php">
                <li class="menu"> Logout </li>
            </a>
        </div>
    </ul>
    <form action="tambah.php" method="post" enctype="multipart/form-data">
        <div class="konten">
            <div class="input">
                <p>Masukan Judul Novel</p>
                <input type="text" name="judul">
                <p>Masukan Deskripsi Novel</p>
                <input type="text" name="deskripsi">
                <p>Masukan Sampul Novel</p>
                <input type="file" name="sampul">
                <p> halaman</p>
                <input type="text" name="halaman">
                <p> penerbit</p>
                <input type="text" name="penerbit">
                <p> tahun terbit</p>
                <input type="text" name="tahunterbit">
                <p> ISBN</p>
                <input type="text" name="isbn">
                <p> berat</p>
                <input type="text" name="berat">
                <p> lebar</p>
                <input type="text" name="lebar">
                <p> panjang</p>
                <input type="text" name="panjang">>
                <p> bahasa</p>
                <input type="text" name="bahasa">
                <p> harga</p>
                <input type="text" name="harga">
            </div>
            <button type="submit" name="kirim" style="width: 5%;"> Kirim </button>
            <p style="padding-top: 5%;"></p>
        </div>
    </form>
</body>

</html>