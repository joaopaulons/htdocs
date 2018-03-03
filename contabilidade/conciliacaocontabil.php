<?php
ini_set('max_execution_time','-1');
require 'php/conexoes.php';
$conn = new conexoes();
$stmt = $conn->ConexaoExcel()->prepare('SELECT id, data, numero_documento, conta_debito, conta_credito, cnpj, valor, historico, data_lancamento FROM pagamento_txt WHERE id BETWEEN 0 AND 500');
$stmt->execute();
$ultimoIDPagamento = $stmt->rowCount();
$stmtRec = $conn->ConexaoExcel()->prepare('SELECT id, data, numero_documento, conta_debito, conta_credito, cnpj, valor, historico, data_lancamento FROM recebimento_txt WHERE id BETWEEN 0 AND 500');
$stmtRec->execute();
$ultimoIDRecebimento = $stmtRec->rowCount();
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
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
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
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> João Paulo <i class="caret"></i>

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
                    <div class="span6">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Importar o excel do Prosoft:</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="control-group">
                                    <form class="form-actions" action="php/importarexcel.php" method="post" enctype="multipart/form-data">
                                        <label class="control-label">Opções para importar:<span class="required">*</span></label>
                                        <div class="controls">
                                            <select class="span6 m-wrap" name="category" title="Por favor selecione uma categoria.">
                                                <option selected disabled>Selecione...</option>
                                                <option value="Entrada">Entrada</option>
                                                <option value="Saida">Saida</option>
                                            </select>
                                            <div class="control-group">
                                                <label class="control-label" for="fileInput">Selecione o arquivo:<span class="required">*</span> </label>
                                                <div class="controls">
                                                    <input class="input-file uniform_on " id="fileInput" type="file" name="file" data-msg-required="Por favor selecione uma opção." required>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn-primary" type="submit">Importar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                    <div class="span6">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Importar os Txt's:</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="control-group">
                                    <form class="form-actions" action="php/importartxt.php" method="post" enctype="multipart/form-data">
                                        <label class="control-label">Opções para importar:<span class="required">*</span></label>
                                        <div class="controls">
                                            <select class="span6 m-wrap" name="category" required>
                                                <option selected disabled>Selecione...</option>
                                                <option value="pagamento">Pagamento</option>
                                                <option value="pagamento-juros">Pagamento -> Juros</option>
                                                <option value="pagamento-descontos">Pagamento -> Descontos</option>
                                                <option value="recebimento">Recebimento</option>
                                                <option value="recebimento-juros">Recebimento -> Juros</option>
                                                <option value="recebimento-descontos">Recebimento -> Descontos</option>
                                            </select>
                                            <div class="control-group">
                                                <label class="control-label" for="fileInput">Selecione o arquivo:<span class="required">*</span> </label>
                                                <div class="controls">
                                                    <input class="input-file uniform_on " id="fileInput" type="file" name="file" required>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn-primary" type="submit">Importar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span12">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Pagamentos</div>
                                <div class="pull-right"><span class="badge badge-info">Registros: <?php echo $ultimoIDPagamento;?></span>

                                </div>
                            </div>
                            <div style="overflow: auto; height: 200px;" class="block-content collapse in">
                                <table class="table table-bordered" style="width: 1500px">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Data</th>
                                        <th>Numero Documento</th>
                                        <th>Conta Débito</th>
                                        <th>Conta Crédito</th>
                                        <th>CNPJ</th>
                                        <th>Valor</th>
                                        <th>Histórico</th>
                                        <th>Data de Lançamento</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    while($resultado = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $resultado['id'] ?></td>
                                            <td><?php echo $resultado['data'] ?></td>
                                            <td><?php echo $resultado['numero_documento'] ?></td>
                                            <td><?php echo $resultado['conta_debito'] ?></td>
                                            <td><?php echo $resultado['conta_credito'] ?></td>
                                            <td><?php echo $resultado['cnpj'] ?></td>
                                            <td><?php echo $resultado['valor'] ?></td>
                                            <td><?php echo $resultado['historico'] ?></td>
                                            <td><?php echo $resultado['data_lancamento'] ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span12">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Recebimentos</div>
                                <div class="pull-right"><span class="badge badge-info">812</span>

                                </div>
                            </div>
                            <div style="overflow: auto"  class="block-content collapse in">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>02/02/2013</td>
                                        <td>$25.12</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>01/02/2013</td>
                                        <td>$335.00</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>01/02/2013</td>
                                        <td>$29.99</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>01/02/2013</td>
                                        <td>$29.99</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>
        <footer>
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