//Capturando o botão de sair
const botao_sair = document.querySelector(".botao_sair");

// Adicionando evento de click para retornar ao index.html
botao_sair.addEventListener("click", () => {
    const confirmation = window.confirm("Você tem certeza que deseja sair?");
    if (confirmation) {
        window.location.href = "controllers/logout.php";
    }
});

// capturando itens de menu e adicionando evento de click
const botao_cardapio = document.querySelector(".botao_cardapio");
const botao_pedidos = document.querySelector(".botao_pedidos");
const botao_clientes = document.querySelector(".botao_clientes");

// evento de click para ir às respectivas janelas dos itens de menu
botao_clientes.addEventListener("click", () => {window.location.href = "clientes_confeitaria.php"} );
botao_pedidos.addEventListener("click", () => {window.location.href = "pedidos_confeitaria.php"});
botao_cardapio.addEventListener("click", () => {window.location.href = "cardapio_confeitaria.php"} );