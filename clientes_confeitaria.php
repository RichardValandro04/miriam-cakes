
    <?php
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        $nome_usuario = $_SESSION['nome'];
        $primeiro_nome = explode(' ', trim($nome_usuario))[0];
        require_once 'controllers/controllerLogin.php';

        $csscustomiza = "clientes_confeitaria.css";
        $js = "clientes_confeitaria.js";

        include 'templates/header_1.php';
        require_once 'controllers/controllerClientes.php';      

    ?>



    <article>

        <!-- Section meus-clientes inclui um ícone de pessoas e o texto clientes, identificando a página  -->
        <section class="identificador_pagina">
            <img src="imagens/icone_clientes.png" alt="clientes_icon">
            <p>CLIENTES</p>
        </section>

        <!-- Section clientes inclui a tabela de clientes -->
        <section class="clientes">
            <table class="tabela_clientes">
                <thead>
                    <tr>
                        <th class="coluna_nome">Nome Completo</th>
                        <th class="coluna_email">Email</th>
                        <th class="coluna_telefone">Telefone</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $controllerClientes = new controllerClientes();

                    $tabela = $controllerClientes->listarUsuarios();

                    foreach($tabela as $key => $linha){
                        ?>
                        <tr class = "linha_tabela">
                            <td class = "linha_nome"><?php echo $linha['nome'];?></td>
                            <td class = "linha_email"><?php echo $linha['email'];?></td>
                            <td class = "linha_telefone"><?php echo $linha['telefone'];?></td>
                        </tr>
                        <?php
                        } //endforeach
                        ?>
                </tbody>
            </table>
        </section>
    </article>

    <?php
    
    $cssfooter= "footer_2.css";
    include 'templates/footer_2.php';

    ?>