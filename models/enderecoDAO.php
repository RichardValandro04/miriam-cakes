<?php

require_once 'crud.php';
require_once 'endereco.php';



class enderecoDAO extends CRUD{

    protected $table = 'endereco';

    public function insert($endereco){
        $sql = "INSERT INTO $this->table (fk_id_usuario, cep, rua, bairro, cidade, uf, numero_casa, complemento) VALUES (:idUsuario, :cep, :rua, :bairro, :cidade, :uf,:numero_casa, :complemento)";

        $idUsuario = $endereco->getIdUsuarioEndereco();
        $cep = $endereco->getCep();
        $rua = $endereco->getRua();
        $bairro = $endereco->getBairro();
        $cidade = $endereco->getCidade();
        $uf =$endereco->getUf();
        $num = $endereco->getNumeroCasa();
        $complemento = $endereco->getComplemento();

        $stmt = Database::prepare($sql);
		$stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
		$stmt->bindParam(':cep', $cep);
        $stmt->bindParam(':rua', $rua);
        $stmt->bindParam(':bairro', $bairro);
        $stmt->bindParam(':cidade', $cidade);
        $stmt->bindParam(':uf', $uf);
		$stmt->bindParam(':numero_casa', $num);
		$stmt->bindParam(':complemento',$complemento );
		
		return $stmt->execute();
    }

    public function update($idUsuario, $endereco){

        $sql = "UPDATE $this->table SET cep = :cep , numero_casa = :numero_casa, complemento = :complemento WHERE fk_id_usuario = :idUsuario";


        $stmt = Database::prepare($sql);
        $stmt->bindParam(':cep', $endereco->getCep(), PDO::PARAM_INT);
		$stmt->bindParam(':numero_casa', $endereco->getNumeroCasa(), PDO::PARAM_INT);
		$stmt->bindParam(':complemento', $endereco->getComplemento());
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
		
		return $stmt->execute();
    }

    public function pesquisaEnderecoPorUsuario($idUsuario){
        $sql = "SELECT * FROM $this->table WHERE fk_id_usuario = :idUsuario";
        $stmt = Database::prepare($sql);
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_BOTH);

    }
}
?>