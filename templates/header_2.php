<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">


    <?php 
        require_once 'models/mensagem.php';
        $csscustomiza;
        $js;
        echo "<link rel='stylesheet' href='css/" . $csscustomiza .  "'>";
        echo "<script src= 'javascript/" . $js .  "'defer></script>"
    
    ?>
    
    <link rel="shortcut icon" href="imagens/logo_mirian.png">
    <link rel="stylesheet" href="css/header_2.css">

    
</head>
<body>

     <!-- Header contendo a div com logo e nome do sistema e flor posicionada no canto superior direito -->
    <header>
        <div class="divlogo">
            <img src="imagens/logo_mirian.png" alt="Logo Mirian" class="logo">
            <h2>Mirian Cakes Confeitaria Artesanal</h2>
        </div>

        <div class="divflor">
            <img src="imagens/tulipas_header.png" alt="tulipas" class="tulipas">
        </div>

    </header>

