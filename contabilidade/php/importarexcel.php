<?php
ini_set('max_execution_time','-1');
if(isset($_FILES['file'])){
    date_default_timezone_get("Brazil/East");

    $ext = strtolower(substr($_FILES['file']['name'],-4));
    $new_name = date('d.m.Y-H.i.s.') . $ext;
    $dir = '../uploadsXls/';

    move_uploaded_file($_FILES['file']['tmp_name'], $dir.$new_name);

}

$caminho = '../uploadsXls/' .$new_name;
/* Seta configuração para não dar timeout */
ini_set('max_execution_time','-1');

/* Require com a classe de importação construída */
require 'importarplanilhaexcel.php';
require 'conexoes.php';


/* Instância conexão PDO com o banco de dados */

    $pdo = new PDO('mysql:host=localhost:3307;dbname=conciliacao', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


/* Instância o objeto importação e passa como parâmetro o caminho da planilha e a conexão PDO */
$obj = new ImportaPlanilha($caminho, $pdo);

$obj->getQtdeLinhas();
$obj->getQtdeColunas();

/* Chama o método que inseri os dados e captura a quantidade linhas importadas */
$linhasImportadas = $obj->insertDados($_POST['category']);

echo "<script language='javascript' type='text/javascript'> alert('Arquivo importado com sucesso! Linhas importadas: $linhasImportadas');window.location.href='../conciliacaocontabil.php';</script>";
?>