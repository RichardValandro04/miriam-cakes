<?php

require_once 'crud.php';
require_once 'pedido.php';



class pedidoDAO extends CRUD{
//pk_id_pedido	data_entrega	hora_entrega	valortotal_pedido	fk_id_usuario	fk_id_endereco	metodo_entrega	situacao	

    protected $table = 'pedidos';
    protected $tableBolo = 'itembolo';
    protected $tableDoce = 'itemdoce';
    protected $tableRecheios = 'recheiosescolhidos';

    public function insert($pedido){
        $sql = "INSERT INTO $this->table 
        (data_entrega,
        hora_entrega,
        valortotal_pedido,
        fk_id_usuario,
        fk_id_endereco,
        metodo_entrega) 

    VALUES (:data_entrega,
        :hora_entrega,
        :valortotal_pedido,
        :fk_id_usuario,
        :fk_id_endereco,
        :metodo_entrega)";
        
        $data_entrega = $pedido->getDataEntrega();
        $hora_entrega = $pedido->getHoraEntrega();
        $valortotal_pedido = $pedido->getValorTotalPedido();
        $fk_id_usuario = $pedido->getIdUsuario();
        $fk_id_endereco = $pedido->getIdEndereco();
        $metodo_entrega = $pedido->getMetodoDeEntrega();
        $situacao = $pedido->getSituacao();

        $stmt = Database::prepare($sql);
		$stmt->bindParam(':data_entrega', $data_entrega);
		$stmt->bindParam(':hora_entrega', $hora_entrega);
		$stmt->bindParam(':valortotal_pedido', $valortotal_pedido);
        $stmt->bindParam(':fk_id_usuario', $fk_id_usuario);
        $stmt->bindParam(':fk_id_endereco', $fk_id_endereco);
        $stmt->bindParam(':metodo_entrega', $metodo_entrega);
		
        if ($stmt->execute()) {
            return Database::lastInsertId();
        } else {
            return false;
        }
    }

    public function update($idPedido, $pedido) {
        // Consulta SQL para atualizar um pedido
        $sql = "UPDATE $this->table 
                SET data_entrega = :data_entrega, 
                    hora_entrega = :hora_entrega, 
                    valortotal_pedido = :valortotal_pedido, 
                    fk_id_usuario = :fk_id_usuario, 
                    fk_id_endereco = :fk_id_endereco, 
                    metodo_entrega = :metodo_entrega, 
                    situacao = :situacao 
                WHERE pk_id_pedido = :pk_id_pedido";
        
        // Preparar valores
        $pk_id_pedido = $pedido->getIdPedido();
        $data_entrega = $pedido->getDataEntrega();
        $hora_entrega = $pedido->getHoraEntrega();
        $valortotal_pedido = $pedido->getValorTotalPedido();
        $fk_id_usuario = $pedido->getIdUsuario();
        $fk_id_endereco = $pedido->getIdEndereco();
        $metodo_entrega = $pedido->getMetodoDeEntrega();
        $situacao = $pedido->getSituacao();


        $stmt = Database::prepare($sql);
        $stmt->bindParam(':pk_id_pedido', $pk_id_pedido, PDO::PARAM_INT);
        $stmt->bindParam(':data_entrega', $data_entrega);
        $stmt->bindParam(':hora_entrega', $hora_entrega);
        $stmt->bindParam(':valortotal_pedido', $valortotal_pedido);
        $stmt->bindParam(':fk_id_usuario', $fk_id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':fk_id_endereco', $fk_id_endereco, PDO::PARAM_INT);
        $stmt->bindParam(':metodo_entrega', $metodo_entrega);
        $stmt->bindParam(':situacao', $situacao);
            
        return $stmt->execute();
    }

    public function pesquisaPedidosPorSituacao($situacao){
        $sql = "SELECT * FROM $this->table WHERE situacao = :situacao ORDER BY data_entrega ASC";
        $stmt = Database::prepare($sql);
        $stmt->bindParam(':situacao', $situacao);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function pesquisaPedidosPorUsuario($situacao, $idUsuario){
        $sql = "SELECT * FROM $this->table WHERE situacao = :situacao AND fk_id_usuario = :fk_id_usuario ORDER BY data_entrega ASC";
        $stmt = Database::prepare($sql);
        $stmt->bindParam(':situacao', $situacao);
        $stmt->bindParam(':fk_id_usuario', $idUsuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } 

        public function insereBolo($idPedido, $idTamanhoBolo){
            $sql = "INSERT INTO $this->tableBolo (fk_id_pedido, fk_id_tamanho_bolo) VALUES (:fk_id_pedido, :fk_id_tamanho_bolo)";

            $stmt = Database::prepare($sql);
            $stmt->bindParam(':fk_id_pedido', $idPedido, PDO::PARAM_INT);
            $stmt->bindParam(':fk_id_tamanho_bolo', $idTamanhoBolo, PDO::PARAM_INT);
        
            if ($stmt->execute()) {
                return Database::lastInsertId();
            } else {
                return false;
            }
        }

        public function insereDoce($idPedido, $idDoce, $quantidade, $valorTotal){
            $sql = "INSERT INTO $this->tableDoce (fk_id_pedido, fk_id_doce, quantidade, valortotal) VALUES (:fk_id_pedido, :fk_id_doce, :quantidade, :valortotal)";

            $stmt = Database::prepare($sql);
            $stmt->bindParam(':fk_id_pedido', $idPedido, PDO::PARAM_INT);
            $stmt->bindParam(':fk_id_doce', $idDoce, PDO::PARAM_INT);
            $stmt->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
            $stmt->bindParam(':valortotal', $valorTotal);
        
            if ($stmt->execute()) {
                return Database::lastInsertId();
            } else {
                return false;
            }
        }



        public function insereRecheiosEscolhidos($idBolo, $idRecheio){
            $sql = "INSERT INTO $this->tableRecheios (fk_id_item_bolo, fk_id_recheio) VALUES (:fk_id_item_bolo, :fk_id_recheio)";
            $stmt = Database::prepare($sql);
            
            $stmt->bindParam(':fk_id_item_bolo', $idBolo, PDO::PARAM_INT);
            $stmt->bindParam(':fk_id_recheio', $idRecheio, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return Database::lastInsertId();
            } else {
                return false;
            }

        }

        public function aceitaPedido($idPedido){
            $sql = "UPDATE $this->table SET situacao = 'em andamento' WHERE pk_id_pedido = :id";
            $stmt = Database::prepare($sql);
            
            $stmt->bindParam(':id', $idPedido, PDO::PARAM_INT);
            $stmt->execute();
        }

        public function recusaPedido($idPedido){
            $sql = "UPDATE $this->table SET situacao = 'cancelado' WHERE pk_id_pedido = :id";
            $stmt = Database::prepare($sql);
            
            $stmt->bindParam(':id', $idPedido, PDO::PARAM_INT);
            $stmt->execute();            
        }

        public function finalizaPedido($idPedido){
            $sql = "UPDATE $this->table SET situacao = 'concluido' WHERE pk_id_pedido = :id";
            $stmt = Database::prepare($sql);
            
            $stmt->bindParam(':id', $idPedido, PDO::PARAM_INT);
            $stmt->execute();            
        }

        public function listaProxEntregas() {
            $sql = "SELECT p.pk_id_pedido, p.data_entrega, u.nome 
                    FROM $this->table AS p 
                    INNER JOIN usuarios AS u ON p.fk_id_usuario = u.pk_id_usuario 
                    WHERE p.situacao = 'em andamento'
                    ORDER BY p.data_entrega ASC 
                    LIMIT 6";
            $stmt = Database::prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        
}
?>