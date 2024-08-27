<?php

require_once 'crud.php';
require_once 'tamanhos_bolo.php';



class TamanhosBoloDAO extends CRUD{
    //pk_id_recheio	nome_recheio

    protected $table = 'tamanhosbolo';

    public function insert($tamanhoBolo){
        $sql = "INSERT INTO $this->table (quantidade_fatias, valor) VALUES (:quantidade_fatias, :valor)";

        $quantidade_fatias = $tamanhoBolo->getQuantidadeFatias();
        $valor = $tamanhoBolo->getValor();

        $stmt = Database::prepare($sql);
		$stmt->bindParam(':quantidade_fatias', $quantidade_fatias);
		$stmt->bindParam(':valor', $valor);
		
		return $stmt->execute();
    }

    public function update($idTamanho, $tamanhoBolo){

        $sql = "UPDATE $this->table SET quantidade_fatias = :quantidade_fatias , valor = :valor WHERE pk_id_tamanho_bolo = :pk_id_tamanho_bolo";


        $quantidade_fatias = $tamanhoBolo->getQuantidadeFatias();
        $valor = $tamanhoBolo->getValor();

        $stmt = Database::prepare($sql);
		$stmt->bindParam(':quantidade_fatias', $quantidade_fatias);
		$stmt->bindParam(':valor', $valor);
        $stmt->bindParam(':pk_id_tamanho_bolo', $idTamanho);
		
		return $stmt->execute();
    }

    public function  pesquisaTamanhos(){
        $sql = "SELECT * FROM $this->table ORDER BY quantidade_fatias ASC";
        $stmt = Database::prepare($sql);			
        $stmt->execute();
        //retorna um array com os registros da tabela indexado pelo nome da coluna da tabela e por um número
        return $stmt->fetchAll(PDO::FETCH_BOTH );
        
    }

}
?>