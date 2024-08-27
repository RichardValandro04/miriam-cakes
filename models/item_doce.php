<?php
//CLASSE
    class ItemDoce{
        private $quantidade;
        private $valorTotalDoces;

//CONSTRUTOR
    public function __construct($quantidade, $valorTotalDoces){
        $this->quantidade = $quantidade;
        $this->valorTotalDoces = $valorTotalDoces;
    }

//SETTERS E GETTERS
    public function setQuantidade($quantidade){
        $this->quantidade = $quantidade;
    }
    public function getQuantidade(){
        return $this->quantidade;
    }

    public function setValorTotalDoces($valorTotalDoces){
        $this->valorTotalDoces = $valorTotalDoces;
    }
    public function getValorTotalDoces(){
        return $this->$valorTotalDoces;
    }
}
?>