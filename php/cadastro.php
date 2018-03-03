<?php
$login = $_POST['user'];
$senha = $_POST['password'];
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
        try {
            $stmt = $con->prepare('INSERT INTO usuario(login,senha) VALUES(?,?)');
            $stmt->bindParam(1, $login);
            $stmt->bindParam(2, $senha);
            if($stmt->execute()){

            }else{
                echo "<script language='javascript' type='text/javascript'> alert('Esse login já existe! Por favor insira outro login.');window.location.href='/Clientes/cadastro.menu';</script>";
            }
        } catch (PDOException $e) {
            echo "<script language='javascript' type='text/javascript'> alert('Erro de conexão com o banco de dados!');window.location.href='/Clientes/cadastro.menu';</script>";
        }
}
?>