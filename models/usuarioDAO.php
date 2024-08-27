<?php

require_once 'crud.php';
require_once 'usuario.php';



class UsuarioDAO extends CRUD{

    protected $table = 'usuarios';

    public function insert($usuario){
        $sql = "INSERT INTO $this->table (nome, email, cpf, telefone, senha) VALUES (:nome, :email, :cpf, :telefone, :senha)";

        $nome = $usuario->getNome();
        $email =  $usuario->getEmail();
        $cpf = $usuario->getCpf();
        $telefone = $usuario->getTelefone();
        $senha = $usuario->getSenha();

        $stmt = Database::prepare($sql);
		$stmt->bindParam(':nome', $nome);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':cpf', $cpf);
		$stmt->bindParam(':telefone', $telefone );
		$stmt->bindParam(':senha', $senha);

		if ($stmt->execute()) {
            return Database::lastInsertId();
        } else {
            return false;
        }
    }

    public function update($idUsuario, $usuario){

        $sql = "UPDATE $this->table SET nome = :nome , email = :email, cpf = :cpf, telefone = :telefone, senha = :senha WHERE pk_id_usuario = :id";

        $nome = $usuario->getNome();
        $email =  $usuario->getEmail();
        $cpf = $usuario->getCpf();
        $telefone = $usuario->getTelefone();
        $senha = $usuario->getSenha();

        $stmt = Database::prepare($sql);
		$stmt->bindParam(':nome', $nome);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':cpf', $cpf);
		$stmt->bindParam(':telefone', $telefone );
		$stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':id', $idUsuario, PDO::PARAM_INT);
		
		return $stmt->execute();
    }

    public function alteraEmail($idUsuario, $email){

        $sql = "UPDATE $this->table SET email = :email WHERE pk_id_usuario = :id";

        $stmt = Database::prepare($sql);
		$stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $idUsuario, PDO::PARAM_INT);
		
		return $stmt->execute();
    }

    public function alteraTelefone($idUsuario, $telefone){

        $sql = "UPDATE $this->table SET telefone = :telefone WHERE pk_id_usuario = :id";

        $stmt = Database::prepare($sql);
		$stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':id', $idUsuario, PDO::PARAM_INT);
		
		return $stmt->execute();
    }


    public function pesquisaUsuarioEmail($email){
        $sql = "SELECT * FROM $this->table WHERE email = :email";
        $stmt = Database::prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_BOTH);
    }

    public function pesquisaUsuarioCpf($cpf){
        $sql = "SELECT * FROM $this->table WHERE cpf = :cpf";
        $stmt = Database::prepare($sql);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_BOTH);

    }

    public function pesquisaUsuarioTelefone($telefone){
        $sql = "SELECT * FROM $this->table WHERE telefone = :telefone";
        $stmt = Database::prepare($sql);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_BOTH);

    }

    public function  pesquisaUsuarios(){
        $sql = "SELECT * FROM $this->table WHERE tipo_usuario = 'comum' ORDER BY nome ASC";
        $stmt = Database::prepare($sql);			
        $stmt->execute();
        //retorna um array com os registros da tabela indexado pelo nome da coluna da tabela e por um número
        return $stmt->fetchAll(PDO::FETCH_BOTH );
        
    }
}
?>