<?php
include "database.php";

if (isset($_POST['beli_sekarang'])) {
    $sql = "SELECT * FROM tb_keranjang";
    $nama = $_POST['nama'];
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        $sql="SELECT harga FROM tb_keranjang";
        $result=$db->query($sql);

        // Inisialisasi total belanja
        $totalBelanja=0;

        // Menghitung total belanja dari hasil query
        if ($result->num_rows > 0) {
        while ($row=$result->fetch_assoc()) {
            $harga=$row['harga'];
            $totalBelanja+=$harga;
        }
    }
        $sql = "INSERT INTO tb_pembeli (nama,total_belanja) values ('$nama','$totalBelanja')";
        if ($db->query($sql)) {
            // Jika penghapusan berhasil, masukkan skrip untuk pop-up
            echo '<script type="text/javascript">
                window.onload = function () { alert("Pembelian Berhasil"); } 
                </script>'; 
        } else {
            // Gagal menghapus data
            echo '<script type="text/javascript">
                window.onload = function () { alert("Pembelian Gagal"); } 
                </script>'; 
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="stylecheckout.css" />
</head>

<body>
    <a href="halaman_konten.php">
        <img src="foto/back.png" class="back" style="  
  width: 50px;
  height: 50px;
  position: absolute;
  top: 40px;
  left: 20px;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  transition: 0.5s ease-in-out;
  background-color :white;" />
        <style>
        .back:hover {
            transition: 0.2s ease-in-out;
            transform: scale(110%);
        }
        </style>
    </a>

    <header>

        <h1>Checkout</h1>
    </header>
    <main>
        <form action="#" method="post"><label for="nama">Nama Pembeli:</label><input type="text" id="nama" name="nama"
                required>
            <div class="half-width"><label for="provinsi">Provinsi:</label><select id="provinsi" name="provinsi"
                    required>
                    <option value="">Pilih Provinsi</option>
                    < !-- Daftar provinsi -->
                </select></div>
            <div class="half-width"><label for="kota">Kota/Kabupaten:</label><select id="kota" name="kota" required>
                    <option value="">Pilih Kota/Kabupaten</option>
                    < !-- Daftar kota/kabupaten -->
                </select></div><label for="kodePos">Kode Pos:</label><input type="text" id="kodePos" name="kodePos"
                required><label for="alamat">Detail Alamat:</label><textarea id="alamat" name="alamat" rows="4"
                required></textarea><label for="ekspedisi">Pilih Ekspedisi:</label><select id="ekspedisi"
                name="ekspedisi" required>
                <option value="">Pilih Ekspedisi</option>
                <option value="jne">JNE</option>
                <option value="jnt">JNT</option>
            </select>
            <?php
include "database.php";
$sql = "SELECT * FROM tb_keranjang";
$result = $db->query($sql);
// Memastikan query berhasil dieksekusi
if ($result->num_rows > 0) {
    // Menampilkan data judul novel dalam bentuk daftar
    echo "<ul>";
    // Loop melalui setiap baris hasil query
    echo "List Judul Novel Yang Dibeli : ";

    while ($row=$result->fetch_assoc()) {
        $judul=$row['judul'];
        $harga=$row['harga'];
        echo "<li>$judul, Rp.$harga</li>";
    }

    echo "</ul>";
}

else {
    echo "Tidak ada data judul novel yang tersedia.";
}
?><button type="submit" name="beli_sekarang">Beli Sekarang</button>
            <div id="shippingCost"></div>
        </form>
    </main>
    <script>
    // Contoh daftar provinsi dan kota/kabupaten

    var provinsiData = {
        "Kalimantan Tengah": ["Palangka Raya"],
        // tambahkan data provinsi dan kota/kabupaten sesuai kebutuhan
    }

    ;

    var provinsiSelect = document.getElementById("provinsi");
    var kotaSelect = document.getElementById("kota");

    // Mengisi opsi provinsi
    for (var provinsi in provinsiData) {
        var option = document.createElement("option");
        option.value = provinsi;
        option.textContent = provinsi;
        provinsiSelect.appendChild(option);
    }

    // Menampilkan kota/kabupaten sesuai provinsi yang dipilih
    provinsiSelect.addEventListener("change", function() {
            var selectedProvinsi = this.value;
            kotaSelect.innerHTML = "<option value=''>Pilih Kota/Kabupaten</option>";

            if (selectedProvinsi in provinsiData) {
                var kotaArray = provinsiData[selectedProvinsi];

                kotaArray.forEach(function(kota) {
                        var option = document.createElement("option");
                        option.value = kota;
                        option.textContent = kota;
                        kotaSelect.appendChild(option);
                    }

                );
            }
        }

    );

    // Perhitungan ongkos kirim
    var ekspedisiSelect = document.getElementById("ekspedisi");

    ekspedisiSelect.addEventListener("change", function() {
            var ongkir = 0;
            var selectedEkspedisi = this.value;

            if (selectedEkspedisi === "jne") {
                ongkir = 15000; // Contoh nilai ongkir untuk JNE
            } else if (selectedEkspedisi === "jnt") {
                ongkir = 12000; // Contoh nilai ongkir untuk JNT
            }

            // Melakukan perhitungan ongkos kirim
            var totalOngkir = shippingCost + ongkir;
            document.getElementById("shippingCost").textContent = "Harga Barang: Rp." + totalOngkir
                .toLocaleString() + " (Ongkos Kirim: Rp." + ongkir.toLocaleString() + ")";
        }

    );
    </script><?php // Sambungkan ke database
    $hostname="localhost";
    $username="root";
    $password="";
    $database_name="db_novel";

    $db=mysqli_connect($hostname, $username, $password, $database_name);

    if ($db->connect_error) {
        die("error!");
    }

    // Query untuk mengambil harga dari setiap item di tabel tb_keranjang
    $sql="SELECT harga FROM tb_keranjang";
    $result=$db->query($sql);

    // Inisialisasi total belanja
    $totalBelanja=0;

    // Menghitung total belanja dari hasil query
    if ($result->num_rows > 0) {
        while ($row=$result->fetch_assoc()) {
            $harga=$row['harga'];
            $totalBelanja+=$harga;
        }
    }

    // Menyimpan total belanja ke dalam variabel JavaScript
    echo "<script> var shippingCost = $totalBelanja; </script>";
    ?>

</body>

</html>