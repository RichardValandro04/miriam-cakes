<?php
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }
    require_once 'controllers/controllerPedido.php';

    $idUsuario = $_SESSION['idUsuario'];



    $dados = $_SESSION['pedido'];
    $contDados = count($dados);
    $valorTotal = 0;

    forEach($dados as $linha){
        $valorTotal += $linha['preco'] *  $linha['quantity'];
    }

    $valorFormatado = number_format($valorTotal, 2, ',', '.');
    

    $csscustomiza = "novo_pedido.css";
    $js = "novo_pedido.js";

    require_once 'templates/header_3.php';


    
?>



    <!--ARTICLE CONTENDO 4 SECTIONS-->
    <article>
        <!--SECTION CONTENDO TABELA-->
        <section>
            <!--TABELA ESPECIFICANDO O PEDIDO-->
            <div>
                <table>
                    <thead class="headerTable">
                        <tr class="titulos">
                            <th>Quantidade</th>
                            <th>Item</th>
                            <th>Recheio</th>
                            <th>Valor</th>
                        </tr>
                    </thead>

                    <tbody  class="pedidosRealizados">

                        <?php
                            forEach($dados as $linha){
                                if($linha['tipoProduto'] == 'doce'){
                                    ?>
                                    <tr>
                                        <td class="coluna_esquerda"><?php echo htmlspecialchars($linha['unidades'] * $linha['quantity']); ?>x</td>
                                        <td><?php echo htmlspecialchars($linha['tipoProduto']); ?></td>
                                        <td><?php echo htmlspecialchars($linha['nome']); ?></td>
                                        <td class="coluna_direita">R$ <?php echo htmlspecialchars(number_format($linha['preco'] *  $linha['quantity'], 2, ',', '.')); ?></td>
                                    </tr>

                        <?php
                                }else{
                                    ?>
                                    <tr>
                                        <td class="coluna_esquerda"><?php echo htmlspecialchars($linha['unidades'] * $linha['quantity']); ?>x</td>
                                        <td><?php echo htmlspecialchars(ucwords($linha['tipoProduto'])." ".$linha['fatias']. " Fatias"); ?></td>
                                        <td><?php forEach($linha['recheios'] as $recheio) echo htmlspecialchars($recheio)."<br>"; ?></td>
                                        <td class="coluna_direita">R$ <?php echo htmlspecialchars(number_format($linha['preco'], 2, ',', '.')); ?></td>
                                    </tr>

                        <?php
                                }
                            }
                        ?>

                        <tr>
                            <td class="fundo_ultima_linha"> </td>
                            <td class="fundo_ultima_linha"> </td>
                            <td class="fundo_ultima_linha"> </td>
                            <td class="end" id="valor_total">Valor Total: R$ <?php echo htmlspecialchars($valorFormatado); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <!--SECTION CONTENDO INPUTS DE DATA E HORA - MODO DE RECEBIMENTO - OPÇÕES DE ENDEREÇO-->
        <section>
            <!--DIV CONTÉM DATA E HORA ENTREGA - MODO DE RECEBIMENTO - OPÇÕES DE ENDEREÇO-->
            <div class="modo_data_hora_selecao">
                <!--DATA E HORA DE ENTREGA-->
                <div>
                    <form class="data_hora_entrega" action="">
                        <div>
                            <div>
                                <label for="data_entrega">Data de Entrega</label>
                            </div>
                            <div class="icon_input_data_hora">
                                <img class="tam_calen_relo" id="fundo_calen_relog" src="imagens/icone_calendario.png"
                                    alt="">

                                    <?php
                                    // Obtém a data atual
                                    $dataAtual = new DateTime();

                                    // Adiciona 3 dias à data atual para a data mínima
                                    $dataMinima = (clone $dataAtual)->add(new DateInterval('P3D'));
                                    // Formata a data mínima para o formato Y-m-d
                                    $dataMinimaFormatada = $dataMinima->format('Y-m-d');

                                    // Cria uma nova instância para calcular a data máxima
                                    $dataMaxima = (clone $dataAtual)->add(new DateInterval('P1Y'));
                                    // Formata a data máxima para o formato Y-m-d
                                    $dataMaximaFormatada = $dataMaxima->format('Y-m-d');
                                    ?>



                                    <input type="date" name="" min = "<?php echo $dataMinimaFormatada; ?>" max = "<?php echo $dataMaximaFormatada; ?>" id="data_entrega" required>

                            </div>
                        </div>

                        <div>
                            <div>
                                <label for="hora_entrega">Hora da Entrega</label>
                            </div>
                            <div class="icon_input_data_hora">
                                <img class="tam_calen_relo" id="fundo_calen_relog" src="imagens/relogio.png" alt="">
                                <input type="time" name="" id="hora_entrega" required>
                            </div>
                        </div>
                    </form>
                </div>
                <!--DIV COM MODO DE RECEBIMENTO E OPÇÕES DE ENDEREÇO-->
                <div class = "selectEndereco">
                    <!--MODO DE DE RECEBIMENTO (ENTREGA OU RETIRADA)-->
                    <form class="entrega_retirada" action="">
                        <div class="entrega">
                            <input type="radio" name="receba" class="rd_entrega" value = "entrega">
                            <label id="label_entrega_retirada" for="entrega">Entrega</label>
                        </div>
                        <div class="retirada">
                            <input type="radio" name="receba" class="rd_retirada" value = "retirada">
                            <label id="label_entrega_retirada" for="retirada">Retirada</label>
                        </div>

                        <input type="hidden" class="valorTotalPedido" value = "<?php echo htmlspecialchars($valorTotal); ?>" >
                    </form>

                    <!--SE FOR ENTREGA - OPÇÕES DE ENDEREÇO-->
                    <form action="">
                        <div class="selecao_endereco">
                            <div>
                                <p>Selecione o endereço para entrega</p>
                            </div>
                            <div>
                                <label for="enderecos"></label>
                                <select name="enderecos" id="lista">
                                <?php
                                $controllerPedido = new ControllerPedido();

                                $enderecosUsuario = $controllerPedido->listarEnderecos($idUsuario);
                                $contEnderecos = count($enderecosUsuario);
                                if($contEnderecos >= 1){
                                    forEach($enderecosUsuario as $endereco){
                                        ?>
                                        <option class = "enderecoSelect" value = "<?php echo htmlspecialchars($endereco['pk_id_endereco']); ?>" ><?php echo htmlspecialchars(
                                             $endereco['rua'] . ", " 
                                            .$endereco['numero_casa'] ." - " 
                                            .$endereco['bairro'] . ", "
                                            .$endereco['cidade'] . " - "
                                            .$endereco['uf'] ); ?> </option>
                                    
                                    <?php        
                                    }
                                }

                                ?>
                                </select>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        
        <!--Confirmar Pedido-->

        <div class = "buttonConfirma">
            <button class = "botaoIr">Confirmar Pedido</button>
        </div>
        

    </article>

    <?php
    $cssfooter= "footer_2.css";
    include 'templates/footer_2.php';

    ?>
