<?php
$idUsuario = $_SESSION['usuarioID'];
$ObjUsuario = mysql_fetch_object(mysql_query("SELECT * FROM Usuario where idUsuario='$idUsuario'"));
if ($ObjUsuario->tipo == 3) {
    echo "<script type='text/javascript'>javascript:history.go(-1)</script>";
}
?>
<div class="topoPainel_gerente">
    <div id="logo" >
        <a href="#"><img src="../../imagens/LogoCidral.png"/></a>
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-primary btn-noBorder dropdown-toggle" data-toggle="dropdown">
                <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;<?php echo $_SESSION['usuarioNome']; ?>
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li>
                    <a href="#"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;&nbsp;Suporte / Ajuda</a>
                </li>
                <li>
                    <a href="../../includes/sair.php"><span class="glyphicon glyphicon-off"></span>&nbsp;&nbsp;Sair do Sistema</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="pull-right">
        <div class="menuPainel_gerente">
            <div class="btn-group">
                <a id="btn_home-Gerente" type="button" class="btn btn-danger" href="index.php"> <span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Início </a>
                <div class="btn-group">
                    <button id="btn_cadastros-Gerente" type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Cadastros <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li id="cadastroVendedor">
                            <a href="cadastrarVendedor.php"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Cadastrar Vendedor</a>
                        </li>
                        <li id="cadastroAmigo">
                            <a href="cadastrarAmigo.php"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Cadastrar Amigo (Cliente)</a>
                        </li>
                        <li id="cadastroPremio">
                            <a href="cadastrarPremio.php"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Cadastrar Premio</a>
                        </li>
                        <li id="cadastroVenda">
                            <a href="cadastrarVenda.php"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Cadastrar Venda</a>
                        </li>
                    </ul>
                </div>
                <div class="btn-group">
                    <button id="btn_listar-Gerente" type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;Listagem de Cadastros <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li id="listarVendedor">
                            <a href="listarVendedores.php?pagina=1"><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;Listar Vendedores e Gerentes</a>
                        </li>
                        <li id="listarAmigo">
                            <a href="listarAmigos.php?pagina=1"><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;Listar Amigos</a>
                        </li>
                        <li id="listarPremio">
                            <a href="listarPremios.php?pagina=1"><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;Listar Premios</a>
                        </li>
                        <li id="listarVenda">
                            <a href="listarVendas.php?pagina=1"><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;Listar Vendas</a>
                        </li>
                    </ul>
                </div>
                <a id="btn_amigoseResgate-Gerente" type="button" class="btn btn-danger" href="amigoseResgates.php?pagina=1&filter=padrao"><span class="glyphicon glyphicon-star"></span>&nbsp;&nbsp;Amigos e Resgates </a>
            </div>
        </div>
    </div>
</div>