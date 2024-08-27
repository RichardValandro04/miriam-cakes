<?php 

//Classe de acesso ao banco de dados
//__DIR__ -> O diretório físico do arquivo, por exemplo: D:\marta\IFES\ProgramacaoWeb\usbwebserver_v8.6\usbwebserver\root\codigoprogwebphp\mvc\controller
require_once(__DIR__.'/../models/usuarioDAO.php');
require_once(__DIR__.'/../models/enderecoDAO.php');


class ControllerClientes {
	

	public function __construct() { }
	
		/*Lista os clientes e seus respectivos enderecos*/
		public function listarUsuarios() {
			try {
				//instancia classes de banco
				$usuarioDAO = new usuarioDAO();
				return $usuarioDAO->pesquisaUsuarios();
			}
			catch (Exception $excecao) {
				throw $excecao;
			}
		}

		public function alterarEmail(){
			try{

				if (session_status() === PHP_SESSION_NONE) {
					session_start();
				}
				
				if(isset($_POST['salvarEmail'])){
					$emailAntigo = htmlspecialchars($_SESSION['email']);
					$idUsuario = htmlspecialchars($_SESSION['idUsuario']);
	
					$email = htmlspecialchars($_POST['campo_email']);


					$usuarioDAO = new UsuarioDAO();
					$pesquisaUsuario = $usuarioDAO->pesquisaUsuarioEmail($email);
					
					if($pesquisaUsuario){
						$_SESSION['mensagem'] = "o Email ". $email . " já está em uso!";
						header('refresh: 0; URL=' . $_SERVER['HTTP_REFERER']);
						exit;   
					}
	
					if($usuarioDAO->alteraEmail($idUsuario, $email)){
						$_SESSION['mensagem'] = "Email Alterado com Sucesso! <br>Email Antigo: " . $emailAntigo . "<br>Email Novo: " . $email;
						$_SESSION['email'] = $email;
						header('refresh: 0; URL=' . $_SERVER['HTTP_REFERER']);
						exit;
					}
					   
	
				}
	
				
			}
			catch (Exception $excecao) {
				throw $excecao;
			}
		}

		public function alterarTelefone(){
			try{

				if (session_status() === PHP_SESSION_NONE) {
					session_start();
				}
				
				if(isset($_POST['salvarTelefone'])){
					$telefoneAntigo = htmlspecialchars($_SESSION['telefone']);
					$idUsuario = htmlspecialchars($_SESSION['idUsuario']);
	
					$telefone = htmlspecialchars($_POST['campo_telefone']);


					$usuarioDAO = new UsuarioDAO();
					$pesquisaUsuario = $usuarioDAO->pesquisaUsuarioTelefone($telefone);
					
					if($pesquisaUsuario){
						$_SESSION['mensagem'] = "o Telefone ". $telefone . " já está em uso!";
						header('Refresh: 0; URL=' . $_SERVER['HTTP_REFERER']);
						exit;   
					}
	
					if($usuarioDAO->alteraTelefone($idUsuario, $telefone)){
						$_SESSION['mensagem'] = "Telefone Alterado com Sucesso! <br>Telefone Antigo: " . $telefoneAntigo . "<br>Telefone Novo: " . $telefone;
						$_SESSION['telefone'] = $telefone;
						header('Refresh: 0; URL=' . $_SERVER['HTTP_REFERER']);
						exit;
					}
					   
	
				}
	
				
			}
			catch (Exception $excecao) {
				throw $excecao;
			}
		}
		
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


if (isset($_POST['salvarEmail']) === true){
	//sanitiza a string de operação obtida por meio do post
	$operacao = htmlspecialchars($_POST['salvarEmail']);
	
	$controllerClientes = new ControllerClientes();
			
	switch ($operacao) {		
		case 'salvarEmail':
			$controllerClientes->alterarEmail();
			break;
	}
}

if (isset($_POST['salvarTelefone']) === true){
	//sanitiza a string de operação obtida por meio do post
	$operacao = htmlspecialchars($_POST['salvarTelefone']);
	
	$controllerClientes = new ControllerClientes();
			
	switch ($operacao) {		
		case 'salvarTelefone':
			$controllerClientes->alterarTelefone();
			break;
	}
}

?>