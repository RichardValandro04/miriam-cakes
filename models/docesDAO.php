<?php

require_once 'crud.php';
require_once 'doces.php';



class DocesDAO extends CRUD{

    protected $table = 'doces';
    //pk_id_doce	nome_sabor	valor_dezena	link_foto	

    public function insert($doces){
        $sql = "INSERT INTO $this->table (nome_sabor, valor_dezena, link_foto) VALUES (:nome_sabor, :valor_dezena, :link_foto)";

        $nomeSabor = $doces->getNomeSabor();
        $valorDezena = $doces->getValorDezena();
        $link_foto = $doces->getLinkFoto();

        $stmt = Database::prepare($sql);
		$stmt->bindParam(':nome_sabor', $nomeSabor);
		$stmt->bindParam(':valor_dezena', $valorDezena);
		$stmt->bindParam(':link_foto', $link_foto);
		
		return $stmt->execute();
    }

    public function update($idDoce, $doces){

        $sql = "UPDATE $this->table SET nome_sabor = :nome_sabor , valor_dezena = :valor_dezena, link_foto = :link_foto WHERE pk_id_doce = :idDoce";


        $nomeSabor = $doces->getNomeSabor();
        $valorDezena = $doces->getValorDezena();
        $link_foto = $doces->getLinkFoto();

        $stmt = Database::prepare($sql);
        $stmt->bindParam(':nome_sabor', $nomeSabor);
		$stmt->bindParam(':valor_dezena', $valorDezena);
		$stmt->bindParam(':link_foto', $link_foto);
        $stmt->bindParam(':idDoce', $idDoce);
		
		return $stmt->execute();
    }

    public function  pesquisaDoces(){
        $sql = "SELECT * FROM $this->table ORDER BY nome_sabor ASC";
        $stmt = Database::prepare($sql);			
        $stmt->execute();
        //retorna um array com os registros da tabela indexado pelo nome da coluna da tabela e por um número
        return $stmt->fetchAll(PDO::FETCH_BOTH );
        
    }


    public function pesquisaUnica($nome) {
        // Define a consulta SQL
        $sql = "SELECT pk_id_doce FROM $this->table WHERE nome_sabor = :nome";
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