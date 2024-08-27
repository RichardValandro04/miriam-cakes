
    <?php

    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }
    require_once 'controllers/manipulaDetalhesPedido.php';
        
        $csscustomiza= "pedidos_confeitaria.css";
        $js = "pedidos_confeitaria.js";

        require_once 'templates/header_1.php';
        include 'controllers/controllerPedidosConfeitaria.php';
        


    ?>

    <!-- Article que agrupa todos os componentes da página, com exceção do header -->

        <!-- Section meus-clientes inclui um ícone de pessoas e o texto clientes, identificando a página  -->
        <section class="identificador_pagina">
            <img src="imagens/icone_pedidos.png" alt="clientes_icon">
            <p>PEDIDOS</p>
        </section>
    
        
    <article>

        <section class = "tblPedidos">
            <div class="column">
                <div class="col s40">
                    <ul class="tabs tabs-fixed-width">
                        <li class="tab col s10"><a href="#aguardandoConfirmacao">Aguardando Confirmação</a></li>
                        <li class="tab col s10"><a href="#emAndamento">Em Andamento</a></li>
                        <li class="tab col s10"><a href="#concluidos">Concluídos</a></li>
                        <li class="tab col s10"><a href="#cancelados">Cancelados</a></li>
                    </ul>
                </div>

                <!-- Aguardando Confirmação -->
                <div id="aguardandoConfirmacao" class="col s40 tbl">
                    <div class = "titulos">
                        <h4>ID PEDIDO</h4>
                        <h4>DATA ENTREGA</h4>
                        <h4>VALOR TOTAL</h4>
                        <div></div>
                    </div>
                    <div class="pedidos">
                        <?php
                            $situacao = 'aguardando';
                            $controllerPedidosConfeitaria = new ControllerPedidosConfeitaria();
                            $aguardandoConfirmacao = $controllerPedidosConfeitaria->listaPedidos($situacao);

                            $num = count($aguardandoConfirmacao);

                            if($num > 0) {
                                foreach ($aguardandoConfirmacao as $linha) {
                                    ?>
                                        <div class="pedido" value = <?php echo htmlspecialchars($linha['pk_id_pedido']); ?>>
                                            <h3 class="num_pedido"><?php echo htmlspecialchars($linha['pk_id_pedido']); ?></h3>
                                            <h3 class="date"><?php echo htmlspecialchars(date('d/m/Y', strtotime($linha['data_entrega']))); ?></h3>
                                            <h3 class="valor">R$ <?php echo htmlspecialchars(number_format($linha['valortotal_pedido'], 2, ',', '.'));?></h3>
                                            
                                            <div class = "botoes">
                                                <div class = "aceitar">
                                                    <img src="imagens/aceitar.png" alt="aceitar" class = "aceitar_icon botao btnoperacao" operacao = "aceitar" value = <?php echo htmlspecialchars($linha['pk_id_pedido']); ?>>
                                                </div>

                                                <div class = "recusar">
                                                    <img src="imagens/recusar.png" alt="recusar" class = "recusar_icon botao btnoperacao" operacao = "recusar" value = <?php echo htmlspecialchars($linha['pk_id_pedido']); ?>>
                                                </div>
                                                
                                            </div>
                                        </div>


                            <?php
                                }
                            } else{
                                ?>
                                <div class = "divNenhum">
                                    <h1>NENHUM PEDIDO ENCONTRADO</h1>
                                </div>
                                
                            <?php
                            }
                            ?>
                    </div>    
                </div>
                
                <!-- Em Andamento -->
                <div id="emAndamento" class="col s40 tbl">
                    <div class = "titulos">
                        <h4>ID PEDIDO</h4>
                        <h4>DATA ENTREGA</h4>
                        <h4>VALOR TOTAL</h4>
                        <div></div>
                    </div>
                    <div class="pedidos">
                        <?php
                            $situacao = 'em andamento';
                            $controllerPedidosConfeitaria = new ControllerPedidosConfeitaria();
                            $emAndamento = $controllerPedidosConfeitaria->listaPedidos($situacao);

                            $num = count($emAndamento);

                            if($num > 0) {
                                foreach ($emAndamento as $linha) {
                                    ?>
                                        <div class="pedido" value = <?php echo htmlspecialchars($linha['pk_id_pedido']); ?>>
                                            <h3 class="num_pedido"><?php echo htmlspecialchars($linha['pk_id_pedido']); ?></h3>
                                            <h3 class="date"><?php echo htmlspecialchars(date('d/m/Y', strtotime($linha['data_entrega']))); ?></h3>
                                            <h3 class="valor">R$ <?php echo htmlspecialchars(number_format($linha['valortotal_pedido'], 2, ',', '.'));?></h3>
                                        
                                            <div class = "botoes">
                                                <div class = "concluir">
                                                    <img src="imagens/concluir3.png" alt="concluir" class = "concluir_icon btnoperacao" operacao = "finalizar" value = <?php echo htmlspecialchars($linha['pk_id_pedido']); ?>>
                                                </div>

                                                
                                            </div>
                                        </div>
                            <?php
                                }
                            } else{
                                ?>
                                <div class = "divNenhum">
                                    <h1>NENHUM PEDIDO ENCONTRADO</h1>
                                </div>
                                
                            <?php
                            }
                            ?>
                    </div>    
                </div> 
                
                <!-- Concluidos -->
                <div id="concluidos" class="col s40 tbl">
                    <div class = "titulos">
                        <h4>ID PEDIDO</h4>
                        <h4>DATA ENTREGA</h4>
                        <h4>VALOR TOTAL</h4>
                    </div>
                    <div class="pedidos">
                        <?php
                            $situacao = 'concluido';
                            $controllerPedidosConfeitaria = new ControllerPedidosConfeitaria();
                            $concluido = $controllerPedidosConfeitaria->listaPedidos($situacao);

                            $num = count($concluido);

                            if($num > 0) {
                                foreach ($concluido as $linha) {
                                    ?>
                                        <div class="pedido" value = <?php echo htmlspecialchars($linha['pk_id_pedido']); ?>>
                                            <h3 class="num_pedido"><?php echo htmlspecialchars($linha['pk_id_pedido']); ?></h3>
                                            <h3 class="date"><?php echo htmlspecialchars(date('d/m/Y', strtotime($linha['data_entrega']))); ?></h3>
                                            <h3 class="valor">R$ <?php echo htmlspecialchars(number_format($linha['valortotal_pedido'], 2, ',', '.'));?></h3>
                                        </div>
                            <?php
                                }
                            } else{
                                ?>
                                <div class = "divNenhum">
                                    <h1>NENHUM PEDIDO ENCONTRADO</h1>
                                </div>
                                
                            <?php
                            }
                            ?>
                    </div>    
                </div>   
                
                <!-- Cancelados -->
                <div id="cancelados" class="col s40 tbl">
                    <div class = "titulos">
                        <h4>ID PEDIDO</h4>
                        <h4>DATA ENTREGA</h4>
                        <h4>VALOR TOTAL</h4>
                    </div>
                    <div class="pedidos" >
                        <?php
                            $situacao = 'cancelado';
                            $controllerPedidosConfeitaria = new ControllerPedidosConfeitaria();
                            $cancelado = $controllerPedidosConfeitaria->listaPedidos($situacao);

                            $num = count($cancelado);

                            if($num > 0) {
                                foreach ($cancelado as $linha) {
                                    ?>
                                        <div class="pedido" value = <?php echo htmlspecialchars($linha['pk_id_pedido']); ?>>
                                            <h3 class="num_pedido"><?php echo htmlspecialchars($linha['pk_id_pedido']); ?></h3>
                                            <h3 class="date"><?php echo htmlspecialchars(date('d/m/Y', strtotime($linha['data_entrega']))); ?></h3>
                                            <h3 class="valor">R$ <?php echo htmlspecialchars(number_format($linha['valortotal_pedido'], 2, ',', '.'));?></h3>
                                        </div>
                            <?php
                                }
                            } else{
                                ?>
                                <div class = "divNenhum">
                                    <h1>NENHUM PEDIDO ENCONTRADO</h1>
                                </div>
                                
                            <?php
                            }
                            ?>
                    </div>    
                </div> 
            </div>
        </section>                     
    </article>

    <?php

    $cssfooter= "footer_2.css";
    include 'templates/footer_2.php';

    ?>
