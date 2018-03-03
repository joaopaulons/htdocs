<?php
/**
 * Created by PhpStorm.
 * User: joao.santos
 * Date: 28/02/2018
 * Time: 10:53
 */
require 'conexoestabelas.php';
class classImportarTxt{

    public function AbrirTxtPagamento($arquivo){
        $file = fopen($arquivo, 'r');

        while(!feof($file)){
            $linha = fgets($file);
            $itens = array(trim(substr($linha, 16,4).substr($linha, 14,2).substr($linha, 12,2)), trim(substr($linha,20,10)), trim(substr($linha,68,5)), trim(substr($linha,73,14)), trim(substr($linha,92,5)),trim(substr($linha,116,16)),
                trim(substr($linha,133,240)));
            $stmt = new conexoestabelas();
            $stmt->InsertPagamento($itens[0], $itens[1], $itens[2], $itens[3], $itens[4], $itens[5], $itens[6]);
        }
    }

    public function AbrirTxtPagamentoJuros($arquivo){
        $file = fopen($arquivo, 'r');

        while(!feof($file)){
            $linha = fgets($file);
            $itens = array(trim(substr($linha, 16,4).substr($linha, 14,2).substr($linha, 12,2)), trim(substr($linha,20,10)), trim(substr($linha,92,5)), trim(substr($linha,97,14)), trim(substr($linha,68,5)),trim(substr($linha,116,16)),
                trim(substr($linha,134,240)));
            $stmt = new conexoestabelas();
            $stmt->InsertPagamento($itens[0], $itens[1], $itens[2], $itens[3], $itens[4], $itens[5], $itens[6]);
        }
    }

    public function AbrirTxtPagamentoDescontos($arquivo){
        $file = fopen($arquivo, 'r');

        while(!feof($file)){
            $linha = fgets($file);
            $itens = array(trim(substr($linha, 16,4).substr($linha, 14,2).substr($linha, 12,2)), trim(substr($linha,20,10)), trim(substr($linha,68,5)), trim(substr($linha,73,14)), trim(substr($linha,92,5)),trim(substr($linha,116,16)),
                trim(substr($linha,133,240)));
            $stmt = new conexoestabelas();
            $stmt->InsertPagamento($itens[0], $itens[1], $itens[2], $itens[3], $itens[4], $itens[5], $itens[6]);
        }
    }

    public function AbrirTxtRecebimento($arquivo){
        $file = fopen($arquivo, 'r');

        while(!feof($file)){
            $linha = fgets($file); /*   DATA                                                                                            */  /*          NUMERO DOCUMENTO          */ /*           CONTA DEBITO           */   /*           CNPJ                    */  /*           CONTA CREDITO       */    /*           VALOR                   */
            $itens = array(trim(substr($linha, 16,4).substr($linha, 14,2).substr($linha, 12,2)), trim(substr($linha,20,10)), trim(substr($linha,92,5)), trim(substr($linha,97,14)), trim(substr($linha,68,5)),trim(substr($linha,116,16)),
                trim(substr($linha,133,376)));
            $stmt = new conexoestabelas();
            $stmt->InserirRecebimento($itens[0], $itens[1], $itens[2], $itens[3], $itens[4], $itens[5], $itens[6]);
        }
    }

    public function AbrirTxtRecebimentoJuros($arquivo){
        $file = fopen($arquivo, 'r');

        while(!feof($file)){
            $linha = fgets($file); /*   DATA                                                                                            */  /*          NUMERO DOCUMENTO          */ /*           CONTA DEBITO           */   /*           CNPJ                    */  /*           CONTA CREDITO       */    /*           VALOR                   */
            $itens = array(trim(substr($linha, 16,4).substr($linha, 14,2).substr($linha, 12,2)), trim(substr($linha,20,10)), trim(substr($linha,68,5)), trim(substr($linha,73,14)), trim(substr($linha,92,5)),trim(substr($linha,116,16)),
                trim(substr($linha,133,376)));
            $stmt = new conexoestabelas();
            $stmt->InserirRecebimento($itens[0], $itens[1], $itens[2], $itens[3], $itens[4], $itens[5], $itens[6]);
        }
    }

    public function AbrirTxtRecebimentoDescontos($arquivo){
        $file = fopen($arquivo, 'r');

        while(!feof($file)){
            $linha = fgets($file); /*   DATA                                                                                            */  /*          NUMERO DOCUMENTO          */ /*           CONTA DEBITO           */   /*           CNPJ                    */  /*           CONTA CREDITO       */    /*           VALOR                   */
            $itens = array(trim(substr($linha, 16,4).substr($linha, 14,2).substr($linha, 12,2)), trim(substr($linha,20,10)), trim(substr($linha,92,5)), trim(substr($linha,97,14)), trim(substr($linha,68,5)),trim(substr($linha,116,16)),
                trim(substr($linha,133,376)));
            $stmt = new conexoestabelas();
            $stmt->InserirRecebimento($itens[0], $itens[1], $itens[2], $itens[3], $itens[4], $itens[5], $itens[6]);
        }
    }
}