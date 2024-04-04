<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>
<?php 
 include("database.php");
 // Fungsi untuk menghitung total harga pada keranjang berdasarkan judul buku
function hitungTotalHarga($judul, $db) {
    $sql = "SELECT SUM(harga) AS total FROM tb_keranjang WHERE judul = '$judul'";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();
    return $row['total'];
}

$sql = "SELECT DISTINCT judul, sampul_novel, harga FROM tb_keranjang";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $jumlah = 0;
        $judul = $row['judul'];
        $totalHarga = hitungTotalHarga($judul, $db);

        $sql_jumlah = "SELECT judul FROM tb_keranjang WHERE judul ='$judul'";
        $hasil_jumlah = $db->query($sql_jumlah);
        $jumlah = $hasil_jumlah->num_rows;

        echo "<div class='item'>
            <img src='{$row["sampul_novel"]}' alt='produk'/>
            <div class='detail'>
                <h3>{$judul}</h3>
                <p>Jumlah: " . $jumlah . "</p>
                <div class='price'>Rp." . $totalHarga . ",-</div>
            </div>
            <form action='hapus_keranjang.php' method='post'>
                <input type='hidden' name='judul' value='{$row["judul"]}'>
                <input type='hidden' name='hapus_keranjang'>
                <button type='submit' class='remove-item'>
                    <i data-feather='trash-2' class='remove-item'></i>
                </button>
            </form>

        </div>";
    }

    echo "<div class='center-button'>
        <a href='checkout.php'>
            <button type='submit' name='beli_novel'>Beli</button>
        </a>
    </div>";
} else {
    echo "Keranjang kosong.";
}

?>


<script type="text/javascript">
$(document).ready(function(){
    // Membuat penanganan peristiwa untuk tombol hapus item
    $(".remove-item").click(function(e){
        e.preventDefault(); // Mencegah perilaku default tombol submit
        
        // Ambil judul novel dari atribut value
        var judul = $(this).closest('.item').find('h3').text();
        
        // Menghapus item dari DOM
        $(this).closest('.item').remove();

        // Mengirimkan permintaan AJAX kehapus_keranjang.php
        $.ajax({
            url: "hapus_keranjang.php",
            method: "POST",
            data: { judul: judul },
            success: function(data) {
                // Lakukan sesuatu setelah item dihapus, jika perlu
                alert("Item berhasil dihapus dari keranjang!");
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert("Gagal menghapus item dari keranjang!");
            }
        });
    });
});
</script>

<script>
    feather.replace();
</script>
</body>
</html>