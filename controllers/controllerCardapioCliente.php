<?php 

// Classe de acesso ao banco de dados
// __DIR__ -> O diretório físico do arquivo
require_once(__DIR__.'/../models/docesDAO.php');
require_once(__DIR__.'/../models/doces.php');
require_once(__DIR__.'/../models/recheioBoloDAO.php');
require_once(__DIR__.'/../models/tamanhosBoloDAO.php');


class ControllerCardapioCliente {

    public function __construct() { }


    // Método para listar pedidos por situação e usuário
    public function listarDoces() {
        try {
            // Instancia a classe de acesso ao banco de dados
            $docesDAO = new DocesDAO();
            return $docesDAO->pesquisaDoces();
        }
        catch (Exception $excecao) {
            // Em caso de exceção, você pode logar o erro ou tratá-lo conforme necessário
            error_log($excecao->getMessage());
            return []; // Retorna um array vazio em caso de erro
        }
    }

    public function listarRecheios() {
        try {
            // Instancia a classe de acesso ao banco de dados
            $recheioBoloDAO = new RecheioBoloDAO();
            return $recheioBoloDAO->pesquisaRecheios();
        }
        catch (Exception $excecao) {
            // Em caso de exceção, você pode logar o erro ou tratá-lo conforme necessário
            error_log($excecao->getMessage());
            return []; // Retorna um array vazio em caso de erro
        }
    }

        // Método para listar pedidos por situação e usuário
        public function listarBolos() {
            try {
                // Instancia a classe de acesso ao banco de dados
                $tamanhosBoloDAO = new TamanhosBoloDAO();
                return $tamanhosBoloDAO->pesquisaTamanhos();
            }
            catch (Exception $excecao) {
                // Em caso de exceção, você pode logar o erro ou tratá-lo conforme necessário
                error_log($excecao->getMessage());
                return []; // Retorna um array vazio em caso de erro
            }
        }
}





if (isset($_POST['salvarDoce'])===true){
	//sanitiza a string de operação obtida por meio do post
	$operacao=htmlspecialchars($_POST['salvarDoce']);
	
	$controllerCardapioConfeitaria = new controllerCardapioConfeitaria();
			
	switch ($operacao) {		
		case 'salvarDoce':
			$controllerCardapioConfeitaria->inserirDoce();
			break;
	}
}

if (isset($_POST['salvarRecheio'])===true){
	//sanitiza a string de operação obtida por meio do post
	$operacao=htmlspecialchars($_POST['salvarRecheio']);
	
	$controllerCardapioConfeitaria = new controllerCardapioConfeitaria();
			
	switch ($operacao) {		
		case 'salvarRecheio':
			$controllerCardapioConfeitaria->inserirRecheio();
			break;
	}
}
?>


