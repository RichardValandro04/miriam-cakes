<?php
//CLASSE
    class SaboresMassa{
        private $idMassa;
        private $nomeSabor;
//CONSTRUTOR
    public function __construct ($idMassa, $nomeSabor) {
        $this->idMassa = $idMassa;
        $this->nomeSabor = $nomeSabor;
    }
//SETTERS E GETTERS  
    public function setIdMassa($idMassa){
        $this->idMassa = $idMassa;
    }
    public function getIdMassa(){
        return $this->idMassa;
    }
    
    public function setNomeSabor($nomeSabor){
        $this->nomeSabor = $nomeSabor;
    }
    public function getNomeSabor(){
        return $this->nomeSabor;
    }
}
?>