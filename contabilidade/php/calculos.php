<?php
/**
 * Created by PhpStorm.
 * User: joao.santos
 * Date: 01/03/2018
 * Time: 10:14
 */
    require 'conexoestabelas.php';

    if($_POST['category'] == 'pagamento'){
        $exec = new calculos();
        $exec->Pagamento();
    }
class calculos{

        public function ValoresProsoftExcel(){

        }

        public function Pagamento(){
            $dataInicial = $_POST['datainicial'];
            $dataFinal = $_POST['datafinal'];
            $entrada = 'entrada';
            if($dataInicial == '' || $dataFinal == ''){
                echo "<script language='javascript' type='text/javascript'> alert('Por favor corrija os campos da data!');window.location.href='../conciliacaocalculos.php';</script>";
            }else{
                //02022018
                $dataInicial = preg_replace('/[^0-9]/', '',$dataInicial);
                $dataFinal = preg_replace('/[^0-9]/','' ,$dataInicial);

                $dataInicial = substr($dataInicial, 4,4).'-'.substr($dataInicial, 2,2).'-'.substr($dataInicial, 0,2);
                $dataFinal = substr($dataFinal, 4,4).'-'.substr($dataFinal, 2,2).'-'.substr($dataFinal, 0,2);

                $conn = new conexoes();
                $prosoft = $conn->ConexaoExcel()->prepare('SELECT numero_nota, data, terceiro, valor_contabil, tipoexcel FROM excel_importado WHERE tipoexcel = ?  AND data BETWEEN ? AND ?');
                $prosoft->bindParam(1, $entrada);
                $prosoft->bindParam(2, $dataInicial);
                $prosoft->bindParam(3, $dataFinal);
                $prosoft->execute();
                while($retornoProsoft = $prosoft->fetch(PDO::FETCH_ASSOC)){
                    echo $retornoProsoft['numero_nota'].'<br>';

                }
                echo "<br>";
                $stmt = $conn->ConexaoExcel()->prepare('SELECT data, numero_documento, conta_debito, conta_credito, cnpj, valor, historico, data_lancamento FROM pagamento_txt WHERE data BETWEEN ? AND ?');
                $stmt->bindParam(1, $dataInicial);
                $stmt->bindParam(2, $dataFinal);
                $stmt->execute();
                while($retornoPagamento = $stmt->fetch(PDO::FETCH_ASSOC)){
                    echo "<br>".$retornoPagamento['numero_documento'];
                }
            }
        }

}