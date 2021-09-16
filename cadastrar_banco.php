<html>

<?php
require "banco.php";
require "valida_login.php";
require "tema.php";
?>

<head>
    <title>Cadastrar Produto</title>
    <meta charset="utf-8">
    <link rel="style icon" href="img/icone.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body <?= $tema_corpo ?>>
    <?php
    $pk_codproduto = 0;
    $nome = "";
    $valor_unitario;
    $fornecedor = "";
    $textoCadastrarAlterar = "Cadastrar";
    if (isset($_GET["pk_codproduto"])) {
        $pk_codproduto = $_GET["pk_codproduto"];
        $sql = "SELECT * FROM tb_produto WHERE pk_codproduto = $pk_codproduto";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $pk_codproduto = $row["pk_codproduto"];
            $nome = $row["nome"];
            $valor_unitario = $row["valor_unitario"];
            $fornecedor = $row["fornecedor"];
        }
        $textoCadastrarAlterar = "Alterar";
    }

    //PHP Após receber um alterar...
    $msg = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["nome"]) || empty($_POST["valor_unitario"]) || empty($_POST["fornecedor"])) {
            $msg = "--> Todos os campos devem ser preenchidos";
        } else {
            $pk_codproduto = $_POST["pk_codproduto"];
            $nome = $_POST["nome"];
            $valor_unitario = $_POST["valor_unitario"];
            $fornecedor = $_POST["fornecedor"];
            if ($pk_codproduto == 0) {
                $sql = "INSERT INTO tb_produto (nome, valor_unitario, fornecedor) VALUES ('$nome', $valor_unitario, '$fornecedor');";
                if ($conn->query($sql) === true) {
                    $msg = "--> Produto cadastrado com sucesso!";
                } else {
                    $msg = "--> Erro ao cadastrar o produto..."."<br>".$conn->error;
                }
            } else {
                $sql = "UPDATE tb_produto SET nome = '$nome', valor_unitario = $valor_unitario, fornecedor = '$fornecedor' WHERE pk_codproduto = $pk_codproduto";
                if ($conn->query($sql) === true) {
                    header("Location: consultar_banco.php");
                } else {
                    $msg = "--> Erro ao atualizar o Produto no banco de dados..."."<br>".$conn->error;
                }
            }
        }
    }
    ?>
    <div class="container">
        <?php
        require "navbar.php";
        ?>
        <div class="row z-depth-4 <?= $tema_formulario ?>">
            <h4 class="<?= $tema_texto ?>"><?= $textoCadastrarAlterar ?> Produto</h4>
            <form action="cadastrar_banco.php" method="post">
                <input placeholder="Código do produto" type="hidden" name="pk_codproduto" value="<?= $pk_codproduto ?>">
                <div class="input-field col s12 m12">
                    <input placeholder="Nome" type="text" name="nome" value="<?= $nome ?>">
                    <label class="<?= $tema_texto ?>">Nome</label>
                </div>
                <div class="input-field col s12 m12">
                    <input placeholder="Valor Unitário" type="number" step="0.01" name="valor_unitario" value="<?= $valor_unitario ?>">
                    <label class="<?= $tema_texto ?>">Valor Unitário</label>
                </div>
                <div class="input-field col s12 m12">
                    <input placeholder="Fornecedor" type="text" name="fornecedor" value="<?= $fornecedor ?>">
                    <label class="<?= $tema_texto ?>">Fornecedor</label>
                </div>
                <div class="col s12">
                    <button class="btn waves-effect waves-light <?= $tema_botao ?>" type="submit" style="margin-bottom: 7px;"><?= $textoCadastrarAlterar ?></button>
                </div>
                <p><?= $msg; ?></p>
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