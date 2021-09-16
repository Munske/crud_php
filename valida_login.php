<?php
session_start();
$Login;
if (isset($_SESSION["Login"])) {
    $Login = $_SESSION["Login"];
} else {
    header("Location: login.php?msg=Logue para continuar");
}
?>