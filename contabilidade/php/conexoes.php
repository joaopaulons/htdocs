<?php
/**
 * Created by PhpStorm.
 * User: joao.santos
 * Date: 28/02/2018
 * Time: 11:00
 */

class conexoes{

    public function ConexaoExcel(){
        try{
            $conn = new PDO('mysql:host=localhost:3307;dbname=conciliacao', "root","");
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            return $conn;
        }catch (PDOException $erro){
            echo $erro->getMessage();
        }
    }
}