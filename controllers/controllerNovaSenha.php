<?php
require_once(__DIR__.'/../models/UsuarioDAO.php');
require_once(__DIR__.'/../models/Usuario.php');



class controllerNovaSenha {
    public function __construct() { }

    public function alteraSenha() {
        try {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            if (isset($_POST['botao_alterar'])) {

                $novasenha = htmlspecialchars($_POST['novasenha']);
                $confsenha = htmlspecialchars($_POST['confsenha']);
                $tamanhoSenha = strlen($novasenha);
                $tamanhoConfSenha = strlen($confsenha);
                $email = htmlspecialchars($_POST['email']); 

                if($tamanhoSenha < 8 || $tamanhoConfSenha < 8){
                    $_SESSION['mensagem'] = "ERRO! A senha deve conter pelo menos 8 caracteres!";
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit;
                }

                if ($novasenha !== $confsenha) {
                    $_SESSION['mensagem'] = "ERRO! As Senhas não são iguais!";
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit;
                }
                
                $usuarioDAO = new UsuarioDAO();
                $pegaDados = $usuarioDAO->pesquisaUsuarioEmail($email);
                
                $nome = $pegaDados['nome'];
                $cpf = $pegaDados['cpf'];
                $telefone = $pegaDados['telefone'];
                $idUsuario = $pegaDados['pk_id_usuario'];
                $senhaAtual = $pegaDados['senha'];

                $novaSenhaSegura = md5($novasenha);

                if($senhaAtual === $novaSenhaSegura ){
                    $_SESSION['mensagem'] = "ERRO! Sua Nova senha não pode ser igual a atual!";
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit;  
                }


                
                $usuario = new Usuario($nome, $email, $cpf, $telefone, $novaSenhaSegura);

                $atualizaUsuario = $usuarioDAO->update($idUsuario, $usuario);
                            
                if ($atualizaUsuario) {
                    $_SESSION['mensagem'] = "Senha Alterada com Sucesso!";
                    header('Location: /cardapioonline/index.php'); 
                    exit;
                } else {
                    $_SESSION['mensagem'] = "ERRO! Tente Novamente mais tarde!";
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit;
                        
                }     
            }
        } catch (Exception $excecao) {
            // Log exception
            // throw $excecao;
            error_log($excecao->getMessage());
            $_SESSION['mensagem'] = "Ocorreu um erro interno. Tente novamente mais tarde.";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }
}

if (isset($_POST['botao_alterar']) === true) {
    $operacao = htmlspecialchars($_POST['botao_alterar']);
    $controllerNovaSenha = new controllerNovaSenha();
            
    switch ($operacao) {        
        case 'alterar':
            $controllerNovaSenha->alteraSenha();
            break;
    }
}
