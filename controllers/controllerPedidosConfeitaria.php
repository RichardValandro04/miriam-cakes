<?php 

// Classe de acesso ao banco de dados
// __DIR__ -> O diretório físico do arquivo
require_once(__DIR__.'/../models/pedidoDAO.php');

class ControllerPedidosConfeitaria {

    public function __construct() { }

    // Método para listar pedidos por situação e usuário
    public function listaPedidos($situacao) {
        try {
            // Instancia a classe de acesso ao banco de dados
            $pedidoDAO = new PedidoDAO();
            return $pedidoDAO->pesquisaPedidosPorSituacao($situacao);
        }
        catch (Exception $excecao) {
            // Em caso de exceção, você pode logar o erro ou tratá-lo conforme necessário
            error_log($excecao->getMessage());
            return []; // Retorna um array vazio em caso de erro
        }
    }


    public function aceitaPedido($idPedido) {
        try {
            // Instancia a classe de acesso ao banco de dados
            $pedidoDAO = new PedidoDAO();
            if($pedidoDAO->aceitaPedido($idPedido)){
                return "Pedido Aceito!";
            }
        }
        catch (Exception $excecao) {
            // Em caso de exceção, você pode logar o erro ou tratá-lo conforme necessário
            error_log($excecao->getMessage());
            return []; // Retorna um array vazio em caso de erro
        }
    }

    public function listaProxEntregas() {
        try {
            // Instancia a classe de acesso ao banco de dados
            $pedidoDAO = new PedidoDAO();
            return $pedidoDAO->listaProxEntregas();
        }
        catch (Exception $excecao) {
            // Em caso de exceção, você pode logar o erro ou tratá-lo conforme necessário
            error_log($excecao->getMessage());
            return []; // Retorna um array vazio em caso de erro
        }
    }
}

?>

