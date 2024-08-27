// Capturando a div que possui o ícone de voltar, todas as telas estão com o mesmo nome de classe
const botao_voltar = document.querySelector(".icone_voltar");

// Adicionando um evento de click para atribuir uma função de back ao botão
botao_voltar.addEventListener("click", () => {window.location.href = "cardapio_cliente.php";});


const select = document.querySelector("#lista");
const enderecoForm = document.querySelector(".form_endereco");

// Captura os botões de rádio
var btn_entrega = document.querySelector(".rd_entrega");
var btn_retirada = document.querySelector(".rd_retirada");

// Captura a dropdown list e define seu display como none
var divLista = document.querySelector(".selecao_endereco");
divLista.classList.add("hide-dropdown");


// Adiciona um evento de escuta aos botões de rádio
btn_entrega.addEventListener("change", () => {
    if (btn_entrega.checked) {
        // Se o botão de rádio de entrega estiver selecionado, exibe a dropdown
        divLista.classList.remove("hide-dropdown");
        divLista.classList.add("show-dropdown");
    }
});

// Adiciona um evento de escuta ao botão de rádio de retirada se necessário
btn_retirada.addEventListener("change", () => {
    if (btn_retirada.checked) {
        // Esconde a dropdown quando a opção de retirada é selecionada
        divLista.classList.remove("show-dropdown");
        divLista.classList.add("hide-dropdown");
    }
});


const botaoIr = document.querySelector(".botaoIr");
const inputDate = document.querySelector("#data_entrega");
const inputTime = document.querySelector("#hora_entrega")

botaoIr.addEventListener("click", () => {

    // Obtém os valores dos inputs
    const dateValue = inputDate.value;
    const timeValue = inputTime.value;
    var metodoValue;
    var idEndereco = null;
    var valorTotal = document.querySelector(".valorTotalPedido").getAttribute("value");
    
    
    // Verifica se os inputs têm valores selecionados
    if (!dateValue || !timeValue) {
        alert("Por favor, selecione a data e a hora.");
        return;
    }
    
    else if(!btn_retirada.checked && !btn_entrega.checked){
        alert("Selecione Entrega ou Retirada");
        return;
    }

    if(btn_retirada.checked){
        metodoValue = "retirada";
    }else if(btn_entrega.checked){
        metodoValue = "entrega";

     
        if (select && select.value) {
            idEndereco = select.value;
        }

        if (!idEndereco) {
            alert("Por favor, selecione um endereço.");
            return;
        }
        console.log(idEndereco);
    }

    const dadosComplementares = {
        dataEntrega: dateValue,
        horaEntrega: timeValue,
        metodo: metodoValue,
        idEndereco: idEndereco,
        valorTotal: valorTotal
    };

    $.ajax({
        url: 'controllers/controllerPedido.php',
        method: 'POST',
        data: JSON.stringify({ dadosComplementares: dadosComplementares }),
        contentType: 'application/json',
        success: function(response) {
            console.log("Sucesso:", response);
            window.location.href = "home_cliente.php";
        },
        error: function(xhr, status, error) {
            console.error("Erro:", error);
            console.log("Detalhes do erro:", xhr.responseText);
            // Isso vai ajudar a entender o que está errado
        }
    });




});



