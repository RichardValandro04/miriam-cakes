// Capturando a div que possui o ícone de voltar, todas as telas estão com o mesmo nome de classe
const botao_voltar = document.querySelector(".icone_voltar");

// Adicionando um evento de click para atribuir uma função de back ao botão
botao_voltar.addEventListener("click", () => {window.location.href = "home_confeitaria.php";});






const botoesExcluir = document.querySelectorAll(".icone_excluir");

botoesExcluir.forEach(botao => {
    botao.onclick = function() {
        const idRegistro = this.dataset.id;
        const tipo = this.dataset.tipo;

        const conteudo = { id: idRegistro, tipo: tipo };
        console.log("ID:", idRegistro, "Tipo:", tipo);
    
        if (confirm("Tem certeza que deseja excluir o item?")) {
            $.ajax({
                url: 'controllers/cardapioExcluir.php',
                method: 'POST',
                data: JSON.stringify(conteudo),
                contentType: 'application/json',
                success: function(response) {
                    console.log("Sucesso:", response);
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
            window.location.href = "cardapio_confeitaria.php";
        }
    }
  });

  document.getElementById('valor_doce').addEventListener('input', function (e) {
    let valor = e.target.value.replace(/\D/g, ''); // Remove tudo que não for dígito
    valor = (valor / 100).toFixed(2) + ''; // Divide por 100 e fixa duas casas decimais
    valor = valor.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'); // Insere pontos de milhar
    e.target.value = 'R$ ' + valor;
});




const botaoDoce = document.querySelector(".adicionar_doce");
const modalDoce = document.querySelector(".dialogNovoDoce");

const botaoRecheio = document.querySelector(".adicionar_recheio");
const modalRecheio = document.querySelector(".dialogNovoRecheio");

const fecharDoce = document.querySelector(".fecharDoce");
const fecharRecheio = document.querySelector(".fecharRecheio");



botaoDoce.onclick = function(){
    modalDoce.showModal()
}

fecharDoce.onclick = function(){
    modalDoce.close()
}



botaoRecheio.onclick = function(){
    modalRecheio.showModal()
}

fecharRecheio.onclick = function(){
    modalRecheio.close()
}


$(document).ready(function(){
    $('.tabs').tabs();
});

