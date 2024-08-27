
    <?php
    session_start();
    $email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : false;
    $csscustomiza = "nova_senha.css";
    $js = "nova_senha.js";

    require_once 'templates/header_2.php';
    require_once 'models/mensagem.php';
    
    ?>

    <!--nav "container" que inclui uma div "nova-senha", a div "confirmar-senha" e o botão de confirmação de alteração de senha-->
    <form class="container" action = "controllers/controllerNovaSenha.php" method = "POST">
        <!--div que inclui um label, um input e uma tag "p"-->
        <div class="nova_senha">
            <label for="novasenha">Nova Senha</label>
            <input type="password" id="novasenha" name="novasenha">
        </div>

        <!--div que inclui um label e um input-->
        <div class="confirmar_senha">
            <label for="confsenha">Confirmar Nova Senha</label>
            <input type="password" id="confsenha" name="confsenha">
        </div>
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <!--botao que realiza a alteração de senha-->
        <button type="submit" class="botao_alterar" name="botao_alterar" value="alterar">ALTERAR</button>
    </form>

    <?php
    $cssfooter= "footer_1.css";
    include 'templates/footer_1.php';
    ?>
