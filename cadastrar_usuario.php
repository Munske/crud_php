<html>

<?php
require "banco.php";
require "tema.php";
session_start();
?>

<head>
    <title>Cadastrar Usuário</title>
    <meta charset="utf-8">
    <link rel="style icon" href="img/icone.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body <?= $tema_corpo ?>>
    <br><br>
    <div class="container">
        <div class="col s12 m12 l12 z-depth-4 <?= $tema_formulario ?> ">
            <form action="cadastrar_usuario.php" method="post">
                <div class="card white left">
                    <div class="card-content white-text">
                        <span class="card-title black-text">
                            <h4>Bem-Vindo a tela de Cadastro</h4>
                        </span>
                        <br>
                        <form action="cadastrar_usuario.php" method="post">
                            <div class="input-field col s12">
                                <label class="black-text">Login</label>
                                <input placeholder="Login" type="text" name="Login">
                            </div>
                            <div class="input-field col s12">
                                <label class="black-text">Senha</label>
                                <input placeholder="Senha" type="password" name="Senha">
                            </div>
                            <div class="input-field col s12">
                                <label class="black-text">Confirmar Senha</label>
                                <input placeholder="Confirmar Senha" type="password" name="ConfirmarSenha">
                            </div>
                            <div class="input-field col s12">
                                <label class="black-text">Email</label>
                                <input placeholder="Email" type="email" name="Email">
                            </div>
                            <br>
                            <div class="col s12">
                                <a class="btn green black-text" href="login.php">Tela de Login</a>
                                <button class="btn green black-text right" href="#">Cadastrar</button>
                                <?php
                                $msg = " ";

                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    if (empty($_POST["Login"]) || empty($_POST["Senha"]) || empty($_POST["ConfirmarSenha"]) || empty($_POST["Email"])) {
                                        $msg = "Preencha todos os campos para cadastrar!";
                                    } else {
                                        if ($_POST["Senha"] == $_POST["ConfirmarSenha"]) {
                                            $Login = $_POST["Login"];
                                            $Senha = $_POST["Senha"];
                                            $SenhaMD5 = md5($Senha);
                                            $ConfirmarSenha = $_POST["ConfirmarSenha"];
                                            $Email = $_POST["Email"];
                                            $sql = "INSERT INTO tb_usuarios (login, senha, email) VALUES ('$Login', '$SenhaMD5', '$Email');";
                                            if ($_POST["Senha"] == $_POST["ConfirmarSenha"]) {
                                                if ($conn->query($sql) === true) {
                                                    $msg = "Usuário cadastrado com sucesso!";
                                                } else {
                                                    $msg = "Erro ao cadastrar o usuário...<br>" . $conn->error;
                                                }
                                            }
                                        } else {
                                            $msg = "Senha não está igual a Confirmar Senha";
                                        }
                                    }
                                }
                                ?>
                                <h5 style="color: red;"><?= $msg ?></span></h5>
                            </div>
                        </form>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.sidenav').sidenav();
        });

        $(document).ready(function() {
            $('.dropdown-trigger').dropdown({
                coverTrigger: false
            });
        });
    </script>
</body>

</html>