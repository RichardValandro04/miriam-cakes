
<?php
$csscustomiza = "recuperar_senha.css";
$js = "recuperar_senha.js";

require_once 'templates/header_2.php';

require_once 'models/mensagem.php';
?>



    <!--nav que inclui uma tag "p", uma div "email" e um botão "enviar"-->
    <form class="container" action = "controllers/controllerRecuperarSenha.php" method = "POST">
        <p class="texto_central">Confirme o email e cpf cadastrado para que <span>possamos liberar a alteração de senha</p>

            
            <!--div que inclui quatro campos, label "email e cpf" e inputs-->
            <div class="campos">
                <label for="email">E-Mail</label>
                <input type="email" id="email" name="email">

                <label for="cpf">CPF</label>
                <input type="text" id="cpf" name="cpf" maxlength = 11>
            </div>

        <!--botão de confirmação de email para envio do link de alteração de senha-->
        <button type="submit" class="botao_enviar" name = "botao_enviar" value = "enviar">ENVIAR</button>
    </form>

<?php
$cssfooter= "footer_1.css";
require_once 'templates/footer_1.php';
?>
