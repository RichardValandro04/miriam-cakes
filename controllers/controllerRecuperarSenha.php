<?php

require_once(__DIR__.'/../models/UsuarioDAO.php');


class controllerRecuperarSenha{
    public function __construct() { }

    public function verificaUsuario(){
        try{

            if(session_status() === PHP_SESSION_NONE){
                session_start();
            }

            if(isset($_POST['botao_enviar'])){
                $email = htmlspecialchars($_POST['email']);
                $cpf = htmlspecialchars($_POST['cpf']);

                $usuarioDAO = new UsuarioDAO();

                $pesquisaUsuario = $usuarioDAO->pesquisaUsuarioEmail($email);
                
                if($pesquisaUsuario){
                    if($pesquisaUsuario['cpf'] === $cpf){
                        $_SESSION['mensagem'] = "Acesso Liberado!";
                        header('Location: /cardapioonline/nova_senha.php?email=' . urlencode($email));
                        exit;
    
                    }else{
                        $_SESSION['mensagem'] = "CPF não coincide com o cadastrado!";
                        header('Location: ' . $_SERVER['HTTP_REFERER']);
                        exit;
                    }
                }else{
                    $_SESSION['mensagem'] = "Usuário não encontrado!";
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit;
                }    

            }

            
        }
        catch (Exception $excecao) {
			throw $excecao;
		}
    }
}


if (isset($_POST['botao_enviar'])===true){
	//sanitiza a string de operação obtida por meio do post
	$operacao=htmlspecialchars($_POST['botao_enviar']);
	
	$controllerRecuperarSenha = new controllerRecuperarSenha();
			
	switch ($operacao) {		
		case 'enviar':
			$controllerRecuperarSenha->verificaUsuario();
			break;
	}
}
    
    
