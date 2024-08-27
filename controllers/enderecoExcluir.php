<?php 
require_once(__DIR__.'/../models/enderecoDAO.php');

if(session_status() === PHP_SESSION_NONE){
    session_start();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Recebe o corpo da requisição (JSON)
    $json = file_get_contents('php://input');

    if (json_last_error() !== JSON_ERROR_NONE) {
        // Lidar com erro de JSON
        $_SESSION['mensagem'] = "Erro ao processar os dados!";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    // Decodifica o JSON em um array associativo
    $data = json_decode($json, true);

    if (isset($data['idEndereco'])) {
        $idEndereco = htmlspecialchars($data['idEndereco']);

        $enderecoDAO = new EnderecoDAO();
        $nomeColuna = "pk_id_endereco";
        if($enderecoDAO->delete($idEndereco, $nomeColuna)){
            $_SESSION['mensagem'] = "Endereço excluído com sucesso!";            
        }
        
    } else {
        $_SESSION['mensagem'] = "Dados inválidos!";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    
    }
}
?>


