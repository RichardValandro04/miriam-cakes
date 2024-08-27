    <?php
    $csscustomiza = "home_clientes.css";
    $js = "home_cliente.js";

    require_once 'templates/header_3.php';

    require_once 'models/mensagem.php';

    ?>

    <!-- Menu que leva o usuário as demais telas do sistema, cada div possui um item de menu -->
    <nav>
        <div class="meus_dados">
            <img src="imagens/icone_pessoa.png" alt="icone-pessoa" class="icone_menu">
            <h1>MEUS DADOS</h1>
        </div>

        <div class="cardapio">
            <img src="imagens/icone_cardapio.png" alt="icone-cardapio" class="icone_menu">
            <h1>CARDÁPIO</h1>
        </div>

        <div class="meus_pedidos">
            <img src="imagens/icone_pedidos.png" alt="icone-pedidos" class="icone_menu">
            <h1>PEDIDOS</h1>
        </div>
    </nav>

    <!-- Footer inclui o botão de sair e os botões que direcionam pras redes sociais -->
    <footer>

        <!-- Botão sair -->
        <div class="botao_sair">
            <img src="imagens/icone_sair.png" alt="icone_sair">
            <h1>SAIR</h1>
        </div>

        <!-- Botões Redes Sociais -->
        <div class="redes_sociais">
            <h1>Redes Sociais</h1>
            <div class="icones_redes_sociais">
                <img class="logo_instagram" src="imagens/logo_instagram.png" alt="instagram">
                <img class="logo_whatsapp" src="imagens/logo_whatsapp.png " alt="whatsapp">
            </div>

        </div>
    </footer>

</body>

</html>