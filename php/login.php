<?php
$login = $_POST['user'];
$senha = MD5($_POST['senha']);
try{
    $username = "joaopaulons";
    $password = "newemo140497@";
    $con = new PDO('mysql:host=loginclientes.mysql.uhserver.com;dbname=loginclientes', $username, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo 'ERROR: ' .$e->getMessage();
}
if($login == "" || $login == null || $senha == "" || $senha == null){
    echo "<script language='javascript' type='text/javascript'> alert('Preencha corretamente o campo de login e senha!');window.location.href='/Clientes';</script>";
}else {
    $stmt = $con->prepare('SELECT login FROM usuario WHERE login = ? AND senha = ?');
    $stmt->bindParam(1, $login);
    $stmt->bindParam(2, $senha);
    if ($stmt->execute()) {
        echo "<script language='javascript' type='text/javascript'> alert('Login efetuado com sucesso!');window.location.href='../tapecaria/painel_de_controle.html';</script>";
    } else {
        echo "<script language='javascript' type='text/javascript'> alert('Login e senha inválidos!');window.location.href='/Clientes';</script>";
    }

}
?>