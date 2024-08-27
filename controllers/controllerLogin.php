<?php

require_once(__DIR__.'/../models/usuarioDAO.php');

class ControllerLogin{

    public function __construct() { }

    public function pesquisarUsuario(){
        try{
            if(session_status() === PHP_SESSION_NONE){
                session_start();
            }

            if(isset($_POST['botao_login'])){
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL); 
                $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $usuarioDAO = new UsuarioDAO();
                $pesquisaUsuario = $usuarioDAO->pesquisaUsuarioEmail($email);

                $_SESSION['idUsuario'] = null;
                $_SESSION['nome'] = null;
                $_SESSION['email'] = null;
                $_SESSION['cpf'] = null;
                $_SESSION['telefone'] = null;

                if($pesquisaUsuario){
                    if(md5($senha) === $pesquisaUsuario['senha']){
                        $_SESSION['idUsuario'] = $pesquisaUsuario['pk_id_usuario'];
                        $_SESSION['nome'] = $pesquisaUsuario['nome'];
                        $_SESSION['email'] = $pesquisaUsuario['email'];
                        $_SESSION['cpf'] = $pesquisaUsuario['cpf'];
                        $_SESSION['telefone'] = $pesquisaUsuario['telefone'];

                        if($pesquisaUsuario['tipo_usuario'] === 'confeiteira' ){
                            header('Location: /cardapioonline/home_confeitaria.php');
                            exit;
                        }
                        else{
                            header('Location: /cardapioonline/home_cliente.php');
                            exit;
                        }
                    }
                    else{
                        // Exibir Mensagens de Senha Incorreta
                        $_SESSION['mensagem'] = "Senha Incorreta!";
                        header('Location: ' . $_SERVER['HTTP_REFERER']);
                        exit;
                    }
                }
                else{
                    // Exibir Mensagens de Usuário Não Encontrado
                    $_SESSION['mensagem'] = "Usuário não encontrado!";
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit;
                }

                
            }
        }catch(Exception $excecao){
            throw $excecao;
        }

    }
}

if (isset($_POST['botao_login'])===true){
	//sanitiza a string de operação obtida por meio do post
	$operacao=htmlspecialchars($_POST['botao_login']);
	
	$controllerLogin = new controllerLogin();
			
	switch ($operacao) {		
		case 'login':
			$controllerLogin->pesquisarUsuario();
			break;
	}
}

?>