<?php
include ("../../includes/seguranca.php");
// Inclui o arquivo com o sistema de segurança
protegePagina();
$TituloSub = "Cadastrar Venda";
$Sub = 2;
require_once '../../includes/requires/header.php';
?>
<script>
    $(document).ready(function() {
        $("#btn_cadastros-Gerente").addClass("active");
        $("#cadastroVenda").addClass("active");
    });
</script>
<body>
    <div class="wrap">
        <div class="PagePainel">
            <?php
            require_once 'requires/topoPainel_vendedor.php';
            ?>
            <div class="ContentPainel">
                <div class="content-inner">
                    <div class="col-md-8 col-md-offset-2">
                        <form class="form-horizontal" method="get" name="formBuscarAmigo" action="">
                            <div class="input-group">
                                <input type="text" class="form-control" name="codAmigo" id="codAmigo" placeholder="Digite o Código do Amigo aperte Enter."  style="width: 550px;"/>
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        Pesquisar
                                    </button>
                                </span>
                            </div>
                        </form>
                        <br/>
                        <br/>
                    </div>
                    <div class="tabelaResultado col-md-10 col-md-offset-1">
                        <?php
                        $codAmigo = $_GET['codAmigo'];
                        $resultado = mysql_query("SELECT * FROM `Amigo` where idAmigo='$codAmigo'");
                        $obj = mysql_fetch_object($resultado);
                        $cont = mysql_num_rows($resultado);
                        if ($cont > 0) :
                            ?>
                            <h5 style="text-align: center;">Atribuir Venda<br/><i style="color: red;"><?php echo $obj->nome ?></i>&nbsp;-&nbsp;<i><?php echo $obj->contato ?></i> 
                                &nbsp;-&nbsp;<i><?php echo $obj->endereco ?></i>&nbsp;-&nbsp;<i>Total de Pontos: <?php if ($obj->pontuacao > 0) : ?><a rel='shadowbox' title='Histórico de Vendas de <?php echo $obj->nome ?>' href="historicoVendas.php?idAmigo=<?php echo $obj->idAmigo ?>">
                                        <?php echo $obj->pontuacao ?></i></a><?php endif; ?><?php if ($obj->pontuacao <= 0) : ?><a href=""> 000  </a><?php endif; ?>
                            </h5>
                            <br/>
                            <form class="form-horizontal" method="post" role="form" name="formAtribuirVenda" action="../../includes/functions/cadastrosPvendedor/venda.php">
                                <div class="pull-left">
                                    <div class="form-group">
                                        <label>Nota Fiscal</label>
                                        <input type="text" class="form-control" name="notaFiscal" placeholder="Digite o Código da Nota fiscal." style="width: 350px" required="true"/>
                                        <input type="hidden"  name="idAmigo" value="<?php echo $obj->idAmigo ?>">
                                        <input type="hidden"  name="idUsuario" value="<?php echo $_SESSION['usuarioID']; ?>">
                                        <input type="hidden"  name="dataVenda" value="<?php echo date("d/m/Y"); ?>">
                                    </div>
                                </div>
                                <div class="pull-right">
                                    <div class="form-group">
                                        <label>Valor em R$ da Nota</label>
                                        <input type="text" class="form-control" name="valorNotaFiscal" placeholder="Digite o valor em real da nota." style="width: 350px" required="true"/>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">
                                            <span class="glyphicon glyphicon-flash"></span>&nbsp;&nbsp;Atribuir Venda!
                                        </button>
                                    </div>
                                </div>
                            </form>
                            </h5>
                        <?php endif; ?>
                        <?php if ($cont == 0) : ?>
                            <h4 style="text-align: center;">Nenhum Amigo cadastrado, digite o código do amigo a cima.</h4>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            </body>
            </html>