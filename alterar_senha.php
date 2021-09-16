<html>

<?php
require "banco.php";
require "valida_login.php";
require "tema.php";
?>

<head>
    <title>Alterar Senha</title>
    <meta charset="utf-8">
    <link rel="style icon" href="img/icone.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="css/style.css"></head>

<body <?= $tema_corpo ?>>
    <div class="container">
        <?=
            require "navbar.php";
        ?>
        <div class="row z-depth-4 <?= $tema_formulario ?>">
            <h3>Alterar Senha - <?= $Login ?></h3>
            <form action="alterar_senha.php" method="post">
                <input placeholder="Código do produto" type="hidden" name="pk_codproduto" value="<?= $pk_codproduto ?>">
                <div class="input-field col s12 m12">
                    <input placeholder="Senha" type="password" name="Senha">
                    <label class="<?= $tema_texto ?>">Senha</label>
                </div>
                <div class="input-field col s12 m12">
                    <input placeholder="Nova Senha" type="password" name="NovaSenha">
                    <label class="<?= $tema_texto ?>">Nova Senha</label>
                </div>
                <div class="input-field col s12 m12">
                    <input placeholder="Confirmar Nova Senha" type="password" name="ConfirmarNovaSenha">
                    <label class="<?= $tema_texto ?>">Confirmar Nova Senha</label>
                </div>
                <div class="col s12">
                    <button class="btn waves-effect waves-light <?= $tema_botao ?>" type="submit" style="margin-bottom: 7px;">Alterar</button>
                    <?php
                    $msg = "";
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if (empty($_POST["Senha"]) || empty($_POST["NovaSenha"]) || empty($_POST["ConfirmarNovaSenha"])) {
                            $msg = "<p>Preencha todos os campos para alterar!</p>";
                        } else {
                            $Senha = $_POST["Senha"];
                            $SenhaMD5 = md5($Senha);
                            $NovaSenha = $_POST["NovaSenha"];
                            $ConfirmarNovaSenha = $_POST["ConfirmarNovaSenha"];
                            $sql = "SELECT * FROM tb_usuarios WHERE login = '$Login' AND senha = '$SenhaMD5'";
                            $result = $conn->query($sql);
                            if ($result->num_rows == 1) {
                                if ($NovaSenha == $ConfirmarNovaSenha) {
                                    $NovaSenhaMD5 = md5($NovaSenha);
                                    $sql = "UPDATE tb_usuarios SET senha = '$NovaSenhaMD5' WHERE login = '$Login'";
                                    if ($conn->query($sql) === true) {
                                        $msg = "<p>Senha alterada com sucesso!</p>";
                                    } else {
                                        $msg = "<p>Erro ao alterar a senha.</p>";
                                        $msg = "<p>$conn->error</p>";
                                    }
                                } else {
                                    $msg = "<p>Erro ao confirmar a nova senha, digite novamente.</p>";
                                }
                            } else {
                                $msg = "<p>Senha incorreta.</p>";
                            }
                        }
                    }
                    ?>
                    <h5><?= $msg ?></h5>
                </div>
            </form>
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