const botaoEmail = document.querySelector(".alt_email");
const modalEmail = document.querySelector(".dialogEmail");
const fecharEmail = document.querySelector(".fecharEmail");

botaoEmail.onclick = function(){
    modalEmail.showModal()

    document.querySelector("#formEmail").onsubmit = function(event) {
        var email = document.querySelector("#campo_email").value.trim();

        // Verifica se o email está vazio ou contém apenas espaços
        if (!email) {
            alert("Preencha o campo de e-mail!");
            return false; // Impede o envio do formulário
        }
    }
}

fecharEmail.onclick = function(){
    modalEmail.close();
}




const botaoTelefone = document.querySelector(".alt_telefone");
const modalTelefone = document.querySelector(".dialogTelefone");
const fecharTelefone = document.querySelector(".fecharTelefone");

botaoTelefone.onclick = function(){
    modalTelefone.showModal()

    document.querySelector("#formTelefone").onsubmit = function(event) {
        var telefone = document.querySelector("#campo_telefone").value.trim();

        // Verifica se o telefone está vazio ou contém apenas espaços
        if (!telefone) {
            alert("Preencha o campo de telefone!");
            return false; // Impede o envio do formulário
        }

        console.log(telefone);
    }

    document.getElementById('campo_telefone').addEventListener('input', function(e) {
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
}

fecharTelefone.onclick = function(){
    modalTelefone.close()
}




const botaoEndereco = document.querySelector(".btn_endereco");
const modalEndereco = document.querySelector(".dialogEndereco");
const fecharEndereco = document.querySelector(".fecharEndereco");

botaoEndereco.onclick = function(){
    modalEndereco.showModal()

    const campo_cep = document.querySelector("#cep");

    campo_cep.addEventListener("blur", () => {
        var rua = document.querySelector("#rua");
        var bairro = document.querySelector("#bairro");
        var cidade = document.querySelector("#cidade");
        var uf = document.querySelector("#uf");
    
        if(campo_cep.value.replace(/\D/g, '') < 8){
    
            rua.value = '';
            bairro.value = '';
            cidade.value = '';
            uf.value = '';
            alert("CEP Inválido");
            return;
        }

        if(!campo_cep.value){
            alert("Preencha o CEP para continuar");
            return;
        }
        
        validaCep = verificarCepNumeros(campo_cep.value);
        if(validaCep){
            var num_cep = campo_cep.value;
            var url = `https://viacep.com.br/ws/${num_cep}/json/`;
            
            fetch(url).then(resultado => {
                return resultado.json();
            }).then(dados => {
                if (dados.erro) {
                    if(rua.value !== '' && bairro.value !== '' && cidade.value !== '' && uf.value !== ''){
                        rua.value = ''
                        bairro.value = ''
                        cidade.value = ''
                        uf.value = ''
                    
                    }
                    alert("O CEP DIGITADO É INVÁLIDO");
                    return;
                }
                preencherCampos(dados);
                })
        }else{
            if(rua.value !== '' && bairro.value !== '' && cidade.value !== ''){
                rua.value = ''
                bairro.value = ''
                cidade.value = ''
                uf.value = ''
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
    

    document.querySelector(".form_endereco").onsubmit = function(event) {
        var cep = document.querySelector("#cep").value.trim();
        var rua = document.querySelector("#rua").value.trim();
        var bairro = document.querySelector("#bairro").value.trim();
        var cidade = document.querySelector("#cidade").value.trim();
        var uf = document.querySelector("#uf").value.trim();
        var num = document.querySelector("#numero").value.trim();
        var complemento = document.querySelector("#complemento").value.trim();


        if (!cep || !num || !complemento) {
            alert("Preencha todos os campos para prosseguir!");
            return false; // Impede o envio do formulário
        }else{
            $.ajax({
                url: 'controllers/controllerDadosCliente.php',
                method: 'POST',
                data: JSON.stringify({
                    cep: cep,
                    rua: rua,
                    bairro: bairro,
                    cidade: cidade,
                    uf: uf,
                    num: num,
                    complemento: complemento
                        
                }),
                contentType: 'application/json',
                success: function(response) {
                    console.log("Sucesso:", response);
                },
                error: function(xhr, status, error) {
                    console.error("Erro:", error);
                    console.log("Detalhes do erro:", xhr.responseText);
                        // Isso vai ajudar a entender o que está errado
                }
            });

        }


    }

}

fecharEndereco.onclick = function(){
    modalEndereco.close()
}



botaoExcluir = document.querySelectorAll(".icone_excluir");

botaoExcluir.forEach(botao => {
    botao.onclick = function(){
        const idEndereco = this.dataset.id;

        const conteudo = {idEndereco: idEndereco};

        console.log("ID: ", idEndereco);

        if (confirm("Ao Excluir seu endereço, todos seus pedidos ligados a ele serão excluídos também. Deseja continuar?")) {
            $.ajax({
                url: 'controllers/enderecoExcluir.php',
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
            window.location.href = "dados_cliente.php";
        }
    }

});



// Capturando a div que possui o ícone de voltar, todas as telas estão com o mesmo nome de classe
const botao_voltar = document.querySelector(".icone_voltar");

// Adicionando um evento de click para atribuir uma função de back ao botão
botao_voltar.addEventListener("click", () => {window.location.href = "home_cliente.php";});




