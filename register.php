<?php

    include "database.php";
    if(isset($_POST['register'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password_verify = $_POST['password_verify']; // Ambil nilai dari input verifikasi password
    
        // Periksa apakah password dan verifikasi password cocok
        if($password != $password_verify) {
            echo "Password dan verifikasi password tidak cocok.";
        } else {
            // Lanjutkan proses registrasi jika password dan verifikasi password cocok
            $sql = "INSERT INTO tb_pengguna (username, password) VALUES ('$username','$password')";
            
            if($db->query($sql)){
                echo "Register Berhasil! Silahkan Login";
            }else{
                echo "Register gagal! Coba Lagi!";
            }
        }
    }

?>
<html>

<head>
    <title>BukuKita</title>
    <style>
    <?php include "design.css"?>
    </style>
</head>

<body>
    <ul class="navigasi" ; style="color: white;">
        <a href="loginadmin.php">
            <li class="NarrativeNest">Narrative<span>Nest</span>.</li>
        </a>

    </ul>
    <div class="container">
        <ul class="login">
            <p style="color: white;"> HALAMAN REGISTER </p>
            <form action="register.php" method="post">
                <input type="text" placeholder="username anda" name="username" class="input" />
                <input type="password" placeholder="password anda" name="password" class="input" />
                <input type="password" placeholder="verifikasi password" name="password_verify" class="input" /> <!-- Input untuk verifikasi password -->
                <a href="login.php">
                    <p style="color: white;">Login </P>
                </a>
                <button type="submit" name="register"  class="regis-button"> REGISTER </button>
            </form>
        </ul>
    </div>
    <ul class="kaki" style="color: white;">
        <li class="WEB"> WEB BUKU KITA @Corporation </li>
        <li> Dibuat pada 21/02/2024</li>
    </ul>
</body>

</html>