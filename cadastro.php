
    <?php
    
    session_start();

    // Verifica se há dados do formulário na sessão
    $form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
    $mensagem = $_SESSION['form_data']['mensagem'];
    
    $_SESSION['mensagem'] = $mensagem;

    // Limpa os dados do formulário da sessão após recuperá-los
    unset($_SESSION['form_data']);
    
    $csscustomiza = "cadastro.css";
    $js = "cadastro.js";
    include 'templates/header_2.php';
    
    include_once 'controllers/controllerCadastro.php';

    ?>

    <!-- Article contém uma section de dados do usuario, essa section contém o formulário de dados -->
    <article>
        <section class="section_dados_usuario">
            <!-- O formulario de dados é dividido em 2 div's, uma de dados pessoais e outra de endereço -->
            <form class="formulario_dados" action = "controllers/controllerCadastro.php" method = "POST">

                <!-- div dados pessoais, agrupa todos os campos de dados pessoais -->
                <div class = "form">
                    <div class="dados_pessoais">
                        <legend>DADOS PESSOAIS</legend>
                        <div class="campo_nome">
                            <label for="nome_completo"> Nome Completo</label>
                            <input type="text" name="nome_completo" id="nome_completo" value = "<?php echo isset($form_data['nome_completo']) ? htmlspecialchars($form_data['nome_completo']) : ''; ?>">
                        </div>

                        <div class="campo_email">
                            <label for="email"> Email </label>
                            <input type="email" name="email" id="email" value = "<?php echo isset($form_data['email']) ? htmlspecialchars($form_data['email']) : ''; ?>">
                        </div>

                        <div class="campo_cpf">
                            <label for="cpf"> CPF </label>
                            <input type="text" name="cpf" id="cpf" value = "<?php echo isset($form_data['cpf']) ? htmlspecialchars($form_data['cpf']) : ''; ?>">
                        </div>

                        <div class="campo_telefone">
                            <label for="telefone"> Telefone</label>
                            <input type="tel" name="telefone" id="telefone" value = "<?php echo isset($form_data['telefone']) ? htmlspecialchars($form_data['telefone']) : ''; ?>">
                        </div>

                        <div class="linha_senha">
                            <div class="campo_senha">
                                <label for="senha"> Senha</label>
                                <input type="password" name="senha" id="senha">
                            </div>

                            <div class="campo_conf_senha">
                                <label for="conf_senha"> Confirmar Senha</label>
                                <input type="password" name="conf_senha" id="conf_senha">
                            </div>
                        </div>
                    </div>

                    <!-- div endereço, agrupa todos os campos de endereço -->
                    <div class="endereco">
                        <legend>ENDEREÇO</legend>
                        <div class="campo_cep">
                            <label for="cep"> CEP</label>
                            <input type="text" name="cep" id="cep" maxlength = 8 value = "<?php echo isset($form_data['cep']) ? htmlspecialchars($form_data['cep']) : ''; ?>">
                        </div>

                        <div class="linha_rua_num">
                            <div class="campo_rua">
                                <label for="rua"> Rua </label>
                                <input type="text" name="rua" id="rua" value = "<?php echo isset($form_data['rua']) ? htmlspecialchars($form_data['rua']) : ''; ?>"readonly>
                            </div>

                            <div class="campo_num">
                                <label for="numero"> N° </label>
                                <input type="text" name="numero" id="numero" maxlength = 4 value = "<?php echo isset($form_data['numero']) ? htmlspecialchars($form_data['numero']) : ''; ?>">
                            </div>

                        </div>

                        <div class="campo_bairro">
                            <label for="bairro"> Bairro </label>
                            <input type="text" name="bairro" id="bairro" value = "<?php echo isset($form_data['bairro']) ? htmlspecialchars($form_data['bairro']) : ''; ?>"readonly>
                        </div>

                        <div class="linha_cidade_uf">

                            <div class="campo_cidade">
                                <label for="cidade"> Cidade </label>
                                <input type="text" name="cidade" id="cidade" value = "<?php echo isset($form_data['cidade']) ? htmlspecialchars($form_data['cidade']) : ''; ?>" readonly>
                            </div>

                            <div class="campo_uf">
                                <label for="uf"> UF </label>
                                <input type="text" name="uf" id="uf"  value = "<?php echo isset($form_data['uf']) ? htmlspecialchars($form_data['uf']) : ''; ?>"readonly>
                            </div>

                        </div>

                        <div class="campo_complemento">
                            <label for="complemento"> Complemento </label>
                            <input type="text" name="complemento" id="complemento" maxlength = 50 value = "<?php echo isset($form_data['complemento']) ? htmlspecialchars($form_data['complemento']) : ''; ?>">
                        </div>
                    </div>

                </div>

                <!-- Botao do tipo submit para envio do formulario ao banco de dados -->
                <div class="botao">
                    <button type="submit" class="botao_registro" name = "botao_registro" value="incluir">REGISTRAR-SE</button>
                </div>
            </form>
        </section>
    </article>


    <?php
    require_once 'models/mensagem.php';
    $cssfooter= "footer_1.css";
    include 'templates/footer_1.php';
    ?>
    