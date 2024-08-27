
// Capturando a div que possui o ícone de voltar, todas as telas estão com o mesmo nome de classe
const botao_voltar = document.querySelector(".icone_voltar");

// Adicionando um evento de click para atribuir uma função de back ao botão
botao_voltar.addEventListener("click", () => {window.location.href = "home_confeitaria.php";});


$(document).ready(function(){
    $('ul.tabs').tabs();
});

const btnOperacao = document.querySelectorAll(".btnoperacao");

btnOperacao.forEach( btn => {
    btn.addEventListener("click", () => {
        var idPedido = btn.getAttribute("value");
        var operacao = btn.getAttribute("operacao");

        var conteudo = {
            idPedido: idPedido,
            operacao: operacao
        };

        if(confirm("Tem Certeza que deseja " + operacao + " o Pedido?")){
            $.ajax({
                url: 'controllers/manipulaPedidosConfeitaria.php',
                method: 'POST',
                data: JSON.stringify(conteudo),
                contentType: 'application/json',
                success: function(response) {
                    console.log("Sucesso:", response);
                    console.log("dados enviados");
                    window.location.reload();
                    // Talvez mostrar um alert ou redirecionar
                },
                error: function(xhr, status, error) {
                    console.error("Erro:", error);
                    console.log("Detalhes do erro:", xhr.responseText);
                    // Isso vai ajudar a entender o que está errado
                }
            });

        }else{
            window.location.href = "pedidos_confeitaria.php";
        }
    })



})