<?php
include ("../../includes/seguranca.php");
// Inclui o arquivo com o sistema de segurança
protegePagina();
$TituloSub = "Cadastrar Premio";
$Sub = 2;
require_once '../../includes/requires/header.php';
?>
<script>
    $(document).ready(function() {
        $("#btn_cadastros-Gerente").addClass("active");
        $("#cadastroPremio").addClass("active");
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
                    <div class="pull-left">
                        <form class="form-horizontal" enctype="multipart/form-data" role="form" method="post" action="../../includes/functions/cadastros/premio.php">
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" class="form-control" name="nomePremio" placeholder="Nome do Premio" style="width: 500px" required="true">
                            </div>
                            <div class="form-group">
                                <label for="imagem">Miniatura do Premio</label>
                                <input type="file" name="imagemPremio" id="imagemPremio"/>
                                <p class="help-block">
                                    *O nome dos arquivos das imagens devem ser diferentes umas das outras.<br/>
                                    *Caso o nome do arquivo da imagem for igual a outra, dará conflito.<br/>
                                    *Tamanho recomendado: <br/>
                                    *Adicione somente imagens.<br/>
                                    *Tenha certeza da imagem que esta enviado.
                                </p>
                            </div>
                    </div>
                    <div class="pull-right">
                        <div class="form-group">
                            <label>Valor em Pontos</label>
                            <input type="text" class="form-control" name="valorPremio" style="width: 250px" required="true">
                        </div>
                        <div class="form-group">
                            <label>Descriçao</label>
                            <textarea class="form-control" name="descricaoPremio" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <a class="btn btn-default" onclick="return confirmar();" href="listarPremios.php?pagina=1"> Cancelar e Voltar </a>
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