// capturando div com carrossel e logo do instagram
const abre_instagram = document.querySelector(".abrir_instagram");

// adicionando evento de click para direcionar a uma nova aba com o instagram da empresa
const url_instagram = "https://www.instagram.com/miriancakes_confeitaria/";

abre_instagram.addEventListener("click", () => {window.open(url_instagram, '_blank')})

//capturando botao esqueci senha e adicionando evento para abrir tela de esqueci senha
const esquecisenha = document.querySelector(".esquecisenha");
esquecisenha.addEventListener("click", () => {window.location.href = "recuperar_senha.php"});

//Capturando a div que agrupam as imagens e as imagens do carrossel
const imgs = document.getElementById("img");
const img = document.querySelectorAll(".imgCarrossel");


//Definindo um contador de imagens
let idx = 0;


/* A função avança o contador para percorrer o array de imagens retornado pelo querySelectorAll
 * Quando chegar ao final do array, o contador é reiniciado, começando pela primeira imagem novamente
 * o style.transform é o estilo que realiza a mudança de uma imagem para outra
 */
function carrossel(){
    idx++;

    if(idx > img.length - 1){
        idx=0;
    }
    imgs.style.transform = `translateX(${-idx * 50}rem)`;

}

// Define o intervalo de troca das imagens
setInterval(carrossel, 2400);