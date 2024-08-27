<?php

require_once(__DIR__.'/../models/recheioBoloDAO.php');


class ControllerNovoRecheio{
    public function __construct(){}

    public function inserirRecheio (){
        try{
            if(session_status() === PHP_SESSION_NONE){
                session_start();
            }

            if(isset($_POST['salvarRecheio'])){
                $nome = filter_input(INPUT_POST, 'campo_recheio', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $recheioBoloDAO = new RecheioBoloDAO();
                $insereRecheio = $recheioBoloDAO->insert($nome);

                if($insereRecheio){
                    $_SESSION['mensagem'] = "Recheio Inserido com Sucesso";
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit;
                } else{
                    $_SESSION['mensagem'] = "Erro! Tente Novamente";
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit; 
                }

            }

        }catch(Exception $excecao){
            throw $excecao;
        }
    }
}

if (isset($_POST['salvarRecheio'])===true){
	//sanitiza a string de operação obtida por meio do post
	$operacao=htmlspecialchars($_POST['salvarRecheio']);
	
	$controllerNovoRecheio = new controllerNovoRecheio();
			
	switch ($operacao) {		
		case 'salvaRecheio':
			$controllerNovoRecheio->inserirRecheio();
			break;
	}
}
?>