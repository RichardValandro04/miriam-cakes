<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <link rel="stylesheet" href="css/header_1.css">
    <!-- <link rel="stylesheet" href="echo $url"> -->

    <?php 
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        $nome_usuario = $_SESSION['nome'];
        $primeiro_nome = explode(' ', trim($nome_usuario))[0];
        $csscustomiza;
        $js;
        echo "<link rel='stylesheet' href='css/" . $csscustomiza .  "'>";

        echo "<script src= 'javascript/" . $js .  "'defer></script>"
    
    ?>

    <!-- <link rel="stylesheet" href="css/cardapio_confeitaria.css"> -->
    <link rel="shortcut icon" href="imagens/logo_mirian.png">

</head>
<body>
    <!-- Header inclui a logo da empresa e uma saudação à confeiteira que está logada -->
    <header>
        <div class="saudacao_logado">
            <img src="imagens/logo_mirian.png" alt="Logo MirianCakes" id="img_mirian">
            <h2 id="txt_ola_mirian">Olá,<?php echo htmlspecialchars($primeiro_nome);?>!</h2>
        </div>
    </header>
