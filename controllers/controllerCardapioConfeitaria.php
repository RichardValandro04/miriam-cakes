<?php 

// Classe de acesso ao banco de dados
// __DIR__ -> O diretório físico do arquivo
require_once(__DIR__.'/../models/docesDAO.php');
require_once(__DIR__.'/../models/doces.php');
require_once(__DIR__.'/../models/recheioBoloDAO.php');


class ControllerCardapioConfeitaria {

    public function __construct() { }

    // Método para listar pedidos por situação e usuário
    public function listarDoces() {
        try {
            if(session_status() === PHP_SESSION_NONE){
                session_start();
            }
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
            if(session_status() === PHP_SESSION_NONE){
                session_start();
            }
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

    public function inserirRecheio (){
        try{
            if(session_status() === PHP_SESSION_NONE){
                session_start();
            }

            if(isset($_POST['salvarRecheio'])){
                $nome = filter_input(INPUT_POST, 'campo_recheio', FILTER_SANITIZE_STRING);

                $recheioBoloDAO = new RecheioBoloDAO();

                if($recheioBoloDAO->pesquisaUnica($nome)){
                    $_SESSION['mensagem'] = 'ERRO! O Recheio '. $nome . ' já existe!';
                    header('Location:' . $_SERVER['HTTP_REFERER']);
                    exit;

                }

                $insereRecheio = $recheioBoloDAO->insert($nome);

                if($insereRecheio){
                    $_SESSION['mensagem'] = "Recheio Inserido com Sucesso";
                    header('Refresh: 0; URL=' . $_SERVER['HTTP_REFERER']);
                    exit;
                } else{
                    $_SESSION['mensagem'] = "Erro! Tente Novamente";
                    header('Refresh: 0; URL=' . $_SERVER['HTTP_REFERER']);
                    exit; 
                }

            }

        }catch(Exception $excecao){
            throw $excecao;
        }
    }


    public function inserirDoce (){
        try{
            if(session_status() === PHP_SESSION_NONE){
                session_start();
            }
    
            if(isset($_POST['salvarDoce'])){
                $nome = filter_input(INPUT_POST, 'nome_doce', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $valor = filter_input(INPUT_POST, 'valor_doce', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $valor = str_replace(',', '.', $valor);
                $valor = (float) $valor;
                $foto = $_FILES['foto_doce'];
    
                $fotoNova = explode('.', $foto['name']);
                $extensao = strtolower(end($fotoNova));
    
                if($extensao != 'jpg'){
                    $_SESSION['mensagem'] = "ERRO! Tipo inválido de arquivo!";
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit;
                }else{
                    $docesDAO = new DocesDAO();
                    if($docesDAO->pesquisaUnica($nome)){
                        $_SESSION['mensagem'] = 'ERRO! O Doce '. $nome . ' já existe!';
                        header('Location: ' . $_SERVER['HTTP_REFERER']);
                        exit;
                    }
                    $caminhoSalvar = __DIR__ . '/../imagens/' . $foto['name'];
                    $caminhoRelativo = 'imagens/' . $foto['name'];

                    if(move_uploaded_file($foto['tmp_name'], $caminhoSalvar)){
                        $doces = new Doce($nome, $valor, $caminhoRelativo);
                        
                        $insereDoce = $docesDAO->insert($doces);
        
                        if($insereDoce){
                            $_SESSION['mensagem'] = "Doce Inserido com Sucesso";
                            header('Location: ' . $_SERVER['HTTP_REFERER']);
                            exit;
                        } else{
                            $_SESSION['mensagem'] = "Erro! Tente Novamente";
                            header('Location: ' . $_SERVER['HTTP_REFERER']);
                            exit; 
                        }
                    }else{
                        $_SESSION['mensagem'] = "ERRO! Falha ao mover foto.";
                    }
    
                }
            }
    
        }catch(Exception $excecao){
            throw $excecao;
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


