// Capturando a div que possui o ícone de voltar, todas as telas estão com o mesmo nome de classe
const botao_voltar = document.querySelector(".icone_voltar");

// Adicionando um evento de click para atribuir uma função de back ao botão
botao_voltar.addEventListener("click", () => {window.location.href = "recuperar_senha.php";});

//capturando botao de alterar senha
const botao_alterar = document.querySelector(".botao_alterar");


//adicionando evento de click para exibir um alert de senha alterada
// obs.: a lógica para validação de senha ainda deverá ser aplicada
botao_alterar.addEventListener("click", () => {
    const senha = document.querySelector("#novasenha").value;
    const confSenha = document.querySelector("#confsenha").value;
    if(senha === null || confSenha === null){
        alert("Preencha todos os campos para continuar");
    }


});