<?php
    include "database.php";
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM tb_pengguna WHERE
        username='$username' AND password='$password'
        ";
        $result = $db->query($sql);

        if($result->num_rows > 0){
            header("location: halaman_konten.php");
        }else{
            echo "Login gagal";
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
            <P style="color: white;"> LOGIN AKUN ANDA </P>
            <form action="login.php" method="post">
                <input type="text" placeholder="username anda" name="username" class="input" />
                <input type="password" placeholder="password anda" name="password" class="input" />
                <a href="register.php">
                    <p style="color: white;"> Register </P>
                </a>
                <button type="submit" name="login"class="login-button"> LOGIN </button>
            </form>
        </ul>
    </div>
    <ul class="kaki" style="color: white;">
        <li class="WEB"> WEB BUKU KITA @Corporation </li>
        <li> Dibuat pada 21/02/2024</li>
    </ul>
</body>

</html>