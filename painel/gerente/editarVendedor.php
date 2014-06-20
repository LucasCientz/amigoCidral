<?php
include ("../../includes/seguranca.php");
// Inclui o arquivo com o sistema de segurança
protegePagina();
$TituloSub = "Editar Vendedor";
$Sub = 2;
require_once '../../includes/requires/header.php';
//Pega dados para ediçao
$idUsuario = $_GET['id'];
$resultado = mysql_query("SELECT * FROM `Usuario` where idUsuario='$idUsuario'");
$obj = mysql_fetch_object($resultado);
?>
<script>
    $(document).ready(function() {
        $("#btn_listar-Gerente").addClass("active");
        $("#listarVendedor").addClass("active");
    });
</script>
<body>
    <div class="wrap">
        <div class="PagePainel">
            <?php
            require_once 'requires/topoPainel_gerente.php';
            ?>
            <div class="ContentPainel">
                <div class="content-inner">
                    <h4>Editar Vendedor</h4>
                    <div class="pull-left">
                        <form class="form-horizontal" role="form" method="post" action="../../includes/functions/edicoes/vendedor.php?id=<?php echo $idUsuario ?>">
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" class="form-control" name="nomeVendedor" value="<?php echo $obj->nome ?>" style="width: 500px" required="true">
                            </div>
                            <div class="form-group">
                                <label>Login</label>
                                <input type="text" class="form-control" name="usuarioVendedor" value="<?php echo $obj->usuario ?>" style="width: 250px" required="true">
                            </div>
                            <div class="form-group">
                                <label>Senha</label>
                                <input type="text" class="form-control" name="senhaVendedor" value="<?php echo $obj->senha ?>" style="width: 250px" required="true">
                            </div>
                            <div class="form-group">
                                <a class="btn btn-default" onclick="return confirmar();" href="listarVendedores.php?pagina=1"> Cancelar e Voltar </a>
                                <button type="submit" class="btn btn-success">
                                    <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;&nbsp;Salvar
                                </button>
                            </div>
                        </form>
                    </div>
                    <br/><br/>
                    <div class="pull-right">
                        <div class="well">
                            <h5>Cadastro de Vendedor.</h5>
                            <p><b>Atençao</b>, revisar atentamente os dados.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>