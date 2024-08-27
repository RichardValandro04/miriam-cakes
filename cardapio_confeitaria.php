    <?php
    require_once 'controllers/cardapioExcluir.php';
    require_once 'controllers/controllerCardapioConfeitaria.php';
    
    $csscustomiza = "cardapio_confeitaria.css";
    $js = "cardapio_confeitaria.js";
    include 'templates/header_1.php';

    ?>

    <!--ARTICLE - 2 SECTIONS-->
    <article>

        <!-- Section meus-clientes inclui um ícone de pessoas e o texto clientes, identificando a página  -->

        <!-- SECTION CONTENDO CARDÁPIO E ADICIONAR ITENS-->
        <section>
            <div class="identificador_pagina">
                <img src="imagens/icone_cardapio.png" alt="clientes_icon">
                <p>CARDÁPIO</p>
            </div>
            <!-- ADD RECHEIO - ADD DOCE-->
            <div class="flexcoluns">
                <!-- DIV ADD RECHEIO E ADD DOCE-->
                <div class="add-recheio-doce">
                    <!--ADD RECHEIO-->
                    <div class="adicionar_recheio">
                        <img id="icon_add" src="imagens/icone_add.png" alt="">
                        <p class = "adicionar">ADICIONAR NOVO<span>RECHEIO</span></p>
                    </div>
                    <!--ADD DOCE-->
                    <div class="adicionar_doce">
                        <img id="icon_add" src="imagens/icone_add.png" alt="">
                        <p class = "adicionar">ADICIONAR NOVO<span>DOCE</span></p>
                    </div>
                </div>
            </div>
        </section>

        <section class = "tabelasRecheios">
            <div class="column tabela">
                <div class="col s6">
                    <ul class="tabs tabs-fixed-width">
                        <li class="tab col s3"><a href="#doces">DOCES</a></li>
                        <li class="tab col s3"><a href="#recheios">RECHEIOS</a></li>
                    </ul>
                </div>

                <div id="doces" class="col">
                    <?php
                    $controllerCardapioConfeitaria = new ControllerCardapioConfeitaria();
                    $doces = $controllerCardapioConfeitaria->listarDoces();
                    $numDoce = count($doces);

                    if($numDoce < 1){
                        ?>
                        <div class="doce">
                            <h3>NENHUM DOCE CADASTRADO</h3>
                        </div>
                    <?php
                    }else{
                        foreach ($doces as $linha) {
                        ?>
                            <div class="doce">
                                <div class = "divFoto"><img src="<?php echo htmlspecialchars($linha['link_foto']);?>" alt="" id = "foto"></div>
                                <div class = "divNome"><h3 class="nome_sabor"><?php echo htmlspecialchars($linha['nome_sabor']); ?></h3></div>
                                <div class = "divValor"><h3 class="valor_dezena">R$ <?php echo htmlspecialchars($linha['valor_dezena']);?></h3></div>
                                <div class = "divExcluir"><img src="imagens/icone_excluir.png" alt="excluir" class = "icone_excluir" data-id="<?php echo htmlspecialchars($linha['pk_id_doce']);?>" data-tipo="doce"></div>
                            
                                
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>

                <div id="recheios" class="col">
                <?php

                $recheios = $controllerCardapioConfeitaria->listarRecheios();
                $num = count($recheios);

                if($num < 1){
                    ?>
                    <div class="recheio">
                        <h3>NENHUM RECHEIO CADASTRADO</h3>
                    </div>
                    
                <?php   
                }else{
                    foreach ($recheios as $linha) {
                        ?>
                        <div class="recheio">
                            <h3 class="nome_recheio"><?php echo htmlspecialchars($linha['nome_recheio']); ?></h3>
                            <img src="imagens/icone_excluir.png" alt="excluir" class = "icone_excluir" data-id="<?php echo htmlspecialchars($linha['pk_id_recheio']);?>" data-tipo="recheio">
                        </div>
                <?php
                    }
                }
                ?>
                </div>
            </div>
        </section>
        
        <section></section>

        <!-- DIALOG DE RECHEIOS -->
        <dialog class = "dialogNovoRecheio">
            <!-- header que inclui h1 com identificação da tela -->
            <header class = "headerModal">
                <div><input type="hidden"></div>
                <div class = "nomePagina">
                    <p>ADICIONAR NOVO RECHEIO</p>
                </div>

                <div class = "btn_fechar">
                    <img class = "fecharRecheio botaoFechar" src="imagens/fechar.png" alt="fechar">
                </div>
            </header>

            <form class="container" action = "controllers/controllerCardapioConfeitaria.php" method = "POST">

                <!--div que inclui dois campos, um label e um input-->
                <div class="nome_recheio">
                    <label for="campo_recheio" class = "lbl_nome">NOME</label>
                    <input type="text" name="campo_recheio" id="campo_recheio" class="campos" maxlength = "25">
                </div>

                <footer class = "footerDialog">
                    <button type="submit" class="btn_salvar salvarRecheio" name = "salvarRecheio" value = "salvarRecheio">SALVAR</button>
                </footer>
            </form>
        </dialog>
        

        <!-- DIALOG DE DOCES -->
        <dialog class = "dialogNovoDoce">
            <!-- header que inclui h1 com identificação da tela -->
            <header class = "headerModal">
                <div><input type="hidden"></div>
                <div class = "nomePagina">
                    <p>ADICIONAR NOVO DOCE</p>
                </div>

                <div class = "btn_fechar">
                    <img class = "fecharDoce botaoFechar" src="imagens/fechar.png" alt="fechar">
                </div>
                    
            </header>
            <form class="container" action = "controllers/controllerCardapioConfeitaria.php" method = "POST" enctype="multipart/form-data">

                <div class="campo_nome">
                    <label for="nome_doce" class="label_campos">NOME</label>
                    <input type="text" name="nome_doce" id="nome_doce" class="campos">
                </div>

                <div class="campo_valor">
                    <label for="valor_doce" class="label_campos">VALOR DEZENA</label>
                    <input type="tel" name="valor_doce" id="valor_doce" class="campos" step="0.01" min="0" placeholder="R$ 0,00">
                <!-- ATENCAO, MUDAR TYPE PARA RECEBER VALOR EM REAL-->
                </div>

                <div class="campo_foto">
                    <label class="label_fotos">FOTO</label>
                    <input type="file" name="foto_doce" id="foto_doce" class="campos" accept=".jpg">
                </div>
                 
                <div class="salvar">
                    <!-- botao de enviar o formulario -->
                    <button type="submit" class="btn_salvar salvarDoce" name = "salvarDoce" value = "salvarDoce" >SALVAR</button>
                </div>
                

            </form>
        </dialog>



    </article>

    <?php
    $cssfooter= "footer_2.css";
    require_once 'templates/footer_2.php';
    require_once 'models/mensagem.php';
    ?>

