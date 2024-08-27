<?php

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

$idUsuario = $_SESSION['idUsuario'];
$csscustomiza = "pedidos_cliente.css";
$js = "pedidos_cliente.js";
include 'templates/header_3.php';

include 'controllers/controllerPedidosCliente.php';
?>

<div class="identificador_pagina">
    <img src="imagens/icone_pedidos.png" alt="" id="icone_pessoa">
    <h1>MEUS PEDIDOS</h1>
</div>

<article>
    <section class="dados">
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
                </div>
                <div class="pedidos">
                    <?php
                        $controllerPedidosCliente = new ControllerPedidosCliente();
                        $aguardandoConfirmacao = $controllerPedidosCliente->listaPedidos('aguardando', $idUsuario);

                        $num = count($aguardandoConfirmacao);

                        if($num > 0) {
                            foreach ($aguardandoConfirmacao as $linha) {
                                ?>
                                    <div class="pedido">
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

            <!-- Em Andamento -->
            <div id="emAndamento" class="col s40 tbl">
                <div class = "titulos">
                    <h4>ID PEDIDO</h4>
                    <h4>DATA ENTREGA</h4>
                    <h4>VALOR TOTAL</h4>
                </div>
                <div class="pedidos">
                    <?php
                    $emAndamento = $controllerPedidosCliente->listaPedidos('em andamento', $idUsuario);

                    $num = count($emAndamento);

                    if($num > 0) {
                        foreach ($emAndamento as $linha) {
                            ?>
                                <div class="pedido">
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

            <!-- Concluídos -->
            <div id="concluidos" class="col s40 tbl">
                <div class = "titulos">
                    <h4>ID PEDIDO</h4>
                    <h4>DATA ENTREGA</h4>
                    <h4>VALOR TOTAL</h4>
                </div>
                <div class="pedidos">
                    <?php
                    $concluido = $controllerPedidosCliente->listaPedidos('concluido', $idUsuario);
                    

                    $num = count($concluido);

                    if($num > 0) {
                        foreach ($concluido as $linha) {
                            ?>
                                <div class="pedido">
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
                <div class="pedidos">
                    <?php
                    $cancelado = $controllerPedidosCliente->listaPedidos('cancelado', $idUsuario);
                    

                    $num = count($cancelado);

                    if($num > 0) {
                        foreach ($cancelado as $linha) {
                            ?>
                                <div class="pedido">
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

$cssfooter = "footer_2.css";
include 'templates/footer_2.php';
?>
