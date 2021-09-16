<?php
require "banco.php";
if (isset($_GET["pk_codproduto"])) {
    $sql = "DELETE FROM tb_produto WHERE pk_codproduto = ".$_GET["pk_codproduto"];
    if ($conn->query($sql) === true) {
        //
    } //
}
header("Location: consultar_banco.php");
?>