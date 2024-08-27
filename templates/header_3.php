<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    
    <link rel="stylesheet" href="css/header_3.css">
    <link rel="shortcut icon" href="imagens/logo_mirian.png">

    


    <?php 
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        $nome_usuario = $_SESSION['nome'];

        $primeiro_nome = explode(' ', trim($nome_usuario))[0];
        require_once 'controllers/controllerLogin.php';
        $csscustomiza;
        $js;

        echo "<link rel='stylesheet' href='css/" . $csscustomiza .  "'>";
        echo "<script src= 'javascript/" . $js .  "'defer></script>"

        
    
    ?>
    
</head>
<body>
    <!--HEADER-->
    <header>
        <!-- Nome e Logo do sistema -->
        <div class="divlogo">
            <img src="imagens/logo_mirian.png" alt="Logo Mirian" class="logo">
            <p>Mirian Cakes <span>Confeitaria Artesanal</span></p>

        </div>

        <!-- Saudação ao usuário logado -->
        <div class="saudacao_usuario">
            <img src="imagens/icone_perfil.png" alt="Conta" class="icone_perfil">
            <p>Olá,  <?php echo htmlspecialchars($primeiro_nome); ?>!</p>

        </div>
    </header>
</body>
</html>