<?php 
require_once(__DIR__.'/../models/enderecoDAO.php');
require_once(__DIR__.'/../models/endereco.php');


class ControllerDadosCliente{

    public function __construct() { }

    public function inserirEndereco(){
        try{
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            
            // Código para manipulação de requisição POST
            if ($_POST['salvarEndereco']) {
                $idUsuario = htmlspecialchars($_SESSION["idUsuario"]);
                $cep = htmlspecialchars($_POST["cep"]);
                $rua = htmlspecialchars($_POST["rua"]);
                $bairro = htmlspecialchars($_POST["bairro"]);
                $cidade = htmlspecialchars($_POST["cidade"]);
                $uf = htmlspecialchars($_POST["uf"]);
                $numeroCasa = htmlspecialchars($_POST["n"]);
                $complemento = htmlspecialchars($_POST["complemento"]);
            
                $endereco = new Endereco($idUsuario, $cep, $rua, $bairro, $cidade, $uf, $numeroCasa, $complemento);
                $enderecoDAO = new EnderecoDAO();
            
                if($enderecoDAO -> insert($endereco)){
                    $_SESSION['mensagem'] = "Endereco Inserido com Sucesso!";
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit;    
                }
            
                else {
                    $_SESSION['mensagem'] = "Erro ao inserir!";
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit;
                }
            

            }

        }catch(Exception $excecao){
            throw $excecao;
        } 
    
    }
}    


if (isset($_POST['salvarEndereco'])===true){
	//sanitiza a string de operação obtida por meio do post
	$operacao=htmlspecialchars($_POST['salvarEndereco']);
	
	$controllerDadosCliente = new ControllerDadosCliente();
			
	switch ($operacao) {		
		case 'salvarEndereco':
			$controllerDadosCliente->inserirEndereco();
			break;
	}
}

?>