<?php
//CLASSE
    class Endereco{
        private $idEndereco;
        private $idUsuarioEndereco;
        private $cep;
        private $rua;
        private $bairro;
        private $cidade;
        private $uf;
        private $numeroCasa;
        private $complemento;

//CONSTRUTOR
    public function __construct($idUsuarioEndereco, $cep, $rua, $bairro, $cidade, $uf, $numeroCasa, $complemento){
        $this->idUsuarioEndereco = $idUsuarioEndereco;
        $this->cep = $cep;
        $this->rua = $rua;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->uf = $uf;
        $this->numeroCasa = $numeroCasa;
        $this->complemento = $complemento;
    }

//SETTERS E GETTERS
    public function setIdEndereco($idEndereco){
        $this->idEndereco = $idEndereco;
    }
    public function getIdEndereco(){
        return $this->idEndereco;
    }

    public function setCep($cep){
        $this->cep = $cep;
    }
    public function getCep(){
        return $this->cep;
    }

    public function setRua($rua){
        $this->rua = $rua;
    }
    public function getRua(){
        return $this->rua;
    }


    public function setBairro($bairro){
        $this->bairro = $bairro;
    }
    public function getBairro(){
        return $this->bairro;
    }


    public function setCidade($cidade){
        $this->cidade = $cidade;
    }
    public function getCidade(){
        return $this->cidade;
    }


    public function setUf($uf){
        $this->uf = $uf;
    }
    public function getUf(){
        return $this->uf;
    }





    public function setNumeroCasa($numeroCasa){
        $this->numeroCasa = $numeroCasa;
    }
    public function getNumeroCasa(){
        return $this->numeroCasa;
    }

    public function setComplemento($complemento){
        $this->complemento = $complemento;
    }
    public function getComplemento(){
        return $this->complemento;
    }

    public function setIdUsuarioEndereco($idUsuarioEndereco){
        $this->idUsuarioEndereco = $idUsuarioEndereco;
    }
    public function getIdUsuarioEndereco(){
        return $this->idUsuarioEndereco;
    }
    }
?>