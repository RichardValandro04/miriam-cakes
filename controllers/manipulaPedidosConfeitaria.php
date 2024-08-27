<?php
require_once(__DIR__.'/../models/pedidoDAO.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe o corpo da requisição (JSON)
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        // Lidar com erro de JSON
        $_SESSION['mensagem'] = "Erro ao processar os dados!";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    if(isset($data)){
        $idPedido = $data['idPedido'];
        $operacao = $data['operacao'];

        if($operacao === "aceitar"){
            $pedidoDAO = new PedidoDAO();
            if($pedidoDAO->aceitaPedido($idPedido)){
                $_SESSION['mensagem'] = "Pedido aceito com Sucesso!";
            }

            else{
                $_SESSION['mensagem'] = "Erro ao Aceitar Pedido";
                header('Location:' . $_SERVER['HTTP_REFERER']);
            }
        } 
        
        else if($operacao === "recusar"){
            $pedidoDAO = new PedidoDAO();
            if($pedidoDAO->recusaPedido($idPedido)){
                $_SESSION['mensagem'] = "Pedido Recusado com Sucesso!";
            }
            
            else{
                $_SESSION['mensagem'] = "Erro ao Recusar Pedido";
                header('Location:' . $_SERVER['HTTP_REFERER']);
            }
        }

        else if($operacao === "finalizar"){
            $pedidoDAO = new PedidoDAO();
            if($pedidoDAO->finalizaPedido($idPedido)){
                $_SESSION['mensagem'] = "Pedido Finalizado com Sucesso!";
            } 
            else{
                $_SESSION['mensagem'] = "Erro ao Finalizar Pedido";
                header('Location:' . $_SERVER['HTTP_REFERER']);
            }
        }
    }else{
        $_SESSION['mensagem'] = "Dados Não Encontrados!";
        header('Location:' . $_SERVER['HTTP_REFERER']);
    }
}

?>