<?php
include "database.php";

if (isset($_POST['hapus'])) {
    $judul = $_POST['judul'];
    $sql = "SELECT * FROM tb_novel WHERE judul_novel='$judul'";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        $sql = "DELETE FROM tb_novel WHERE judul_novel = '$judul'";
        if ($db->query($sql)) {
            // Jika penghapusan berhasil, masukkan skrip untuk pop-up
            echo '<script type="text/javascript">
                window.onload = function () { alert("Penghapusan Berhasil"); } 
                </script>'; 
        } else {
            // Gagal menghapus data
            echo '<script type="text/javascript">
                window.onload = function () { alert("Penghapusan Gagal"); } 
                </script>'; 
        }
    } else {
        // Data tidak ditemukan
        echo '<script type="text/javascript">
                window.onload = function () { alert("Data tidak ditemukan"); } 
                </script>'; 
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
    <div class="konten">
        <div class="input">
            <ul class="list">
                <p>Masukkan judul Novel : </p>
                <form action="hapus.php" method="post">
                    <input type="text" name="judul">
                    <button type="submit" name="hapus" id="showNotification"> Hapus </button>
                    <p style="font-size: medium;"> Masukkan judul novel yang ingin dihapus </p>
                </form>
            </ul>
        </div>
        <!-- Tombol untuk membuka modal -->
        <button class="tombol-modal" onclick="openModal()">Tampilkan Daftar Novel</button>

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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.popupsmart.com/bundle.js" data-id="834886" async defer></script>
    <script src="script.js"></script>
</body>

</html>