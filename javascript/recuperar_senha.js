botao_voltar = document.querySelector(".icone_voltar");

botao_voltar.addEventListener("click", () => {
    window.location.href = "index.php";
});



document.querySelector(".container").onsubmit = function(){
    var email = document.querySelector("#email").value;
    var cpf = document.querySelector("#cpf").value;

    if(email === '' || cpf === ''){
        alert("Preencha todos os campos para prosseguir!");
        return false;
    }

}