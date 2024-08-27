<?php
//CLASSE
class RecheioBolo{
    private $idRecheio;
    private $nomeRecheio;
//CONSTRUTOR
    public function __construct ($nomeRecheio){
        $this->nomeRecheio = $nomeRecheio;
    }
    //SETTERS E GETTERS
    public function setIdRecheio($idRecheio){
        $this->idRecheio = $idRecheio;
    }
    public function getIdRecheios(){
        return $this->idRecheios;
    }
    public function setNomeRecheio($nomeRecheio){
        $this->nomeRecheio = $nomeRecheio;
    }
    public function getNomeRecheio(){
        return $this->nomeRecheio;
    }
}
?>