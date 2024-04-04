<?php
    include "database.php";
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM tb_admin WHERE
        username='$username' AND password='$password'
        ";
        $result = $db->query($sql);

        if($result->num_rows > 0){
            header("location: tambah.php");
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
        <a href="login.php">
            <li class="NarrativeNest">Narrative<span>Nest</span>.</li>
        </a>

    </ul>
    <div class="container">
        <ul class="login">
            <P style="color: white;"> LOGIN ADMIN</P>
            <form action="loginadmin.php" method="post">
                <input type="text" placeholder="username anda" name="username" class="input" />
                <input type="password" placeholder="password anda" name="password" class="input" />
                <p class="b" style="color: white;"> Selamat Datang </p>
                    <button type="submit" name="login" class="login-button"> LOGIN </button>
            </form>
        </ul>
    </div>
    <ul class="kaki" style="color: white;">
        <li class="WEB"> WEB BUKU KITA @Corporation </li>
        <li> Dibuat pada 21/02/2024</li>
    </ul>
</body>

</html>