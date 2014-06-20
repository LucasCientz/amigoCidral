<?php
include ("../../includes/seguranca.php");
// Inclui o arquivo com o sistema de segurança
protegePagina();
$TituloSub = "Cadastrar Amigo";
$Sub = 2;
require_once '../../includes/requires/header.php';
?>
<script>
    $(document).ready(function() {
        $("#btn_cadastros-Gerente").addClass("active");
        $("#cadastroAmigo").addClass("active");
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
                    <div class="pull-left">
                        <form class="form-horizontal" role="form" method="post" action="../../includes/functions/cadastrosPvendedor/amigo.php">
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" class="form-control" name="nomeAmigo" placeholder="Isira o nome completo do Amigo" style="width: 500px" required="true">
                                <input type="hidden" class="form-control" name="idUsuario"  value="<?php echo $_SESSION['usuarioID']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Endereço</label>
                                <input type="text" class="form-control" name="enderecoAmigo" style="width: 500px">
                            </div>
                            <div class="form-group">
                                <label>Contato</label>
                                <input type="text" class="form-control" name="contatoAmigo" style="width: 250px">
                            </div>
                    </div>
                    <div class="pull-right">
                        <div class="form-group">
                            <label>CPF</label>
                            <input type="text" class="form-control" name="cpfAmigo"  style="width: 250px" required="true">
                        </div>
                        <div class="form-group">
                            <label>Profissão</label>
                            <input type="text" class="form-control" name="profissaoAmigo"  style="width: 250px" required="true">
                        </div>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <div class="form-group">
                            <a class="btn btn-default" onclick="return confirmar();" href="listarAmigos.php?pagina=1"> Cancelar e Voltar </a>
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