<?php
//CLASSE
    class Usuario{
        private $idUsuario;
        private $nome;
        private $email;
        private $cpf;
        private $telefone;
        private $senha;


        
//CONSTRUTOR
    public function __construct ($nome, $email, $cpf, $telefone, $senha){
        $this->nome = $nome;
        $this->email = $email;
        $this->cpf = $cpf;
        $this->telefone = $telefone;
        $this->senha = $senha;
    }
//SETTERS E GETTERS
    public function setIdUsuario($idUsuario){
        $this->idUsuario = $idUsuario;
    }
    public function getIdUsuario(){
        return $this->idUsuario;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }
    public function getNome(){
        return $this->nome;
    }

    public function setEmail($email){
        $this->email = $email;
    }
    public function getEmail(){
        return $this->email;
    }

    public function setCpf($cpf){
        $this->cpf = $cpf;
    }
    public function getCpf(){
        return $this->cpf;
    }

    public function setTelefone($telefone){
        $this->telefone = $telefone;
    }
    public function getTelefone(){
        return $this->telefone;
    }

    public function setSenha($senha){
        $this->senha = $senha;
    }
    public function getSenha(){
        return $this->senha;
    }
}
?>