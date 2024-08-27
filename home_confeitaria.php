<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Confeitaria</title>
    <link rel="stylesheet" href="css/home_confeitaria.css">
    <link rel="shortcut icon" href="imagens/logo_mirian.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">
    <script src="javascript/home_confeitaria.js" defer></script>

</head>

<?php

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

$nome_usuario = $_SESSION['nome'];
$primeiro_nome = explode(' ', trim($nome_usuario))[0];

require_once 'controllers/controllerLogin.php';
require_once 'controllers/controllerPedidosConfeitaria.php';
?>

<body>


    <!--Cabeçalho que inclui a logo da empresa e uma saudação saudação na parte superior esquerda. Também possui outra logo e o nome da empresa centralizada  -->
    <header>
        <div class="div_header_all">
            <div class="espaco">
                <img class="logo" src="imagens/logo_mirian.png" alt="Logo da Mirian Cakes">
                <h1>Olá,<?php echo htmlspecialchars($primeiro_nome);?>!</h1>
            </div>

            <div class="divlogo">
                <img class="logo_header" src="imagens/logo_mirian.png" alt="Logo Mirian" class="logo">
                <div class="divtexto">
                    <h1>Mirian Cakes Confeitaria Artesanal</h1>
                </div>
            </div>
        </div>


    </header>

    <!--Div que agrupa todos os componentes da página, com excessão o header-->
    <div class="div_organ">

        <!--Barra lateral que contém botões que levará o usuário para outras telas-->
        <aside class="sidebar">

            <nav>
                <div class="botao_cardapio">
                    <i class="material-symbols-outlined"> restaurant_menu </i>
                    <p>CARDÁPIO</p>
                </div>

                <div class="botao_pedidos">
                    <i class="material-symbols-outlined"> receipt_long </i>
                    <p>PEDIDOS</p>
                </div>

                <div class="botao_clientes">
                    <i class="material-symbols-outlined"> groups </i>
                    <p>CLIENTES</p>
                </div>

            </nav>

            <!--Footer da barra lateral, inclui uma div que funciona como um botão de "sair", retornando a tela "index"-->
            <footer>

                <div class="botao_sair">
                    <i class="material-symbols-outlined"> logout </i>
                    <p>SAIR</p>
                </div>

            </footer>

        </aside>




        <!--Div-container: guarda um fieldset, juntamente com uma table; A table guarda as informações de entregas próximas-->
        <div class="container">
            <fieldset class="caixa">
                <legend class="legenda">PRÓXIMAS ENTREGAS</legend>

                <table class="tabela_cliente">
                    <thead class = "titulos">
                        <th class="coluna_pedido">PEDIDO</th>
                        <th class="coluna_cliente">CLIENTE</th>
                        <th class="coluna_entrega">ENTREGA</th>
                    </thead>


                    <tbody>
                    <?php

                        $controller = new ControllerPedidosConfeitaria();
                        $pedidos = $controller->listaProxEntregas();


                        forEach($pedidos as $umPedido){
                            ?>
                            <tr class="linha_tabela">
                                <td class="idPedido">
                                    <?php echo htmlspecialchars($umPedido["pk_id_pedido"]);?>
                                </td>

                                <td class="nomeUsuario">
                                    <?php echo htmlspecialchars($umPedido["nome"]);?>
                                </td>

                                <td class="diaEntrega">
                                    <?php echo htmlspecialchars(date('d/m/Y', strtotime($umPedido["data_entrega"])));?>
                                </td>

                            </tr>

                            <?php
                        }
                    
                    ?>
                    </tbody>
                </table>
            </fieldset>

        </div>

    </div>
</body>

</html>