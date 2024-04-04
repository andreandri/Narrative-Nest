<?php
include "database.php";

if(isset($_POST['judul'])) {
    $judul = $_POST['judul'];
    $sql = "SELECT * FROM tb_keranjang WHERE id='$judul'";
    $result = $db->query($sql);
    if($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $harga = $row['harga'];
        $judul = $row['judul'];
        $sampul = $row['sampul_novel'];
    }
    $sql = "INSERT INTO tb_keranjang VALUES ('$id','$harga','$judul','$sampul')";
    
    if ($db->query($sql)) {
        echo "Item berhasil ditambahkan ke keranjang";
    } else {
        http_response_code(500); // Internal Server Error
        echo "Gagal menambahkan item ke keranjang!";
    }
} else {
    http_response_code(400); // Bad Request
    echo "Permintaan tidak valid";
}

$db->close();
?>
