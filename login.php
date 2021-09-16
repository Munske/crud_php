<html>

<?php
require "banco.php";
require "tema.php";
session_start();

$msg = " ";

if (isset($_GET["msg"])) {
    $msg = $_GET["msg"];
}
?>

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <link rel="style icon" href="img/icone.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body <?= $tema_corpo ?>>
    <br>
    <div class="container">
        <div class="col s12 m12 l12 z-depth-4">
            <form action="login.php" method="post">
                <div class="card white left">
                    <div class="card-content">
                        <span class="card-title black-text">
                            <h4>Seja Bem-Vindo Jovem Gafanhoto</h4>
                        </span>
                        <div class="black-text">
                            <h5>Faça o seu Login abaixo ou cadastre-se:</h5>
                        </div>
                        <br><br>
                        <div class="black-text">
                            <label class="black-text">Login</label>
                            <input placeholder="login" type="text" name="Login">
                        </div>
                        <br>
                        <div class="black-text">
                            <label class="black-text">Senha</label>
                            <input class="black-text" placeholder="senha" type="password" name="Senha">
                        </div>
                        <br><br><br>
                        <div class="row">
                            <button class="btn green black-text col s12 m4"> Entrar</button>
                            <a class="btn green black-text right col s12 m4" href="cadastrar_usuario.php">Cadastrar-se</a>
                            <br><br><br>
                            <a class="col m12 s12" href="esqueci_minha_senha.php">Esqueceu sua Senha ?</a>
                        </div>
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            if (empty($_POST["Login"]) || empty($_POST["Senha"])) {
                                $msg = "Preencha todos os campos para fazer o login!";
                            } else {
                                $Login = $_POST["Login"];
                                $Senha = $_POST["Senha"];
                                $SenhaMD5 = md5($Senha);
                                $sql = "SELECT * FROM tb_usuarios WHERE login = '$Login' AND senha = '$SenhaMD5'";
                                $result = $conn->query($sql);
                                if ($result->num_rows == 1) {
                                    $_SESSION["Login"] = $Login;
                                    header("Location: consultar_banco.php");
                                } else {
                                    $msg = "Usuário ou senha incorreto(s).";
                                }
                            }
                        }
                        ?>
                        <h5 style="color: red;"><?= $msg ?></span></h5>
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