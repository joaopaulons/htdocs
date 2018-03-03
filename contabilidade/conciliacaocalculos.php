<?php
ini_set('max_execution_time','-1');
require 'php/conexoes.php';
$conn = new conexoes();
$stmt = $conn->ConexaoExcel()->prepare('SELECT id, data, numero_documento, conta_debito, conta_credito, cnpj, valor, historico, data_lancamento FROM pagamento_txt');
$stmt->execute();
$ultimoIDPagamento = $stmt->rowCount();
$stmtRec = $conn->ConexaoExcel()->prepare('SELECT id, data, numero_documento, conta_debito, conta_credito, cnpj, valor, historico, data_lancamento FROM recebimento_txt');
$stmtRec->execute();
$ultimoIDRecebimento = $stmtRec->rowCount();


$stmt = $conn->ConexaoExcel()->prepare('');
?>

<!DOCTYPE html>
<html class="no-js">

<head>
    <title>Duarte Contabilidade</title>
    <!-- Bootstrap -->
    <meta charset="UTF-8">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="../vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
    <link href="../assets/styles.css" rel="stylesheet" media="screen">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="../vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <script src="ferramentas/jquery.mask.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.datainicial').mask('0000-00-00');
            $('.datafinal').mask('0000-00-00');
        });
    </script>
</head>

<body>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="#">Agiliza Duarte</a>
            <div class="nav-collapse collapse">
                <ul class="nav pull-right">
                    <li class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> João Paulo<i class="caret"></i>

                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a tabindex="-1" href="#">Perfil</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a tabindex="-1" href="login.html">Sair</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- MENU SUPERIOR -->
                <ul class="nav">
                    <li class="active">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">Contabilidade</a>
                    </li>
                    <li class="dropdown">
                        <a href="#">Fiscal</a>
                    <li class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Usuarios<i class="caret"></i></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a tabindex="-1" href="#">Usuários</a>
                            </li>
                            <li>
                                <a tabindex="-1" href="#">Permissões</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>
<!-- MENU LADO ESQUERDO-->
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span3" id="sidebar">
            <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
                <li class="active">
                    <a href="../index.html"><i class="icon-hand-right icon-chevron-right"></i> Contabilidade</a>
                </li>
                <li>
                    <a href="calendar.html"><i class="icon-hand-right icon-chevron-right"></i>Fiscal</a>
                </li>
                <li>
                    <a href="stats.html"><i class="icon-hand-right icon-chevron-right"></i>Departamento Pessoal</a>
                </li>

            </ul>
        </div>
        <!-- FIM MENU LADO ESQUERDO-->

        <!--/span-->
        <div class="span9" id="content">
            <div class="row-fluid">
                <div class="row-fluid">
                    <div class="span10">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Realizar cálculo</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="control-group">
                                    <form class="form-actions" action="php/calculos.php" method="post" enctype="multipart/form-data">
                                        <label class="control-label">Opções para fazer o cálculo:<span class="required">*</span></label>
                                        <div class="controls">
                                            <select class="span6 m-wrap" name="category" required title="Por favor selecione uma categoria.">
                                                <option selected disabled>Selecione...</option>
                                                <option value="pagamento">Pagamento</option>
                                                <option value="recebimento">Recebimento</option>
                                            </select>

                                            <div class="control-group">
                                                <label class="control-label">Data inicial:<span class="required">*</span></label>
                                                <input class="input-small" required title="Por favor digite uma data inicial." id="datainicial" name="datainicial" >
                                            </div>
                                            <div class="control-group inline">
                                                <label class="control-label">Data final: <span class="required">*</span> </label>
                                                <input class="input-small"  required title="Por favor digite uma data final." id="datafinal" name="datafinal">
                                            </div>
                                        </div>
                                        <button class="btn-primary" type="submit">Calcular</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                </div>
                <div class="row">
                    <div class="span12">

                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>
    <footer class="modal-footer">
        <p>&copy Copyright 2018 duartecon.com.br - All Rights Reserved</p>
    </footer>
</div>
<!--/.fluid-container-->
<script src="../vendors/jquery-1.9.1.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../vendors/easypiechart/jquery.easy-pie-chart.js"></script>
<script src="../assets/scripts.js"></script>
<script>
    $(function() {
        // Easy pie charts
        $('.chart').easyPieChart({animate: 1000});
    });
</script>
</body>

</html>