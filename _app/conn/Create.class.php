<?php

/**
 * Create.class.php [TIPO]
 * Descricao
 * @copyright (c) year, Emanuel L.D. Silva elsWeb Freelancer
 */
class Create extends Conn {

    private $Tabela;
    private $Dados;
    private $Result;

    /** @var PDOStatement */
    private $Create;

    /** @var PDO */
    private $Conn;

    /**
     * DOCUMENTAR TODAS AS CLASSES 
     */
    public function ExeCreate($Tabela, array $Dados) {
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;
        
        $this->getSyntax();
        $this->Execute();
    }

    public function getResult() {
        return $this->Result;
    }
    
    /*
     * METODOS PRIVADOS
     */
    
    private function Connect() {
        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($this->Create);
    }
    
    private function getSyntax() {
        $Fileds = implode(', ',array_keys($this->Dados));
        $Places = ':' . implode(', :',array_keys($this->Dados));
        $this->Create = "INSERT INTO {$this->Tabela} ({$Fileds}) VALUES ({$Places})";
        
    }
    
    private function Execute() {
        $this->Connect();
        try {
            $this->Create->execute($this->Dados);
            $this->Result = $this->Conn->lastInsertId();
        } catch (PDOException $e) {
            $this->Result = null;
            echo "<b>Erro ao cadastrar </b> {$e->getMessage()}", $e->getCode();
        }
        
    }

}
