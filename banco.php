<?php
$servername = "localhost";
$dbname = "db_trabalho_crud_php";
$username = "root";
$password = "";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_erro) {  
    die(header("Location: caso_de_erro.php"));
}
?>