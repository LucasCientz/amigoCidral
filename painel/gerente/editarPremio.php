<?php
include ("../../includes/seguranca.php");
// Inclui o arquivo com o sistema de segurança
protegePagina();
$TituloSub = "Cadastrar Premio";
$Sub = 2;
require_once '../../includes/requires/header.php';
//Pega dados para ediçao
$idPremio = $_GET['id'];
$resultado = mysql_query("SELECT * FROM `Premio` where idPremio='$idPremio'");
$obj = mysql_fetch_object($resultado);
?>
<script>
    $(document).ready(function() {
        $("#btn_listar-Gerente").addClass("active");
        $("#listarPremio").addClass("active");
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
                    <h4>Editar Premio</h4>
                    <div class="pull-left">
                        <form class="form-horizontal" enctype="multipart/form-data" role="form" method="post" action="../../includes/functions/edicoes/premio.php?id=<?php echo $idPremio ?>">
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" class="form-control" name="nomePremio" value="<?php echo $obj->nome ?>" style="width: 500px" required="true"> 
                            </div>
                            <div class="form-group">
                                <label for="imagem">Miniatura do Premio</label>
                                <br/>
                                <?php
                                if ($obj->imagem == "") {

                                    echo "<img src='../../imagens/holder.png' alt='$obj->nome' width='300' height='210' />";
                                } else {

                                    echo "<a href='../../imagens/miniaturas/" . $obj->imagem . "' rel='shadowbox[galeria]' title='$obj->nome'><img src='../../imagens/miniaturas/" . $obj->imagem . "' alt='$obj->nome' width='150' /></a>";
                                }
                                ?>
                                <br/>
                                <br/>
                                <input type="file" name="imagemPremio" id="imagemPremio"/>
                            </div>
                    </div>
                    <div class="pull-right">
                        <div class="form-group">
                            <label>Valor em Pontos</label>
                            <input type="text" class="form-control" name="valorPremio" value="<?php echo $obj->valor ?>" style="width: 250px" required="true">
                        </div>
                        <div class="form-group">
                            <label>Descriçao</label>
                            <textarea class="form-control" name="descricaoPremio" rows="4"><?php echo $obj->descricao ?></textarea>
                        </div>
                        <div class="form-group">
                            <a class="btn btn-default" onclick="return confirmar();" href="listarPremios.php?pagina=1">Cancelar e Voltar</a>
                            <button type="submit" class="btn btn-success">
                                <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;&nbsp;Salvar
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>