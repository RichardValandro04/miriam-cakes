// Capturando a div que possui o ícone de voltar, todas as telas estão com o mesmo nome de classe
const botao_voltar = document.querySelector(".icone_voltar");

// Adicionando um evento de click para atribuir uma função de back ao botão
botao_voltar.addEventListener("click", () => {window.location.href = "home_cliente.php";});



const botao_pedido = document.querySelector(".botao_pedido");

botao_pedido.addEventListener("click", () => {})


// Declara a variavel do carrinho
const carrinho = [];

// Função que atualiza o carrinho
function atualizarCarrinho() {
    const conteudoCarrinho = document.getElementById("conteudo_carrinho");
    conteudoCarrinho.innerHTML = ""; // Limpa o conteúdo atual do carrinho

    carrinho.forEach((product, index) => {
        const productDiv = document.createElement("div");

        let recheiosInfo = "";
        if (product.recheios) {
            recheiosInfo = `<p>Recheios: ${product.recheios.join(', ')}</p>`;
        }

        productDiv.innerHTML = `
        <div class="nome_preco">
            <p>${product.nome}</p>
            <p>${(product.preco * product.quantity).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })}</p>
            <input type="hidden" value = "${(product.preco * product.quantity).toFixed(2)}" class="valorItem">
        </div>
        <div class="quantidade_recheios">
            <p>Quantidade: ${product.quantity * product.unidades} un.</p>
            ${recheiosInfo}
        </div>
            <button class="aumentarQuantidade" data-index="${index}">+</button>
            <button class="diminuirQuantidade" data-index="${index}">-</button>
            <button class="removerCarrinho" data-index="${index}">Remover</button>
        `;

        productDiv.classList.add('item_carrinho'); // Adiciona uma classe pa div la

        conteudoCarrinho.appendChild(productDiv);
    });

    // Eventos de aumentar, diminuir quantidade e remover itens do carrinho
    document.querySelectorAll(".aumentarQuantidade").forEach(button => {
        button.addEventListener("click", (e) => {
            const index = e.target.getAttribute("data-index");
            carrinho[index].quantity++;
            atualizarCarrinho();
        });
    });

    document.querySelectorAll(".diminuirQuantidade").forEach(button => {
        button.addEventListener("click", (e) => {
            const index = e.target.getAttribute("data-index");
            if (carrinho[index].quantity > 1) {
                carrinho[index].quantity--;
                atualizarCarrinho();
            }
        });
    });

    document.querySelectorAll(".removerCarrinho").forEach(button => {
        button.addEventListener("click", (e) => {
            const index = e.target.getAttribute("data-index");
            carrinho.splice(index, 1);
            atualizarCarrinho();
        });
    });

    console.log(carrinho);
}

// Quando clicar no trem, adiciona itens no carrinho
document.querySelectorAll(".carrinho_buy").forEach(button => {
    button.addEventListener("click", () => {
        const productElement = button.closest("tr");

        if (productElement) {
            const nome = productElement.querySelector(".nome_doce") ? productElement.querySelector(".nome_doce").textContent : productElement.querySelector(".quantidade_fatias").textContent;
            const fatiasElement = productElement.querySelector(".quantidade_fatias");
            const fatias = fatiasElement ? fatiasElement.getAttribute("data-id") : "";
            const idProduto = fatiasElement ? fatiasElement.getAttribute("id-tamanho") : productElement.querySelector(".nome_doce").getAttribute("data-id");
            const preco = productElement.querySelector(".valor_doce") ? productElement.querySelector(".valor_doce").getAttribute("value") : productElement.querySelector(".valor_bolo").getAttribute("value");
            const unidadesPreco = productElement.querySelector(".quantidade_doce") ? productElement.querySelector(".quantidade_doce").textContent : "1 un.";
            const unidades = parseInt(unidadesPreco.replace("un.", "").trim());

            // Vai capturar recheio só se for bolo
            var recheiosSelecionados = [];
            var tipoProduto = "doce";
            const tipoArticle = productElement.closest("article").classList.contains("article_bolos");

            if (tipoArticle) {
                recheiosSelecionados = Array.from(document.querySelectorAll('input[name="recheio"]:checked')).map(checkbox => checkbox.value);
                idRecheiosEscolhidos = Array.from(document.querySelectorAll('input[name="recheio"]:checked')).map(checkbox => checkbox.getAttribute('data-id'));
                tipoProduto = "bolo";
            }

            const contRecheios = recheiosSelecionados.length;
            // Verifica se o usuario selecionou recheio
            if (fatias && tipoArticle) {
                if(contRecheios < 1){
                    alert("Por favor, selecione pelo menos um recheio para o bolo.");
                    return;
                }

            }

            // Verifica se o produto já ta no carrinho, pq se tiver, a quantidade aumenta em 1
            const verifProdutoExiste = carrinho.findIndex(product =>
                product.nome === nome &&
                product.fatias === fatias &&
                (tipoArticle ? igualarArray(product.recheios, recheiosSelecionados) : true)
            );

            if (verifProdutoExiste !== -1) {
                carrinho[verifProdutoExiste].quantity++;
            } else {
                carrinho.push({
                    nome,
                    fatias,
                    preco,
                    quantity: 1,
                    unidades,
                    recheios: tipoArticle && recheiosSelecionados.length > 0 ? recheiosSelecionados : null,
                    idRecheiosEscolhidos: tipoArticle && idRecheiosEscolhidos.length > 0 ? idRecheiosEscolhidos : null,
                    idProduto,
                    tipoProduto
                });
            }

            atualizarCarrinho();
            mostrarDialogo();
        }
    });
});

// Função para mostrar o pop-up "item adicionado ao carrinho"
function mostrarDialogo() {
    const popupAdicionar = document.getElementById("popup_adicionar");
    popupAdicionar.show();
    setTimeout(() => {
        popupAdicionar.close();
    }, 3000); // O diálogo será fechado após 3 segundos
}


// Ve se os arrays são iguais (isso é pra evitar que recheios diferentes não sejam separados)
function igualarArray(arr1, arr2) {
    if (arr1 === arr2) return true;
    if (arr1 == null || arr2 == null) return false;
    if (arr1.length !== arr2.length) return false;

    for (let i = 0; i < arr1.length; i++) {
        if (arr1[i] !== arr2[i]) return false;
    }

    return true;
}

// Botão de abrir e fechar carrinho
const abrirCarrinho = document.getElementById("div_carrinho");
const modalCarrinho = document.getElementById("dialog_carrinho");
const fecharCarrinho = document.getElementById("fechar");

abrirCarrinho.addEventListener("click", () => {
    modalCarrinho.showModal();
    atualizarCarrinho();
});

fecharCarrinho.addEventListener("click", () => {
    modalCarrinho.close();
});

// Limite de checkboxes que podem ser marcados
const limite = 3;

// Capturando todos os checkboxes
const checkboxes = document.querySelectorAll('input[type="checkbox"]');

// Adicionando evento de escuta para cada checkbox
checkboxes.forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        // Contando quantos checkboxes estão marcados
        const marcadas = document.querySelectorAll('input[type="checkbox"]:checked');
        // Se o número de checkboxes marcados for maior que o limite, desmarca o último checkbox marcado e emite alerta
        if (marcadas.length > limite) {
            this.checked = false;
            alert("Você pode escolher no máximo 3 recheios");
        }
    });
});


function atualizarValorTotal() {

    const valores = document.querySelectorAll(".valorItem");

    // Inicializa a variável para somar os valores
    let total = 0;

    // Percorre todos os elementos capturados
    valores.forEach(input => {
        // Converte o valor do input para número e adiciona ao total
        total += parseFloat(input.value) || 0;
    });

    const totalFormatado = total.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });

    // Captura a tag onde o valor total será exibido
    const valorTotalTag = document.getElementById("valorTotal");

    // Define o conteúdo da tag com o valor total
    valorTotalTag.textContent = totalFormatado;
}

// Atualiza o valor total a cada 1 segundo (1000 milissegundos)
setInterval(atualizarValorTotal, 1000);

document.querySelector(".botao_pedido").addEventListener("click", () => {
    const pedido = carrinho;

    // Verifica se o array não está vazio
    if (pedido.length === 0) {
        alert("O carrinho está vazio! Por favor, adicione itens antes de fazer o pedido.");
        return; // Sai da função se o array estiver vazio
    }

    $.ajax({
        url: 'controllers/controllerPedido.php',
        method: 'POST',
        data: JSON.stringify({itensPedido: pedido}),
        contentType: 'application/json',
        success: function(response) {
            console.log("Sucesso:", response);
            window.location.href = "novo_pedido.php";
        },
        error: function(xhr, status, error) {
            console.error("Erro:", error);
            console.log("Detalhes do erro:", xhr.responseText);
            // Isso vai ajudar a entender o que está errado
        }
    });

});
