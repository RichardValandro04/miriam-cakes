<?php

require_once(__DIR__.'/../models/usuarioDAO.php');
require_once(__DIR__.'/../models/enderecoDAO.php');


class ControllerCadastro{
    
    public function __construct() { }

    public function incluirUsuario(){
        try{

            if(session_status() === PHP_SESSION_NONE){
                session_start();
            }

            if(isset($_POST['botao_registro'])){
                

                //Sanitização dos campos de cadastro do usuário
                $nome = htmlspecialchars($_POST['nome_completo']);
                $email = htmlspecialchars($_POST['email']);
                $cpf = htmlspecialchars($_POST['cpf']);
                $telefone = htmlspecialchars($_POST['telefone']);
                $senha = htmlspecialchars($_POST['senha']);
                $conf_senha = htmlspecialchars($_POST['conf_senha']);

                $cep = htmlspecialchars($_POST['cep']);
                $rua = htmlspecialchars($_POST['rua']);
                $bairro = htmlspecialchars($_POST['bairro']);
                $cidade = htmlspecialchars($_POST['cidade']);
                $uf = htmlspecialchars($_POST['uf']);
                $num = htmlspecialchars($_POST['numero']);
                $complemento = htmlspecialchars($_POST['complemento']);

                // Instancia das classes DAOs para endereco e usuario
                $usuarioDAO = new UsuarioDAO();
                $enderecoDAO = new EnderecoDAO();

                $mensagensErro = [];

                //Verifica se cadastro já existe antes de inserir o usuário
                $pesquisaEmail = $usuarioDAO->pesquisaUsuarioEmail($email);
                $pesquisaCpf = $usuarioDAO->pesquisaUsuarioCpf($cpf);
                $pesquisaTelefone = $usuarioDAO->pesquisaUsuarioTelefone($telefone);
                
                if($pesquisaEmail || $pesquisaCpf || $pesquisaTelefone){
                    if($pesquisaEmail){
                        $mensagensErro[] = "Email";
                    }
                    if($pesquisaTelefone){
                        $mensagensErro[] = "Telefone";
                    }
                    if($pesquisaCpf){
                        $mensagensErro[] = "Cpf";
                    }
                    $contaErros = count($mensagensErro);

                    $msgDados = " Já Existe!";
                    
                    if($contaErros > 1){
                        $msgDados = " Já Existem!";
                    }

                    $mensagemFinal = implode(', ', $mensagensErro) . $msgDados;
                    // Armazena mensagens e dados do formulário na sessão
                    $_SESSION['form_data'] = $_POST;
                    $_SESSION['form_data']['mensagem'] = $mensagemFinal;
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit;
                }else{
                    //Construtor do usuario, com a senha ja criptografada
                    $usuario = new Usuario($nome, $email, $cpf, $telefone, md5($senha));
        
                    // Inserir usuário
                    $usuario_id = $usuarioDAO->insert($usuario);

                    if ($usuario_id) {
                        // Se o usuário foi inserido com sucesso, agora inserimos o endereço
                        $endereco = new Endereco($usuario_id, $cep, $rua, $bairro, $cidade, $uf, $num, $complemento);
        
                        //Caso dê tudo certo, apresenta mensagem de sucesso
                        if ($enderecoDAO->insert($endereco)) {
                            //Redireciona usuário para index
                            header('Location: '.  dirname($_SERVER['HTTP_REFERER']) . '/index.php');
                        }
                    }

                }       
            } 
        } 
        catch (Exception $excecao) {
			throw $excecao;
		}
    }
}

if (isset($_POST['botao_registro'])===true){

	//sanitiza a string de operação obtida por meio do post
	$operacao=htmlspecialchars($_POST['botao_registro']);
	
	
	$controllerCadastro = new controllerCadastro();
			
	switch ($operacao) {		
		case 'incluir':
			$controllerCadastro->incluirUsuario();
			break;
	}
}
?>