<html>

<head>
    <title>Erro no Banco</title>
    <meta charset="utf-8">
    <link rel="style icon" href="img/icone.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<?php
require "tema.php";
?>

<body <?= $tema_error_conection_database ?>>

    <div class="container">
        <h4>Perdão tivemos alguns problemas com a nossa conexão ao banco de dados, tente novamente mais tarde...</h4>
        <a class="btn green black-text col s12 m4" href="consultar_banco.php">Tentar Conexão Novamente !!</a>
    </div>

</body>

</html>