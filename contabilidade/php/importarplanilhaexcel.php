<?php
ini_set('max_execution_time','-1');
require_once "simplexlsx.class.php";

class ImportaPlanilha{

    // Atributo recebe a instância da conexão PDO
    private $conexao  = null;

    // Atributo recebe uma instância da classe SimpleXLSX
    private $planilha = null;

    // Atributo recebe a quantidade de linhas da planilha
    private $linhas   = null;

    // Atributo recebe a quantidade de colunas da planilha
    private $colunas  = null;

    /*
     * Método Construtor da classe
     * @param $path - Caminho e nome da planilha do Excel xlsx
     * @param $conexao - Instância da conexão PDO
     */
    public function __construct($path=null, $conexao=null){

        if(!empty($path) && file_exists($path)):
            $this->planilha = new SimpleXLSX($path);
            list($this->colunas, $this->linhas) = $this->planilha->dimension();
        else:
            echo 'Arquivo não encontrado!';
            exit();
        endif;

        if(!empty($conexao)):
            $this->conexao = $conexao;
        else:
            echo 'Conexão não informada!';
            exit();
        endif;

    }

    /*
     * Método que retorna o valor do atributo $linhas
     * @return Valor inteiro contendo a quantidade de linhas na planilha
     */
    public function getQtdeLinhas(){
        return $this->linhas;
    }

    /*
     * Método que retorna o valor do atributo $colunas
     * @return Valor inteiro contendo a quantidade de colunas na planilha
     */
    public function getQtdeColunas(){
        return $this->colunas;
    }

    /*
     * Método que verifica se o registro CPF da planilha já existe na tabela cliente
     * @param $cpf - CPF do cliente que está sendo lido na planilha
     * @return Valor Booleano TRUE para duplicado e FALSE caso não
     */
    private function isRegistroDuplicado($cpf=null){
        $retorno = false;

        try{
            if(!empty($cpf)):
                $sql = 'SELECT id FROM cliente WHERE cpf = ?';
                $stm = $this->conexao->prepare($sql);
                $stm->bindValue(1, $cpf);
                $stm->execute();
                $dados = $stm->fetchAll();

                if(!empty($dados)):
                    $retorno = true;
                else:
                    $retorno = false;
                endif;
            endif;


        }catch(Exception $erro){
            echo 'Erro: ' . $erro->getMessage();
            $retorno = false;
        }

        return $retorno;
    }

    /*
     * Método para ler os dados da planilha e inserir no banco de dados
     * @return Valor Inteiro contendo a quantidade de linhas importadas
     */
    public function insertDados($category){

        try{
            $sql = 'INSERT INTO excel_importado (numero_nota, data, terceiro, valor_contabil, tipoexcel)VALUES(?, ?, ?, ?,?)';
            $stm = $this->conexao->prepare($sql);
            $linha = 0;
            $antigoNota = 0;
            $antigoCpf = "SEM CPF";
            $valorAntigo = 0;
            foreach($this->planilha->rows() as $chave => $valor):
                //CONDIÇÃO -> Adicionando somente valores não repetidos
                if($valor[0] == $antigoNota && $valor[5] == $antigoCpf){

                }else{
                    $numeroNota   = trim($valor[0]);
                    $data  = trim(substr($valor[1],0,10));
                    $terceiro     = trim($valor[5]);
                    $valor_contabil   = trim($valor[9]);
                    if($terceiro == "" || $terceiro == null){
                        $terceiro = "SEM TERCEIRO";
                    }

                    //CONDIÇÃO -> Eliminando valores desnecessários
                    if($numeroNota == "Consulta de Notas Fiscais de Saída" || $numeroNota == "Consulta de Notas Fiscais de Entrada" ||  $numeroNota == "Empresa: 0260 - AMERIPAN PRODUTOS PARA PANIFICACAO LTDA"
                        || $terceiro == "Terceiro" || $valor_contabil == "Valor Contábil"){

                    }else{
                        $terceiro = preg_replace('#[^0-9]#', '', $terceiro);

                        $stm->bindValue(1, $numeroNota);
                        $stm->bindValue(2, $data);
                        $stm->bindValue(3, $terceiro);
                        $stm->bindValue(4, $valor_contabil);
                        $stm->bindValue(5, $category);
                        $stm->execute();
                        $linha++;
                    }
                    //FIM

                }

                //CONDIÇÃO -> Somando os valores repetidos
                if($valor[0] == $antigoNota && $valor[5] == $antigoCpf){
                    $valorAntigo = $valorAntigo + $valor[9];
                    $antigoCpf = preg_replace('#[^0-9]#', '', $antigoCpf);
                    $valorAntigo = str_pad('10','0',$valorAntigo,STR_PAD_LEFT);
                    $valorAntigo = str_replace(',','.',$valorAntigo);
                    $sql = 'UPDATE excel_importado SET valor_contabil = ? WHERE numero_nota = ? AND terceiro = ?';
                    $stmm = $this->conexao->prepare($sql);
                    $stmm->bindParam(1, $valorAntigo);
                    $stmm->bindParam(2, $antigoNota);
                    $stmm->bindParam(3, $antigoCpf);
                    $stmm->execute();
                }
                //FIM
                $valorAntigo = $valor[9];
                $antigoNota = $valor[0];
                $antigoCpf = $valor[5];
            endforeach;

            return $linha;
        }catch(Exception $erro){
            echo 'Erro: ' . $erro->getMessage();
        }

    }
}