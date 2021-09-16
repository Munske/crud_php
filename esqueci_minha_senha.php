<html>

<?php
require "banco.php";
require "tema.php";
session_start();
?>

<head>
    <title>Esqueci Minha Senha</title>
    <meta charset="utf-8">
    <link rel="style icon" href="img/icone.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body <?= $tema_corpo ?>>
    <?php
    $msg = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["Login"]) || empty($_POST["Email"])) {
            $msg = "<p>Preencha os campos da conta que deseja resetar a senha!</p>";
        } else {
            $Login = $_POST["Login"];
            $Email = $_POST["Email"];
            $sql = "SELECT * FROM tb_usuarios WHERE login = '$Login' AND email = '$Email'";
            $result = $conn->query($sql);
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $pk_codusuario = $row["pk_codusuario"];
                $SenhaNova = bin2hex(openssl_random_pseudo_bytes(4));
                $SenhaNovaMD5 = md5($SenhaNova);
                $sql = "UPDATE tb_usuarios SET senha = '$SenhaNovaMD5' WHERE pk_codusuario = $pk_codusuario";
                if ($conn->query($sql) === true) {
                    require("phpmailer/class.phpmailer.php");
                    $mail = new PHPMailer();
                    $mail->IsSMTP();
                    $mail->CharSet = 'UTF-8';
                    $mail->Host = "smtp.gmail.com"; // Servidor SMTP
                    $mail->SMTPSecure = "tls"; // conexão segura com TLS
                    $mail->Port = 587; // Porta do SMTP
                    $mail->SMTPAuth = true; // Caso o servidor SMTP precise de autenticação
                    $mail->Username = "matheusmunskelima@gmail.com"; // SMTP username - email do Gmail
                    $mail->Password = "pxbkhayyhlbcmkyb"; // SMTP password - contas com verificação de 2 etapas: https://support.google.com/accounts/answer/185833?hl=pt-BR
                    $mail->From = "matheusmunskelima@gmail.com"; // E-mail de quem envia o email
                    $mail->FromName = "Matheus Munske Lima"; // Nome de quem envia o email
                    $mail->AddAddress("$Email", "$Email"); // Email e nome de quem receberá
                    $mail->WordWrap = 200; // Definir quebra de linha a cada X caracteres
                    $mail->IsHTML = true; // Enviar como HTML
                    $mail->Subject = "Sua nova senha para o app do Munske"; // Assunto
                    $mail->Body = "<p>Olá! Segue a nova senha para você utilizar o nosso app:</p><h3>$SenhaNova</h3><p>Atenciosamente,</p><p>Sistema do Munske</p>"; //Corpo da mensagem em HTML
                    $mail->AltBody = "Olá! Segue a nova senha para você utilizar o nosso app: $SenhaNova - Atenciosamente, Sistema do Munske"; // Corpo da mensagem caso o recipiente não suporte HTML
                    $mail->SMTPDebug  = 1; //PlainText, para caso quem receber o email não aceite o corpo HTML
                    $mail->Send();

                    $msg = "<br><p>Foi enviado ao seu Email uma senha de recuperação, após efetuar o login troque esta senha!</p>";
                }
            } else {
                $msg = "<br><p>Login ou Email incorretos...</p>";
            }
        }
    }
    ?>
    <div class="container">
        <br><br>
        <div class="col s12 m12 l12 z-depth-4">
            <form action="esqueci_minha_senha.php" method="post">
                <div class="card white">
                    <div class="card-content">
                        <span class="card-title black-text">
                            <h4>Esqueceu sua senha ?</h4>
                        </span>
                        <div class="black-text">
                            <h5>Coloque o seu Login e E-mail para receber uma nova senha</h5>
                        </div>
                        <br>
                        <div class="black-text">
                            <input placeholder="Login" type="text" name="Login">
                        </div>
                        <div class="black-text">
                            <input placeholder="E-mail" type="email" name="Email">
                        </div>
                        <br><br>
                        <div class="black-text">
                            <button class="btn green black-text col s12 m4" type="submit">Enviar</button>
                            <a class="btn green black-text right" href="login.php">Voltar a tela de Login</a>
                        </div>
                        <?= $msg ?>
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
    </script>
</body>

</html>