<?php 
require_once(__DIR__.'/../models/docesDAO.php');
require_once(__DIR__.'/../models/recheioBoloDAO.php');
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
    if (isset($data['id']) && isset($data['tipo'])) {
        $id = filter_var($data['id'], FILTER_SANITIZE_NUMBER_INT);
        $tipo = filter_var($data['tipo'], FILTER_SANITIZE_STRING);
    } else {
        $_SESSION['mensagem'] = "Dados inválidos!";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }



    if ($tipo === 'doce') {
        $docesDAO = new DocesDAO();
        $coluna = "pk_id_doce";
        $deletarDoce = $docesDAO-> delete($id, $coluna);
        if($deletarDoce){
            $_SESSION['mensagem'] = "Doce Deletado com Sucesso";
            exit;
        }
        else{
            $_SESSION['mensagem'] = "Erro! Tente Novamente";
            exit;                
        }
    } else if ($tipo === 'recheio') {
        $recheioBoloDAO = new RecheioBoloDAO();
        $coluna = "pk_id_recheio";
        $deletarRecheio = $recheioBoloDAO-> delete($id, $coluna);
        if($deletarRecheio){
            $_SESSION['mensagem'] = "Recheio Deletado com Sucesso";
            exit;
            }
        else{
            $_SESSION['mensagem'] = "Erro! Tente Novamente";
            exit;                
        }
    }
}
?>


