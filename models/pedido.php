<?php
//CLASSE
    class Pedido{
        private $idPedido;
        private $dataEntrega;
        private $horaEntrega;
        private $valorTotalPedido;
        private $fk_id_usuario;
        private $fk_id_endereco;
        private $metodoDeEntrega;
        private $situacao;

//CONSTRUTOR
    public function __construct($dataEntrega, $horaEntrega, $valorTotalPedido, $fk_id_usuario, $fk_id_endereco, $metodoDeEntrega) {
        $this->dataEntrega = $dataEntrega;
        $this->horaEntrega = $horaEntrega;
        $this->valorTotalPedido = $valorTotalPedido;
        $this->fk_id_usuario = $fk_id_usuario;
        $this->fk_id_endereco = $fk_id_endereco;
        $this->metodoDeEntrega = $metodoDeEntrega; 
    }

//SETTERS E GETTERS
    public function setIdPedido($idPedido){
        $this->idPedido = $idPedido;
    }
    public function getIdPedido(){
        return $this->idPedido;
    }

    public function setDataEntrega($dataEntrega){
        $this->dataEntrega = $dataEntrega;
    }
    public function getDataEntrega(){
        return $this->dataEntrega;
    }

    public function setHoraEntrega($horaEntrega){
        $this->horaEntrega = $horaEntrega;
    }
    public function getHoraEntrega(){
        return $this->horaEntrega;
    }

    public function setValorTotalPedido($valorTotalPedido){
        $this->valorTotalPedido = $valorTotalPedido;
    }
    public function getValorTotalPedido(){
        return $this->valorTotalPedido;
    }    

    public function setIdUsuario($fk_id_usuario){
        $this->fk_id_usuario = $fk_id_usuario;
    }
    public function getIdUsuario(){
        return $this->fk_id_usuario;
    }

    public function setIdEndereco($fk_id_endereco){
        $this->fk_id_endereco = $fk_id_endereco;
    }
    public function getIdEndereco(){
        return $this->fk_id_endereco;
    }

    public function setMetodoDeEntrega($metodoDeEntrega){
        $this->metodoDeEntrega = $metodoDeEntrega;
    }
    public function getMetodoDeEntrega(){
        return $this->metodoDeEntrega;
    }

    public function setSituacao($situacao){
        $this->situacao = $situacao;
    }
    public function getSituacao(){
        return $this->situacao;
    }
}
?>