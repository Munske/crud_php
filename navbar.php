<nav class="<?= $tema_cabecalho ?>">
    <div class="nav-wrapper">
        <a data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <ul style="margin-left: 50px; border: none;" class="collection left">
            <li>
                <img style="height:50px; width: 50px; border: none;" src="img/logo.png" />
            </li>
        </ul>
        <ul class="left" style="margin-left: 30px;">
            <li>
                <h5>Olá <?= $Login ?></h5>
            </li>
        </ul>
        <ul class="hide-on-med-and-down right">
            <li>
                <a class="dropdown-trigger" data-target="menu_produtos">
                    Produtos <i class="material-icons right">arrow_drop_down</i>
                </a>
            </li>
            <li>
                <a class="dropdown-trigger" data-target="menu_config">
                    Configurações<i class="material-icons right">brightness_7 arrow_drop_down</i>
                </a>
            </li>
        </ul>
        <ul id="menu_produtos" class="dropdown-content grey lighten-3">
            <li><a class="black-text" href="consultar_banco.php">Consultar Produtos</a></li>
            <li><a class="black-text" href="cadastrar_banco.php">Cadastrar Produtos</a></li>
        </ul>
        <ul id="menu_config" class="dropdown-content grey lighten-3">
            <li><a class="black-text" href="alterar_senha.php">Trocar senha</a></li>
            <li><a class="black-text" href="logout.php">Sair (<?= $Login ?>)</a></li>
        </ul>
    </div>
</nav>

<!-- <p><a class="black-text" href="login.php">Sair</a></p> -->

<ul class="sidenav grey lighten-1" id="mobile-demo">
    <li>
        <a class="dropdown-trigger" data-target="menu_produtos_mobile">
            Produtos <i class="material-icons right">arrow_drop_down</i>
        </a>
    </li>
    <li>
        <a class="dropdown-trigger" data-target="menu_config_mobile">
            Configurações<i class="material-icons right">brightness_7 arrow_drop_down</i>
        </a>
    </li>

    <ul id="menu_produtos_mobile" class="dropdown-content grey lighten-3">
        <li><a class="black-text" href="consultar_banco.php">Consultar Produto</a></li>
        <li><a class="black-text" href="cadastrar_banco.php">Cadastrar Produto</a></li>
    </ul>
    <ul id="menu_config_mobile" class="dropdown-content grey lighten-3">
        <li><a class="black-text" href="alterar_senha.php">Trocar senha</a></li>
        <li><a class="black-text" href="logout.php">Sair (<?= $Login ?>)</a></li>
    </ul>
</ul>