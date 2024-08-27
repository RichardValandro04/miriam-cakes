<?php

require_once 'crud.php';
require_once 'recheioBolo.php';



class RecheioBoloDAO extends CRUD{
    //pk_id_recheio	nome_recheio

    protected $table = 'recheiosbolo';

    public function insert($nomeRecheio){
        $sql = "INSERT INTO $this->table (nome_recheio) VALUES (:nome_recheio)";

        $stmt = Database::prepare($sql);
		$stmt->bindParam(':nome_recheio', $nomeRecheio);
		
		return $stmt->execute();
    }

    public function update($idRecheio, $recheioBolo){

        $sql = "UPDATE $this->table SET nome_recheio = :nome_recheio WHERE pk_id_recheio = :idRecheio";


        $nomeRecheio = $recheioBolo->getNomeRecheio();

        $stmt = Database::prepare($sql);
        $stmt->bindParam(':nome_recheio', $nomeRecheio);
        $stmt->bindParam(':idRecheio', $idRecheio);
		
		return $stmt->execute();
    }

    public function  pesquisaRecheios(){
        $sql = "SELECT * FROM $this->table ORDER BY nome_recheio ASC";
        $stmt = Database::prepare($sql);			
        $stmt->execute();
        //retorna um array com os registros da tabela indexado pelo nome da coluna da tabela e por um número
        return $stmt->fetchAll(PDO::FETCH_BOTH );
        
    }

    public function pesquisaUnica($nome) {
        // Define a consulta SQL
        $sql = "SELECT pk_id_recheio FROM $this->table WHERE nome_recheio = :nome";
        // Prepara a instrução SQL
        $stmt = Database::prepare($sql);
        // Vincula o parâmetro
        $stmt->bindParam(':nome', $nome);
        // Executa a instrução SQL
        $stmt->execute();
        // Retorna o resultado da consulta
        return $stmt->fetch(PDO::FETCH_BOTH);
    }
}
?>