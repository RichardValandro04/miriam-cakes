<?php
//CLASSE
    class TamanhoBolo{
        private $idTamanhoBolo;
        private $quantidadeFatias;
        private $valor;
    
//CONSTRUTOR
    public function __construct ($quantidadeFatias, $valor) {
        $this->quantidadeFatias = $quantidadeFatias;
        $this->valor = $valor;
    }

//GETTERS E SETTERS
    public function setIdTamanhoBolo($idTamanhoBolo){
        $this->idTamanhoBolo = $idTamanhoBolo;
    }
    public function getIdTamanhoBolo(){
        return $this->idTamanhoBolo;
    }

    public function setQuantidadeFatias($quantidadeFatias){
        $this->quantidadeFatias;
    }
    public function getQuantidadeFatias(){
        return $this->quantidadeFatias;
    }
    
    public function setValor($valor){
        $this->valor = $valor;
    }
    public function getValor(){
        return $this->valor;
    }
}
?>