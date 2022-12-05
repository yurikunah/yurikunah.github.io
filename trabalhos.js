
let i = 0 //índice da página baixada

function scroll(ifrme){
   let iframe = document.createElement("iframe");
   iframe.src = ifrme;
   iframe.class = "rabalho-frame";
   console.log(ifrme);
   document.getElementById("trabalhos-wrapper").appendChild(iframe);
}

/**
 *  <main id="trabalhos-wrapper">
        <!-- <a href="./trabalhos/formulario/index.html" >Validação de Formulario</a>
        <a href="./trabalhos/html1/index.html" >Introdução HTML</a>
        <a href="./trabalhos/XHR/index.html" >XHR</a>
        <a href="./trabalhos/paginas/home.html" >Site CEDUP</a> -->
    </main>
 */

const pag = ["./trabalhos/html1/index.html",
    "./trabalhos/formulario/index.html",
    "./trabalhos/XHR/index.html",
    "./trabalhos/paginas/home.html"];

/** Atualização via scroll: */
window.onscroll = function(){ //https://stackoverflow.com/a/46718465
    let altura = document.body.scrollHeight; 
    let scrollPoint = window.scrollY + window.innerHeight;
    //let scrollPoint = window.scrollY; //início da página
    if(scrollPoint >= altura && i < 3){
		scroll( pag[i] );
        i++;
    }
}

window.onload = function(){
    scroll( pag[i] );
    i++
}