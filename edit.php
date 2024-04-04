<?php
    include "database.php";
    if(isset($_POST['kirim'])){
        $judul = $_POST['judul'];
        $judul_baru = $_POST['judul_baru'];
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
        $sampul = $_POST['sampul'];

        $sql = "SELECT * FROM tb_novel WHERE judul_novel='$judul'";

    $result = $db->query($sql);

    if($result->num_rows > 0){
        $sql = "UPDATE tb_novel SET judul_novel='$judul_baru', sampul_novel='$sampul', deskripsi='$deskripsi', jumlah_halaman='$halaman', penerbit='$penerbit', tahun_terbit='$tahunterbit', isbn='$isbn', bahasa='$bahasa', berat='$berat', lebar='$lebar', panjang='$panjang', harga='$harga' WHERE 
        judul_novel='$judul'";
        $db->query($sql);
        echo '<script type="text/javascript"> window.onload = function () { alert("Edit Berhasil"); } </script>'; 
    }else{
        echo "Data tidak ditemukan";
        echo '<script type="text/javascript"> window.onload = function () { alert("Data tidak ditemukan"); } </script>'; 
    }
    
}

if(isset($_POST['unggah'])){
    $judul = $_POST['judul'];

    $sql = "SELECT * FROM tb_novel WHERE judul_novel='$judul'";

$result = $db->query($sql);

if($result->num_rows > 0){
    $row = $result->fetch_assoc();
        // Set nilai judul dari data yang ditemukan ke dalam variabel $judul
        $judul = $row['judul_novel'];
        $judul_baru = $row['judul_novel'];
        $deskripsi = $row['deskripsi'];
        $halaman = $row['jumlah_halaman'];
        $tahunterbit = $row['tahun_terbit'];
        $isbn = $row['isbn'];
        $bahasa = $row['bahasa'];
        $penerbit = $row['penerbit'];
        $berat = $row['berat'];
        $lebar = $row['lebar'];
        $panjang = $row['panjang'];
        $harga = $row['harga'];
}else{
    echo "Data tidak ditemukan";
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
        <li class="administrator">ADMINISTRATOR</li>
        <div class="menu0">
            <a href="tambah.php"><li class="menu">Tambah Novel</li></a>
            <a href="hapus.php"><li class="menu">Hapus Novel</li></a>
            <a href="edit.php"><li class="menu">Edit Novel</li></a>
            <a href="loginadmin.php"><li class="menu">Logout</li></a>
        </div>
    </ul>

    <div class="konten">
        <form action="edit.php" method="post" class="input">
            <p>Novel yang ingin diedit</p>
            <input type="text" name="judul" value="<?php echo isset($judul) ? $judul : ''; ?>">
            <button type="submit" name="unggah">Dapatkan Info</button>
            <p>Judul novel baru</p>
            <input type="text" name="judul_baru" value="<?php echo isset($judul) ? $judul : ''; ?>">
            <p>Masukkan Deskripsi Novel</p>
            <input type="text" name="deskripsi" value="<?php echo isset($deskripsi) ? $deskripsi : ''; ?>">
            <p>Masukkan Halaman Novel</p>
            <input type="text" name="halaman" value="<?php echo isset($halaman) ? $halaman : ''; ?>">
            <p>Masukkan Tanggal Terbit</p>
            <input type="text" name="tahunterbit" value="<?php echo isset($tahunterbit) ? $tahunterbit : ''; ?>">
            <p>Masukkan ISBN</p>
            <input type="text" name="isbn" value="<?php echo isset($isbn) ? $isbn : ''; ?>">
            <p>Masukkan Bahasa Novel</p>
            <input type="text" name="bahasa" value="<?php echo isset($bahasa) ? $bahasa : ''; ?>">
            <p>Masukkan Penerbit</p>
            <input type="text" name="penerbit" value="<?php echo isset($penerbit) ? $penerbit : ''; ?>">
            <p>Masukkan Berat</p>
            <input type="text" name="berat" value="<?php echo isset($berat) ? $berat : ''; ?>">
            <p>Masukkan Lebar</p>
            <input type="text" name="lebar" value="<?php echo isset($lebar) ? $lebar : ''; ?>">
            <p>Masukkan Panjang</p>
            <input type="text" name="panjang" value="<?php echo isset($panjang) ? $panjang : ''; ?>">
            <p>Masukkan Harga Novel</p>
            <input type="text" name="harga" value="<?php echo isset($harga) ? $harga : ''; ?>">
            <p>Masukkan Sampul Novel</p>
            <input type="file" name="sampul">
            <button type="submit" name="kirim">Kirim</button>
        </form>

        <!-- Tombol untuk membuka modal -->
        <button class="tombol-modal" onclick="openModal()">Tampilkan Daftar Novel</button>
        <p style="padding-top: 5%;"></p>

        <!-- Modal -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <table class="tabel">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Judul</th>
                            <th>Harga</th>
                            <th>Penerbit</th>
                            <th>Tahun Terbit</th>
                            <th>Jumlah Halaman</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM tb_novel";
                            $result = $db->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>".$row['id_novel']."</td>";
                                    echo "<td>".$row['judul_novel']."</td>";
                                    echo "<td>Rp.".$row['harga']."</td>";
                                    echo "<td>".$row['penerbit']."</td>";
                                    echo "<td>".$row['tahun_terbit']."</td>";
                                    echo "<td>".$row['jumlah_halaman']." halaman</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>Tidak ada data.</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk membuka modal
        function openModal() {
            document.getElementById("myModal").style.display = "block";
        }

        // Fungsi untuk menutup modal
        function closeModal() {
            document.getElementById("myModal").style.display = "none";
        }
    </script>
</body>

</html>