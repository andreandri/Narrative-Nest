<?php 

$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "db_novel";

$db = mysqli_connect($hostname, $username, $password, $database_name);

if($db->connect_error){
    die("error!");
}

?>