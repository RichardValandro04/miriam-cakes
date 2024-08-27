<?php 

// Classe de acesso ao banco de dados
// __DIR__ -> O diretório físico do arquivo
require_once(__DIR__.'/../models/pedidoDAO.php');

class ControllerPedidosCliente {

    public function __construct() { }

    // Método para listar pedidos por situação e usuário
    public function listaPedidos($situacao, $idUsuario) {
        try {
            // Instancia a classe de acesso ao banco de dados
            $pedidoDAO = new PedidoDAO();
            return $pedidoDAO->pesquisaPedidosPorUsuario($situacao, $idUsuario);
        }
        catch (Exception $excecao) {
            // Em caso de exceção, você pode logar o erro ou tratá-lo conforme necessário
            error_log($excecao->getMessage());
            return []; // Retorna um array vazio em caso de erro
        }
    }
}

?>
