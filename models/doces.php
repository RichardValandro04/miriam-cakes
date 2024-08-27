<?php
//CLASSE
class Doce{
    private $idDoce;
    private $nomeSabor;
    private $valorDezena;
    private $linkFoto;
    //CONSTRUTOR
    public function __construct($nomeSabor,$valorDezena,$linkFoto){
        $this->nomeSabor = $nomeSabor;
        $this->valorDezena = $valorDezena;
        $this->linkFoto = $linkFoto;
    }
    //SETTERS E GETTERS
    public function setIdDoce($idDoce){
        $this->idDoce = $idDoce;
    }
    public function getIdDoce(){
        return $this->idDoce;
    }

    public function setNomeSabor($nomeSabor){
        $this->nomeSabor = $nomeSabor;
    }
    public function getNomeSabor(){
        return $this->nomeSabor;
    }

    public function setValorDezena($valorDezena){
        $this->valorDezena = $valorDezena;
    }
    public function getValorDezena(){
        return $this->valorDezena;
    }

    public function setLinkFoto($linkFoto){
        $this->linkFoto = $linkFoto;
    }
    public function getLinkFoto(){
        return $this->linkFoto;
    }
}
?>