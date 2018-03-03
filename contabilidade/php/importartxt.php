<?php
ini_set('max_execution_time', '-1');
require 'classimportartxt.php';

$category = $_POST['category'];
$file = $_FILES['file']['name'];

if($category == 'pagamento' && !empty($file)){
    date_default_timezone_get('America/Sao_paulo');
    $ext = strtolower(substr($_FILES['file']['name'],-4));
    $new_name = date('d.m.Y-H.i.s').$ext;
    $dir = '../uploadsTxts/';
    move_uploaded_file($_FILES['file']['tmp_name'],$dir.$new_name);

    $caminho = '../uploadsTxts/'.$new_name;

    $open = new ClassImportarTxt();
    $open = $open->AbrirTxtPagamento($caminho);

    echo "<script language='javascript' type='text/javascript'> alert('Importação feita com sucesso!');window.location.href='../conciliacaocontabil.php';</script>";
}elseif($category == 'pagamento-juros' && !empty($file)){
    date_default_timezone_get('America/Sao_paulo');
    $ext = strtolower(substr($_FILES['file']['name'],-4));
    $new_name = date('d.m.Y-H.i.s').$ext;
    $dir = '../uploadsTxts/';
    move_uploaded_file($_FILES['file']['tmp_name'],$dir.$new_name);

    $caminho = '../uploadsTxts/'.$new_name;

    $open = new ClassImportarTxt();
    $open = $open->AbrirTxtPagamentoJuros($caminho);
    echo "<script language='javascript' type='text/javascript'> alert('Importação feita com sucesso!');window.location.href='../conciliacaocontabil.php';</script>";
}elseif($category == 'pagamento-descontos' && !empty($file)){
    date_default_timezone_get('America/Sao_paulo');
    $ext = strtolower(substr($_FILES['file']['name'],-4));
    $new_name = date('d.m.Y-H.i.s').$ext;
    $dir = '../uploadsTxts/';
    move_uploaded_file($_FILES['file']['tmp_name'],$dir.$new_name);

    $caminho = '../uploadsTxts/'.$new_name;

    $open = new ClassImportarTxt();
    $open = $open->AbrirTxtPagamentoJuros($caminho);
    echo "<script language='javascript' type='text/javascript'> alert('Importação feita com sucesso!');window.location.href='../conciliacaocontabil.php';</script>";
}elseif($category == 'recebimento' && !empty($file)){
    date_default_timezone_get('America/Sao_paulo');
    $ext = strtolower(substr($_FILES['file']['name'],-4));
    $new_name = date('d.m.Y-H.i.s').$ext;
    $dir = '../uploadsTxts/';
    move_uploaded_file($_FILES['file']['tmp_name'],$dir.$new_name);

    $caminho = '../uploadsTxts/'.$new_name;

    $open = new ClassImportarTxt();
    $open = $open->AbrirTxtRecebimento($caminho);
    echo "<script language='javascript' type='text/javascript'> alert('Importação feita com sucesso!');window.location.href='../conciliacaocontabil.php';</script>";
}elseif($category == 'recebimento-juros' && !empty($file)){
    date_default_timezone_get('America/Sao_paulo');
    $ext = strtolower(substr($_FILES['file']['name'],-4));
    $new_name = date('d.m.Y-H.i.s').$ext;
    $dir = '../uploadsTxts/';
    move_uploaded_file($_FILES['file']['tmp_name'],$dir.$new_name);

    $caminho = '../uploadsTxts/'.$new_name;

    $open = new ClassImportarTxt();
    $open = $open->AbrirTxtRecebimentoJuros($caminho);
    echo "<script language='javascript' type='text/javascript'> alert('Importação feita com sucesso!');window.location.href='../conciliacaocontabil.php';</script>";
}elseif($category == 'recebimento-descontos' && !empty($file)){
    date_default_timezone_get('America/Sao_paulo');
    $ext = strtolower(substr($_FILES['file']['name'],-4));
    $new_name = date('d.m.Y-H.i.s').$ext;
    $dir = '../uploadsTxts/';
    move_uploaded_file($_FILES['file']['tmp_name'],$dir.$new_name);

    $caminho = '../uploadsTxts/'.$new_name;

    $open = new ClassImportarTxt();
    $open = $open->AbrirTxtRecebimentoDescontos($caminho);
    echo "<script language='javascript' type='text/javascript'> alert('Importação feita com sucesso!');window.location.href='../conciliacaocontabil.php';</script>";
}else{
    echo 'Selecione uma opção!';
}
?>