<?php
include "database.php";

// Memeriksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil judul dan harga novel dari form submission
    $judul = $_POST['judul'];
    $harga = $_POST['harga'];
    $sampul = $_POST['sampul_novel'];

// Query untuk memasukkan data ke dalam tabel tb_keranjang
$sql = "INSERT INTO tb_keranjang (judul, sampul_novel, harga) VALUES ('$judul', '$sampul','$harga')";

// Eksekusi query
if ($db->query($sql) === TRUE) {
// Jika query berhasil dieksekusi, tampilkan pesan sukses
echo '<script>
alert("Item berhasil ditambahkan ke keranjang!");
</script>';
} else {
// Jika query gagal dieksekusi, tampilkan pesan error
echo '<script>
alert("Error: ' . $db->error . '");
</script>';
}
}

// Tutup koneksi database
$db->close();
?>
<?php
include "database.php";

// Mengambil id dari parameter GET
$id_novel = $_GET['id'];

// Query untuk mendapatkan data novel dari tabel
$sql = "SELECT * FROM tb_novel WHERE id_novel = $id_novel";
$result = $db->query($sql);

// Memeriksa apakah data ditemukan
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_detail.css" />
    <title>Detail Produk</title>
</head>

<body>
    <div class="container">
    <a href="javascript:void(0);" onclick="history.back()">
            <img src="foto/back.png" class="back" />
        </a>
        <div class="wrapper">
            <!-- Menampilkan gambar sampul novel -->
            <img src="<?php echo $row['sampul_novel']; ?>" class="icon" />
            <div class="detail">
                <!-- Menampilkan judul novel -->
                <h1><?php echo $row['judul_novel']; ?></h1>
                <h3 class="t1">Deskripsi : </h3>
                <!-- Menampilkan deskripsi novel -->
                <p class="teks"><?php echo $row['deskripsi']; ?></p>

                <!-- Menampilkan detail lainnya -->
                <h3 class="t2">Detail : </h3>
                <p class="tekdetail">Jumlah Halaman</p>
                <p class="tek"><?php echo $row['jumlah_halaman']; ?> </p>
                <p class="tekdetail">Penerbit</p>
                <p class="tek"><?php echo $row['penerbit']; ?> </p>
                <p class="tekdetail">Tahun Terbit</p>
                <p class="tek"><?php echo $row['tahun_terbit']; ?> </p>
                <p class="tekdetail">ISBN</p>
                <p class="tek"><?php echo $row['isbn']; ?> </p>
                <p class="tekdetail">Bahasa</p>
                <p class="tek"><?php echo $row['bahasa']; ?> </p>
                <p class="tekdetail">Berat</p>
                <p class="tek"><?php echo $row['berat']; ?> </p>
                <p class="tekdetail">Lebar</p>
                <p class="tek"><?php echo $row['lebar']; ?> </p>
                <p class="tekdetail">Panjang</p>
                <p class="tek"><?php echo $row['panjang']; ?> </p>

                <!-- Sisipkan detail lainnya sesuai kebutuhan -->

                <!-- Menampilkan tombol beli -->
                <ul class="bayar">
                    <li class="li_bayar"><a href="checkout.php" class="button">Beli Buku</a></li>
                    <!-- Menampilkan harga novel -->
                    <li class="li_bayar">
                        <p style="color: red; font-size: 25px;">Rp <?php echo $row['harga']; ?>,-</p>
                    </li>
                    <!-- Form untuk menambahkan item ke keranjang -->
                    <form action="" method="post">
                        <!-- Hidden input untuk menyimpan judul dan harga novel -->
                        <input type="hidden" name="judul" value="<?php echo $row['judul_novel']; ?>">
                        <input type="hidden" name="harga" value="<?php echo $row['harga']; ?>">
                        <input type="hidden" name="sampul_novel" value="<?php echo $row['sampul_novel']; ?>">
                        <!-- Tombol untuk menambahkan ke keranjang -->
                        <li class="li_bayar">
                            <button type="submit" name="keranjang" style="  text-decoration: none;padding: 10px 20px 10px 20px;font-size: 20px;background-color: 
                                blue; border-radius: 20px;color: white;">Tambah Keranjang</button>
                        </li>
                    </form>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>

<?php
} else {
    echo "Data novel tidak ditemukan.";
}

// Tutup koneksi database
$db->close();
?>