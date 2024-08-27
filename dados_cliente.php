    <?php
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }
    $nome = $_SESSION['nome'];
    $email = $_SESSION['email'];
    $cpf = $_SESSION['cpf'];
    $telefone = $_SESSION['telefone'];
    $idUsuario = $_SESSION['idUsuario'];
 
    $csscustomiza = "dados_cliente.css";
    $js = "dados_cliente.js";
    
    include 'templates/header_3.php';
    require_once 'controllers/controllerLogin.php';
    require_once 'controllers/controllerClientes.php';
    require_once 'controllers/controllerDadosCliente.php';
    require_once 'models/mensagem.php';

    ?>

    

    <div class="identificador_pagina">
        <img src="imagens/icone_pessoa.png" alt="" id="icone_pessoa">
        <h1>MEUS DADOS</h1>
    </div>

    <!--SECTION-->
    <article>
        <dialog class="dialogEndereco">
            <!-- header que inclui h1 com identificação da tela -->
            <header class = "headerModal">
                <div><input type="hidden"></div>
                <div class = "nomePagina">
                    <p>ENDEREÇO</p>
                </div>
                <div class = "btn_fechar">
                    <img class = "fecharEndereco botaoFechar" src="imagens/fechar.png" alt="fechar">
                </div>
            </header>
            <div class="dialogAll">
                <form class = "form_endereco" action = "controllers/ControllerDadosCliente.php" method = "POST">               
                    <!-- DIV CEP - RUA - Nº -->
                    <div class="cep_rua_n">
                        <!--CEP -->
                        <div class="cep">
                            <label for="cep">Cep</label>
                            <input type="text" name="cep" class="campo_cep" id = "cep" maxlength = 8>
                        </div>
                        
                        <!--RUA-->
                        <div class="rua">
                            <label for="rua">Rua</label>
                            <input type="text" name="rua" class="campo_rua" id = "rua" readonly>
                        </div>
                        <div class="bairro">
                            <label for="bairro">Bairro</label>
                            <input type="text" name="bairro" class="campo_bairro" id = "bairro" readonly>
                        </div>

                        <div class="complemento">
                            <label for="complemento">Complemento</label>
                            <input type="text" name="complemento" class="campo_complemento" id = "complemento">
                        </div>

                        
                    </div>
                    <!--DIV BAIRRO - CIDADE - COMPLEMENTO -->
                    <div class="bairro_cidade_complemento">
                        <div class="uf">
                                <label for="uf">Estado</label>
                                <input type="text" name="uf" class="campo_uf" id = "uf" readonly>
                        </div>


                        <!--RUA-->
                        <div class="num">
                            <label for="n">N°</label>
                            <input type="text" name="n" class="campo_n" id = "num">
                        </div>
                        


                        <!--CIDADE-->
                        <div class="cidade">
                            <label for="cidade">Cidade</label>
                            <input type="text" name="cidade" class="campo_cidade" id = "cidade" readonly>
                        </div>                        


                    </div>

                    <div class="footerEndereco">
                        <button type="submit" class="btn_salvar" name = "salvarEndereco" value = "salvarEndereco">SALVAR</button>
                    </div>

                </form>
            </div>

        </dialog>


        <dialog class = "dialogEmail">
            <!-- header que inclui h1 com identificação da tela -->
            <header class = "headerModal">
                <div><input type="hidden"></div>
                <div class = "nomePagina">
                    <p>ALTERARAÇÃO DE EMAIL</p>
                </div>

                <div class = "btn_fechar">
                    <img class = "fecharEmail botaoFechar" src="imagens/fechar.png" alt="fechar">
                </div>
            </header>
            <div class="dialogTudo">
                

                <form class="container" id = "formEmail" action = "controllers/controllerClientes.php" method = "POST">

                    <!--div que inclui dois campos, um label e um input-->
                    <div class="nomeEmail">
                        <label for="campo_email" class = "lbl_nome">NOVO E-MAIL</label>
                        <input type="text" name="campo_email" id="campo_email" class="campos" required>

                    </div>

                    <footer class = "footerDialog">
                        <button type="submit" class="btn_salvar salvarEmail" name = "salvarEmail" value = "salvarEmail">SALVAR</button>
                    </footer>
                </form>
            </div>
        </dialog>

        <dialog class = "dialogTelefone">
            <!-- header que inclui h1 com identificação da tela -->
            <header class = "headerModal">
                <div><input type="hidden"></div>
                <div class = "nomePagina">
                    <p>ALTERAÇÃO DE TELEFONE</p>
                </div>

                <div class = "btn_fechar">
                    <img class = "fecharTelefone botaoFechar" src="imagens/fechar.png" alt="fechar">
                </div>
            </header>
            <div class="dialogTudo">
                

                <form class="container" id = "formTelefone" action = "controllers/controllerClientes.php" method = "POST">

                    <!--div que inclui dois campos, um label e um input-->
                    <div class="nomeTelefone">
                        <label for="campo_Telefone" class = "lbl_nome">NOVO TELEFONE</label>
                        <input type="text" name="campo_telefone" id="campo_telefone" class="campos" maxlength = "15">
                    </div>

                    <footer class = "footerDialog">
                        <button type="submit" class="btn_salvar salvarTelefone" name = "salvarTelefone" value = "salvarTelefone">SALVAR</button>
                    </footer>
                </form>
            </div>
        </dialog>

        <section class="dados">
            <!--NOME-->
            <div class="campo_nome">
                <label for="nome">Nome Completo</label>
                <input type="text" name="nome" value="<?php echo htmlspecialchars($nome); ?>" disabled>
            </div>

            <div>
                <!--EMAIL-->
                <div class="linha_email">
                    <div class="campo_email">
                        <label for="email">Email</label>
                        <input type="email" class="input_email" name="email" value="<?php echo htmlspecialchars($email); ?>" disabled>
                    </div>
                    
                    <div class="icone_editar">
                        <img src="imagens/icone_editar.png" alt="icone_editar" class="alt_email">
                    </div>
                </div>
            </div>
            
            <div>
                <div class="linha_telefone">
                    <div class="campo_cpf">
                        <label for="cpf">CPF</label>
                        <input type="text" class="input_cpf" name="CPF" value="<?php echo htmlspecialchars($cpf); ?>" disabled>
                    </div>

                    <div class="campo_telefone">
                        <label for="telefone">Telefone</label>
                        <input type="tel" class="input_telefone" name="telefone" id="telefone" value="<?php echo htmlspecialchars($telefone); ?>" disabled>
                    </div>
                
                    <div class="icone_editar">
                        <img src="imagens/icone_editar.png" alt="icone_editar" class="alt_telefone">
                    </div>    
                </div>
            </div>
            
        </section>


        <section class="enderecos">

            

            <div class="containerEndereco">
                <div class="headerEndereco">
                    <h3>ENDEREÇOS</h3>
                </div>

                <div class="bodyEndereco">
                <?php
                    $controllerClientes = new ControllerClientes();

                    $enderecos = $controllerClientes->listarEnderecos($idUsuario);
                    $contEnderecos = count($enderecos);

                    if($contEnderecos >= 1){
                        forEach($enderecos as $umEndereco){
                            ?>
                            <div class = "endereco">
                                <?php echo htmlspecialchars(
                                    $umEndereco['rua'] . ", " 
                                    .$umEndereco['numero_casa'] ." - " 
                                    .$umEndereco['bairro'] . ", "
                                    .$umEndereco['cidade'] . " - "
                                    .$umEndereco['uf'] ); ?>

                                    <div class="botao_excluir">
                                        <img src="imagens/icone_excluir.png" alt="" class="icone_excluir" data-id = "<?php echo htmlspecialchars($umEndereco['pk_id_endereco']);?>">
                                    </div>
                            </div>    
                        
                    <?php
                        }
                    }else{
                        ?>
                        <div> NENHUM ENDERECO CADASTRADO </div>


                        <?php
                        
                    }
                
                ?>   
                </div>
                

            </div>
            <button class="btn_endereco">+</button>

        </section>
        
    </article>



    <?php
    $cssfooter= "footer_2.css";
    include 'templates/footer_2.php';
    ?>
