<html>

<?php
require "banco.php";
require "valida_login.php";
require "tema.php";
?>

<head>
    <title>Consultar Produto</title>
    <meta charset="utf-8">
    <link rel="style icon" href="img/icone.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body <?= $tema_corpo ?> >

    <div class="container">
        <?php
        require "navbar.php";
        // criando uma variavel de consulta ao banco de dados
        $sql = "SELECT * FROM tb_produto WHERE 1=1";
        if (!empty($_GET["pk_codproduto"])) {
            $sql .= " AND pk_codproduto = " . $_GET["pk_codproduto"];
        }
        if (!empty($_GET["nome"])) {
            $sql .= " AND nome like '%" . $_GET["nome"] . "%'";
        }
        if (!empty($_GET["valor_unitario"])) {
            $sql .= " AND valor_unitario = " . $_GET["valor_unitario"];
        }
        if (!empty($_GET["fornecedor"])) {
            $sql .= " AND fornecedor like '%" . $_GET["fornecedor"] . "%'";
        }
        // criando a consulta usando a variavel sql    // result vai receber a consulta feita no banco
        $result = $conn->query($sql);
        ?>
        <div class="row z-depth-4 <?= $tema_formulario ?>">
            <h4 class="<?= $tema_texto ?>">Consultar Produto</h4>
            <form action="consultar_banco.php" method="get">
                <div class="input-field col s12 m2">
                    <input placeholder="Código" type="number" name="pk_codproduto" value="<?php if (isset($_GET["pk_codproduto"])) echo $_GET["pk_codproduto"]; ?>">
                    <label class="<?= $tema_texto ?>">Código</label>
                </div>
                <div class="input-field col s12 m4">
                    <input placeholder="Nome" type="text" name="nome" value="<?php if (isset($_GET["nome"])) echo $_GET["nome"]; ?>">
                    <label class="<?= $tema_texto ?>">Nome</label>
                </div>
                <div class="input-field col s12 m2">
                    <input placeholder="Valor Unitário" type="number" step="0.01" name="valor_unitario" value="<?php if (isset($_GET["valor_unitario"])) echo $_GET["valor_unitario"]; ?>">
                    <label class="<?= $tema_texto ?>">Valor Unitário</label>
                </div>
                <div class="input-field col s12 m4">
                    <input placeholder="Fornecedor" type="text" name="fornecedor" value="<?php if (isset($_GET["fornecedor"])) echo $_GET["fornecedor"]; ?>">
                    <label class="<?= $tema_texto ?>">Fornecedor</label>
                </div>
                <div class="col 12">
                    <button class="btn waves-effect waves-light <?= $tema_botao ?>" type="submit" style="margin-bottom: 7px;">Consultar Produto</button>
                    <a class="btn waves-effect waves-light <?= $tema_botao ?>" href="consultar_banco.php" style="margin-bottom: 7px;">Limpar Consulta</a>
                    <p class="<?= $tema_texto ?>">Resultados encontrados: <?= $result->num_rows ?></p>
                </div>
            </form>
        </div>
        <table class="striped z-depth-4 <?= $tema_tabela ?>">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Valor Unitário</th>
                    <th>Fornecedor</th>
                    <th>Alterar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // fetch_assoc = buscar por associação // procura linha por linha caso ela não exista ele sai do loop
                while ($row = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?= $row["pk_codproduto"] ?></td>
                        <td><?= $row["nome"] ?></td>
                        <td><?= $row["valor_unitario"] ?></td>
                        <td><?= $row["fornecedor"] ?></td>
                        <td><button class="waves-effect waves-light btn-floating blue darken-4" onclick='alterarProduto("<?= $row["pk_codproduto"] ?>")'>
                                <i class="material-icons">edit</i></button></td>
                        <td><button class="waves-effect waves-light btn-floating red darken-4" onclick='excluirProduto("<?= $row["pk_codproduto"] ?>")'>
                                <i class="material-icons">delete</i></button></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
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

        function alterarProduto(pk_codproduto) {
            window.open("cadastrar_banco.php?pk_codproduto=" + pk_codproduto, "_self");
        }

        function excluirProduto(pk_codproduto) {
            if (confirm("Deseja realmente excluir este produto?")) {
                window.open("excluir_produto.php?pk_codproduto=" + pk_codproduto, "_self")
            }
        }
    </script>
    </body>

</html>