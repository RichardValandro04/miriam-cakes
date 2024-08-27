<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mirian Cakes Confeitaria</title>
    <!-- USANDO VIA CDN -- Compiled and minified CSS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="shortcut icon" href="imagens/logo_mirian.png">
    <script src="javascript/index.js" defer></script>
</head>

<?php
//Mensagem
require_once 'models/mensagem.php';
?>

<body>

    <!--header que inclui duas divs, uma sendo a logo da empresa e a outra a imagem de uma tulipa (flor)-->
    <header>
        <div class="divlogo">
            <img src="imagens/logo_mirian.png" alt="Logo Mirian" class="logo">
        </div>

        <div class="divflor">
            <img src="imagens/tulipas_header.png" alt="tulipas" class="tulipas">

        </div>

    </header>

    <!--Section que inclui o campo de login, contendo os campos de email, senha e um botão "login" -->
    <section>
        <form class="login" action = "controllers/controllerLogin.php" method = "POST">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>

            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" required>

            <small class="esquecisenha">esqueci minha senha</small>

            <button type="submit" class="botaologin" name = "botao_login" value="login">LOGIN</button>
        </form>

        <!--uma linha que separa o campo de login do carrossel-->
        <div class="linha"></div>

        <!--um article que inclui um carrossel, juntamente com um link que leva ao instagram da empresa. Também inclui um botão "registre-se" que leva á tela de registro-->
        <article class="registro">
            <div class="abrir_instagram">
                <p>CLIQUE E CONHEÇA-NOS</p>
                <div class="carrossel">
                    <div class="fotocarrossel" id="img">
                        <img src="imagens/bolo_3.jpg" class = "imgCarrossel">
                        <img src="imagens/trufas.png" alt="" class = "imgCarrossel">
                        <img src="imagens/docinhos.jpg" alt="" class = "imgCarrossel">
                        <img src="imagens/bolo_2.png" alt="" class = "imgCarrossel">
                        <img src="imagens/bolo_1.png" alt="" class = "imgCarrossel">
                    </div>
                </div>
                <div>
                    <img src="imagens/logo_instagram.png" alt="" class="logo_instagram">
                </div>
            </div>
            <a href="cadastro.php"><button type="button" class="botaoregistro">REGISTRE-SE</button></a>

        </article>

    </section>

    <!--Footer que inclui uma imagem de uma tulipa (flor)-->
    <footer>
        <img src="imagens/tulipas_footer.png" alt="tulipas" class="tulipasbaixo">
    </footer>
</body>

</html>