<?php 
require_once(__DIR__.'/../models/docesDAO.php');
require_once(__DIR__.'/../models/enderecoDAO.php');
require_once(__DIR__.'/../models/pedido.php');
require_once(__DIR__.'/../models/pedidoDAO.php');
require_once(__DIR__.'/../models/tamanhosBoloDAO.php');
require_once(__DIR__.'/../models/usuarioDAO.php');
require_once(__DIR__.'/../models/recheioBoloDAO.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Código para manipulação de requisição POST
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

    if(isset($data['itensPedido'])){
        $_SESSION['pedido'] = $data['itensPedido'];
    }
    
    else if(isset($data['dadosComplementares'])){
        if (isset($_SESSION['pedido'])) {
            $dadosComplementares = array($data['dadosComplementares']);
            $dadosPedido = $_SESSION['pedido'];
            $pedidoCompleto = array_merge($dadosPedido, $dadosComplementares);

            $dataEntrega = $dadosComplementares[0]["dataEntrega"];
            $horaEntrega = $dadosComplementares[0]["horaEntrega"];
            $valorTotal = $dadosComplementares[0]["valorTotal"];
            $idUsuario = $_SESSION["idUsuario"];
            $idEndereco = $dadosComplementares[0]["idEndereco"];
            $metodo = $dadosComplementares[0]["metodo"];

            $pedido = new Pedido($dataEntrega, $horaEntrega, $valorTotal, $idUsuario, $idEndereco, $metodo);
            $pedidoDAO = new PedidoDAO();
            $idPedido = $pedidoDAO->insert($pedido);

            if($idPedido){
                forEach($dadosPedido as $itemPedido){
                    if($itemPedido["tipoProduto"] === "bolo"){
                        $idTamanho = $itemPedido["idProduto"];
                        $idItemBolo = $pedidoDAO->insereBolo($idPedido, $idTamanho);

                        if($idItemBolo){
                            $idRecheios = $itemPedido["idRecheiosEscolhidos"];

                            forEach($idRecheios as $id){
                                $pedidoDAO->insereRecheiosEscolhidos($idItemBolo, $id);
                            }

                        }else{
                            $_SESSION['mensagem'] = "Erro ao tentar inserir bolo!";
                            exit;
                        }


                    }
                    elseif($itemPedido["tipoProduto"] === "doce"){
                        $idDoce = $itemPedido["idProduto"];
                        $quantidade = $itemPedido["quantity"] * 10;
                        $valorTotal = $itemPedido["preco"] * $itemPedido["quantity"];
                        $pedidoDAO->insereDoce($idPedido, $idDoce, $quantidade, $valorTotal);
                    }
                }
                
                $_SESSION['mensagem'] = 'PEDIDO REALIZADO COM SUCESSO!<br><br>OBRIGADO POR PEDIR COM A MIRIAN CAKES!<br>Em Breve entraremos em contato para prosseguir com o seu pedido<br><br>Você pode verificar a situação dos seus pedidos clicando sobre "PEDIDOS"';
                exit;

            }else{
                $_SESSION['mensagem'] = "Erro ao tentar inserir pedido!";
                exit;
            }
            
        } else {
            // Lidar com o caso em que os itens do pedido não estão na sessão
            $_SESSION['mensagem'] = "Itens do pedido não encontrados!";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }
}

// Definição da classe
class ControllerPedido {
    // Outros métodos e propriedades da classe

    public function listarEnderecos($idUsuario) { 
        try {
            // Instancia a classe de acesso ao banco de dados
            $enderecoDAO = new EnderecoDAO();
            return $enderecoDAO->pesquisaEnderecoPorUsuario($idUsuario);
        }
        catch (Exception $excecao) {
            // Em caso de exceção, você pode logar o erro ou tratá-lo conforme necessário
            error_log($excecao->getMessage());
            return []; // Retorna um array vazio em caso de erro
        }
    }
}
?>
