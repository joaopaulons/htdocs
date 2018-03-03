<?php
/**
 * Created by PhpStorm.
 * User: joao.santos
 * Date: 01/03/2018
 * Time: 14:43
 */
require 'conexoes.php';
class conexoestabelas{
    public function SelectProsoftPagamento(){
        $conn = new conexoes();
        $stmt = $conn->ConexaoExcel()->prepare('SELECT numero_nota, data, terceiro, valor_contabil, tipoexcel FROM excel_importado');

        return $stmt;
    }

    public function SelectPagamento(){
        $conn = new conexoes();
        $stmt = $conn->ConexaoExcel()->prepare('SELECT id, data, numero_documento, conta_debito, conta_credito, cnpj, valor, historico, data_lancamento FROM pagamento_txt');
        $stmt->execute();
        return $stmt;
    }

    public function SelectRecebimento(){
        $conn = new conexoes();
        $stmt = $conn->ConexaoExcel()->prepare('SELECT id, data, numero_documento, conta_debito, conta_credito, cnpj, valor, historico, data_lancamento FROM recebimento_txt');
        $stmt->execute();

        return $stmt;
    }

    public function InsertPagamento($data, $numero_documento, $conta_debito, $cnpj, $conta_credito, $valor, $historico)   {
        date_default_timezone_set('America/Sao_Paulo');
        $conn = new conexoes();
        $dataLocal = date('d/m/Y H:i:s', time());

        if($cnpj == ''){
            $cnpj = 'SEM TERCEIRO';
        }

        $stmt = $conn->ConexaoExcel()->prepare('INSERT INTO pagamento_txt(data, numero_documento, conta_debito, conta_credito, cnpj, valor, historico, data_lancamento) VALUES(?,?,?,?,?,?,?,?)');
        $data = utf8_encode($data);
        $numero_documento = utf8_encode($numero_documento);
        $conta_debito = utf8_encode($conta_debito);
        $conta_credito = utf8_encode($conta_credito);
        $cnpj = utf8_encode($cnpj);
        $valor = utf8_encode($valor);
        $historico = utf8_encode($historico);
        $dataLocal = utf8_encode($dataLocal);

        $numero_documento = explode(" ", $numero_documento);
        $numero_documento[0] = str_pad($numero_documento[0], 10, '0', STR_PAD_LEFT);
        $stmt->bindParam(1, $data);
        $stmt->bindParam(2, $numero_documento[0]);
        $stmt->bindParam(3, $conta_debito);
        $stmt->bindParam(4, $conta_credito);
        $stmt->bindParam(5, $cnpj);
        $stmt->bindParam(6, $valor);
        $stmt->bindParam(7, $historico);
        $stmt->bindParam(8, $dataLocal);
        $stmt->execute();
    }

    public function InsertRecebimento($data, $numero_documento, $conta_debito, $cnpj, $conta_credito, $valor, $historico)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $conn = new conexoes();
        $dataLocal = date('d/m/Y H:i:s', time());
        $stmt = $conn->ConexaoExcel()->prepare('INSERT INTO recebimento_txt(data, numero_documento, conta_debito, conta_credito, cnpj, valor, historico, data_lancamento) VALUES(?,?,?,?,?,?,?,?)');
        $data = utf8_encode($data);
        $numero_documento = utf8_encode($numero_documento);
        $conta_debito = utf8_encode($conta_debito);
        $conta_credito = utf8_encode($conta_credito);
        $cnpj = utf8_encode($cnpj);
        $valor = utf8_encode($valor);
        $historico = utf8_encode($historico);
        $dataLocal = utf8_encode($dataLocal);
        $stmt->bindParam(1, $data);
        $stmt->bindParam(2, $numero_documento);
        $stmt->bindParam(3, $conta_debito);
        $stmt->bindParam(4, $conta_credito);
        $stmt->bindParam(5, $cnpj);
        $stmt->bindParam(6, $valor);
        $stmt->bindParam(7, $historico);
        $stmt->bindParam(8, $dataLocal);
        $stmt->execute();


    }

    public function TruncatePagamento(){
        $conn = new conexoes();
        $stmt = $conn->ConexaoExcel()->prepare('TRUNCATE TABLE pagamento_txt');
        $stmt->execute();
        return $stmt;
    }

    public function TruncateRecebimento(){
        $conn = new conexoes();
        $stmt = $conn->ConexaoExcel()->prepare('TRUNCATE TABLE recebimento_txt');
        $stmt->execute();

        return $stmt;
    }

    public function DeletePagamento($id)
    {
        $conn = new conexoes();
        $stmt = $conn->ConexaoExcel()->prepare('DELETE FROM pagamento_txt WHERE id = ?');
        $stmt->bindParam(1, $id);
        $stmt->execute();
    }

    public function DeleteRecebimento($id){
        $conn = new conexoes();
        $stmt = $conn->ConexaoExcel()->prepare('DELETE FROM recebimento_txt WHERE id = ?');
        $stmt->bindParam(1, $id);
        $stmt->execute();
    }

}