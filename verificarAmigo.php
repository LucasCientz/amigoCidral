<?php
$TituloSub = "Verificar Amigo";
$Sub = 0;
require_once 'includes/requires/header.php';
?>
<body>
    <script>
        $(document).ready(function() {
            $("#btn_VerificarPontos").addClass("active");
        });
    </script>
    <div class="wrap">
        <div class="page">
            <?php
            require_once 'includes/requires/topo.php';
            ?>
            <div class="content">
                <ol class="breadcrumb">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li class="active">
                        Verificar Pontos de Amigo
                    </li>
                </ol>
                <br/>
                <div class="col-md-8 col-md-offset-2">
                    <form class="form-horizontal" method="get" action="">
                        <div class="input-group">
                            <input type="text" class="form-control" name="codAmigo" id="codAmigo" placeholder="Digite o Código do Amigo"  style="width: 550px;">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    Pesquisar
                                </button>
                            </span>
                        </div>
                    </form>
                    <br/>
                    <br/>
                    <div class="tabelaResultado col-md-10 col-md-offset-1">
                        <?php
                        include ("includes/conectar.php");
                        mysql_select_db($basedados, $conexao);
                        $codAmigo = isset($_GET['codAmigo']);
                        $resultado = mysql_query("SELECT * FROM `Amigo` where idAmigo='$codAmigo'");
                        $obj = mysql_fetch_object($resultado);
                        $cont = mysql_num_rows($resultado);
                        if ($cont > 0) :
                            ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td>Nome</td>
                                        <td>Total de Pontos</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php
                                        echo "<td>$obj->nome</td>";
                                        echo "<td>$obj->pontuacao</td>";
                                        ?>
                                    </tr>
                                </tbody>
                            </table>
                        <?php endif; ?>
                        <?php if ($cont == 0) :
                            ?>
                            <h4 style="text-align: center;">Nenhum Amigo cadastrado</h4>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php
            require_once 'includes/requires/footer.php';
            ?>
        </div>
    </div>
</body>
</html>