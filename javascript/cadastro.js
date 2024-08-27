// Capturando a div que possui o ícone de voltar, todas as telas estão com o mesmo nome de classe
const botao_voltar = document.querySelector(".icone_voltar");

// Adicionando um evento de click para atribuir uma função de back ao botão
botao_voltar.addEventListener("click", () => {window.location.href = "index.php";});


document.getElementById('telefone').addEventListener('input', function(e) {
    let valor = e.target.value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos

    // Formatação
    if (valor.length <= 11) {
        valor = valor.replace(/(\d{2})(\d{0,5})(\d{0,4})/, '($1) $2-$3');
    } else {
        valor = valor.replace(/(\d{2})(\d{5})(\d{4}).*/, '($1) $2-$3');
    }

    e.target.value = valor;

    // Ajusta a posição do cursor após a formatação
    let cursorPos = e.target.selectionStart;
    setTimeout(() => {
        e.target.selectionStart = e.target.selectionEnd = cursorPos;
    }, 0);
});




document.querySelector(".formulario_dados").onsubmit = function(){
    var nome = document.querySelector("#nome_completo").value.trim();
    var email = document.querySelector("#email").value.trim();
    var cpf = document.querySelector("#cpf").value.trim();
    var telefone = document.querySelector("#telefone").value.trim();
    var senha = document.querySelector("#senha").value.trim();
    var conf_senha = document.querySelector("#conf_senha").value.trim();

    var cep = document.querySelector("#cep").value.trim();
    var rua = document.querySelector("#rua").value.trim();
    var bairro = document.querySelector("#bairro").value.trim();
    var cidade = document.querySelector("#cidade").value.trim();
    var uf = document.querySelector("#uf").value.trim();
    var num = document.querySelector("#numero").value.trim();
    var complemento = document.querySelector("#complemento").value.trim();

    var erros= [];
    const regexName = /^[A-Za-zÀ-ÖØ-öø-ÿ\s]+$/;



    
    if (!nome || !email || !cpf || !telefone || !senha || !conf_senha || !cep || !rua || !bairro || !cidade || !uf || !num || !complemento) {
        alert('Preencha todos os campos para prosseguir!');
        return false;
    } else if (nome && email && cpf && telefone && senha && conf_senha && cep && rua && bairro && cidade && uf && num && complemento){
        //Validação CEP
        if(!verificarCepNumeros(cep)){
            alert("O CEP DIGITADO É INVÁLIDO");
            return false;
        }
        
        
        //Validação Nome
        if (nome.length < 2 || nome.length > 50) {
            erros.push("O nome deve ter entre 2 e 50 caracteres!");
        }
        if (!regexName.test(nome)) {
            erros.push("O nome pode conter apenas letras e espaços!");
        }

        //Validação Cpf
        // Remove caracteres não numéricos
        cpf = cpf.replace(/\D/g, '');

        if (cpf.length !== 11) {
            erros.push("CPF Inválido!");
            return;
        }

        // Calcula o primeiro dígito verificador
        let soma = 0;
        for (let i = 0; i < 9; i++) {
            soma += parseInt(cpf.charAt(i)) * (10 - i);
        }
        let digito1 = 11 - (soma % 11);
        if (digito1 >= 10) {
            digito1 = 0;
        }

        // Calcula o segundo dígito verificador
        soma = 0;
        for (let i = 0; i < 10; i++) {
            soma += parseInt(cpf.charAt(i)) * (11 - i);
        }
        let digito2 = 11 - (soma % 11);
        if (digito2 >= 10) {
            digito2 = 0;
        }

        // Verifica se os dígitos verificadores estão corretos
        let verificaDigitos = parseInt(cpf.charAt(9)) === digito1 && parseInt(cpf.charAt(10)) === digito2;
        if (!verificaDigitos || /^(\d)\1{10}$/.test(cpf)) {
            erros.push("CPF Inválido!");
        }

        //Validação Senha
        if(senha.length < 8){
            erros.push("A senha precisa conter no mínimo 8 caracteres!");
        }

        if(senha != conf_senha){
            erros.push("As senhas não são iguais!");
        }

        if(erros.length === 0){
            return true
        }else{
            alert("Erros Encontrados: \n" + erros.join("\n"));
            return false;
        }

    }


}

const campo_cep = document.querySelector("#cep");

campo_cep.addEventListener("blur", () => {
    const rua = document.querySelector("#rua");
    const bairro = document.querySelector("#bairro");
    const cidade = document.querySelector("#cidade");
    const estado = document.querySelector("#uf");

    validaCep = verificarCepNumeros(campo_cep.value);
    if(validaCep){
        var num_cep = campo_cep.value;
        var url = `https://viacep.com.br/ws/${num_cep}/json/`;
        
        fetch(url).then(resultado => {
            return resultado.json();
        }).then(dados => {
            if (dados.erro) {
                if(rua.value !== '' && bairro.value !== '' && cidade.value !== '' && estado.value !== ''){
                    rua.value = ''
                    bairro.value = ''
                    cidade.value = ''
                    estado.value = ''
                }
                alert("O CEP DIGITADO É INVÁLIDO");
                return;
            }
            preencherCampos(dados);
            })
    }else{
        if(rua.value !== '' && bairro.value !== '' && cidade.value !== '' && estado.value !== ''){
            rua.value = ''
            bairro.value = ''
            cidade.value = ''
            estado.value = ''
        }

        alert("O CEP DIGITADO É INVÁLIDO");
        return;
    }
        
    
})


function preencherCampos(dados) {


    var rua = document.querySelector("#rua");
    var bairro = document.querySelector("#bairro");
    var cidade = document.querySelector("#cidade");
    var uf = document.querySelector("#uf");

    rua.value = dados.logradouro;
    bairro.value = dados.bairro;
    cidade.value = dados.localidade;
    uf.value = dados.uf;
}


function verificarCepNumeros(cep) {
    // Remove caracteres não numéricos
    cep = cep.replace(/\D/g, '');
    
    // Verifica se o CEP contém apenas números e se tem exatamente 8 dígitos
    if (/^\d{8}$/.test(cep)) {
        return true; // CEP contém apenas números e tem 8 dígitos
    } else {
        return false; // CEP não contém apenas números ou tem número de dígitos incorreto
    }
}